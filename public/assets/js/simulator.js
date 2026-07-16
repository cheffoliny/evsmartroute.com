(() => {
    'use strict';

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const simulator = document.querySelector('[data-simulator]');
    const translations = parseJsonScript('homeTranslations', {});
    const catalog = parseJsonScript('evCatalogData', []);

    function parseJsonScript(id, fallback) {
        const node = document.getElementById(id);
        if (!node) return fallback;
        try { return JSON.parse(node.textContent); } catch { return fallback; }
    }

    function animateNumber(element, target, duration = 500) {
        if (!element) return;
        const start = Number(element.textContent.replace(/[^0-9.-]/g, '')) || 0;
        if (reducedMotion || duration === 0) {
            element.textContent = Math.round(target).toLocaleString();
            return;
        }

        const startTime = performance.now();
        const frame = (now) => {
            const progress = Math.min((now - startTime) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            element.textContent = Math.round(start + ((target - start) * eased)).toLocaleString();
            if (progress < 1) requestAnimationFrame(frame);
        };
        requestAnimationFrame(frame);
    }

    if (simulator) {
        const temperature = simulator.querySelector('[data-temperature]');
        const vehicle = simulator.querySelector('[data-vehicle]');
        const rangeOutput = simulator.querySelector('[data-range-output]');
        const lossOutput = simulator.querySelector('[data-loss-output]');
        const temperatureOutput = simulator.querySelector('[data-temperature-output]');
        const batteryOutput = simulator.querySelector('[data-battery-output]');
        const meter = simulator.querySelector('[data-range-meter]');
        const insight = simulator.querySelector('[data-insight]');

        const climatePenalty = (degrees) => {
            if (degrees < 20) return Math.min(0.31, 0.025 + ((20 - degrees) * 0.0088));
            if (degrees > 24) return Math.min(0.17, 0.02 + ((degrees - 24) * 0.007));
            return 0.02;
        };

        const updateSimulator = () => {
            const option = vehicle.options[vehicle.selectedIndex];
            const wltpRange = Number(option.dataset.range);
            const battery = Number(option.dataset.battery);
            const degrees = Number(temperature.value);
            const penalty = climatePenalty(degrees);
            const realWorldBaseline = wltpRange * 0.91;
            const estimatedRange = Math.round(realWorldBaseline * (1 - penalty));
            const sliderProgress = ((degrees - Number(temperature.min)) / (Number(temperature.max) - Number(temperature.min))) * 100;

            animateNumber(rangeOutput, estimatedRange);
            temperatureOutput.textContent = degrees;
            batteryOutput.textContent = `${battery} kWh`;
            lossOutput.textContent = `−${Math.round(penalty * 100)}%`;
            meter.style.width = `${Math.max(20, Math.min(100, (estimatedRange / 650) * 100))}%`;
            temperature.style.background = `linear-gradient(90deg, var(--electric-blue-light) ${sliderProgress}%, rgba(255,255,255,.09) ${sliderProgress}%)`;
            insight.textContent = degrees < 8 ? translations.insightCold : (degrees > 28 ? translations.insightHot : translations.insightMild);
        };

        temperature.addEventListener('input', updateSimulator);
        vehicle.addEventListener('change', updateSimulator);
        updateSimulator();
    }

    const stats = document.querySelector('[data-stats]');
    if (stats) {
        const runStats = () => stats.querySelectorAll('[data-count-up]').forEach((node) => animateNumber(node, Number(node.dataset.countUp), 1100));
        if (reducedMotion || !('IntersectionObserver' in window)) {
            runStats();
        } else {
            const statsObserver = new IntersectionObserver((entries) => {
                if (!entries.some((entry) => entry.isIntersecting)) return;
                runStats();
                statsObserver.disconnect();
            }, { threshold: 0.3 });
            statsObserver.observe(stats);
        }
    }

    const searchRoot = document.querySelector('[data-vehicle-search]');
    if (!searchRoot || !Array.isArray(catalog)) return;

    const query = searchRoot.querySelector('[data-vehicle-query]');
    const results = searchRoot.querySelector('[data-vehicle-results]');
    const message = document.querySelector('[data-vehicle-message]');
    let activeIndex = -1;
    let currentMatches = [];

    const hideResults = () => {
        results.hidden = true;
        results.innerHTML = '';
        query.setAttribute('aria-expanded', 'false');
        query.removeAttribute('aria-activedescendant');
        activeIndex = -1;
    };

    const selectModel = (model) => {
        query.value = `${model.brand} ${model.model}`;
        message.innerHTML = `<span aria-hidden="true">✓</span> <strong>${escapeHtml(model.brand)} ${escapeHtml(model.model)}</strong> ${escapeHtml(translations.supported)} · ${escapeHtml(model.curve)}`;
        message.hidden = false;
        hideResults();
    };

    const renderResults = () => {
        const term = query.value.trim().toLocaleLowerCase();
        currentMatches = catalog.filter((model) => `${model.brand} ${model.model}`.toLocaleLowerCase().includes(term)).slice(0, 6);
        activeIndex = -1;
        results.innerHTML = '';

        if (!currentMatches.length) {
            results.innerHTML = `<div class="autocomplete-empty">${escapeHtml(translations.noResults)}</div>`;
        } else {
            currentMatches.forEach((model, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'autocomplete-option';
                button.id = `vehicle-option-${index}`;
                button.setAttribute('role', 'option');
                button.innerHTML = `<span>${escapeHtml(model.brand)} ${escapeHtml(model.model)}</span><small>${escapeHtml(String(model.battery))} kWh · ${escapeHtml(model.curve)}</small>`;
                button.addEventListener('click', () => selectModel(model));
                results.appendChild(button);
            });
        }

        results.hidden = false;
        query.setAttribute('aria-expanded', 'true');
    };

    const updateActiveOption = () => {
        const options = results.querySelectorAll('.autocomplete-option');
        options.forEach((option, index) => {
            const active = index === activeIndex;
            option.classList.toggle('is-active', active);
            option.setAttribute('aria-selected', String(active));
        });
        if (activeIndex >= 0) query.setAttribute('aria-activedescendant', `vehicle-option-${activeIndex}`);
    };

    query.addEventListener('input', renderResults);
    query.addEventListener('focus', renderResults);
    query.addEventListener('keydown', (event) => {
        if (results.hidden || !currentMatches.length) return;
        if (event.key === 'ArrowDown') {
            event.preventDefault();
            activeIndex = Math.min(activeIndex + 1, currentMatches.length - 1);
            updateActiveOption();
        } else if (event.key === 'ArrowUp') {
            event.preventDefault();
            activeIndex = Math.max(activeIndex - 1, 0);
            updateActiveOption();
        } else if (event.key === 'Enter' && activeIndex >= 0) {
            event.preventDefault();
            selectModel(currentMatches[activeIndex]);
        } else if (event.key === 'Escape') {
            hideResults();
        }
    });

    document.addEventListener('click', (event) => {
        if (!searchRoot.contains(event.target)) hideResults();
    });

    function escapeHtml(value) {
        const node = document.createElement('span');
        node.textContent = String(value);
        return node.innerHTML;
    }
})();

