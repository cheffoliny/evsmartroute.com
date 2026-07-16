(() => {
    'use strict';

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reducedMotion) return;

    const parallaxItems = [...document.querySelectorAll('[data-parallax]')];
    let scheduled = false;

    const updateParallax = () => {
        const viewportHeight = window.innerHeight;
        parallaxItems.forEach((item) => {
            const rect = item.getBoundingClientRect();
            if (rect.bottom < -100 || rect.top > viewportHeight + 100) return;
            const speed = Number(item.dataset.parallax) || 0;
            const offset = (rect.top - (viewportHeight / 2)) * speed;
            item.style.setProperty('--parallax-y', `${offset.toFixed(1)}px`);
        });
        scheduled = false;
    };

    const requestParallax = () => {
        if (scheduled) return;
        scheduled = true;
        requestAnimationFrame(updateParallax);
    };

    parallaxItems.forEach((item) => item.classList.add('has-parallax'));
    updateParallax();
    window.addEventListener('scroll', requestParallax, { passive: true });
    window.addEventListener('resize', requestParallax, { passive: true });

    const routeMotion = document.querySelector('[data-route-motion]');
    if (routeMotion) {
        if ('IntersectionObserver' in window) {
            const routeObserver = new IntersectionObserver((entries) => {
                routeMotion.classList.toggle('is-route-active', entries.some((entry) => entry.isIntersecting));
            }, { threshold: 0.25 });
            routeObserver.observe(routeMotion);
        } else {
            routeMotion.classList.add('is-route-active');
        }
    }

    const batteryVisual = document.querySelector('[data-battery-visual]');
    if (!batteryVisual) return;

    const fill = batteryVisual.querySelector('[data-battery-fill]');
    const output = batteryVisual.querySelector('[data-soc-output]');
    let batteryActive = false;

    const updateBattery = () => {
        if (!batteryActive) return;
        const rect = batteryVisual.getBoundingClientRect();
        const travel = window.innerHeight + rect.height;
        const progress = Math.min(1, Math.max(0, (window.innerHeight - rect.top) / travel));
        const value = Math.round(15 + (progress * 83));
        const color = value <= 20 ? '#ef4444' : value <= 55 ? '#f59e0b' : value > 80 ? '#22c55e' : '#0ea5e9';
        output.textContent = `${value}%`;
        const isVertical = Boolean(fill.closest('.battery-shell--vertical'));
        if (isVertical) {
            fill.style.height = `calc(${value}% - 14px)`;
        } else {
            fill.style.width = `calc(${value}% - 14px)`;
        }
        fill.style.background = `linear-gradient(${isVertical ? '0deg' : '90deg'}, #0ea5e9, ${color})`;
        batteryVisual.style.setProperty('--charge-color', color);
    };

    if ('IntersectionObserver' in window) {
        const batteryObserver = new IntersectionObserver((entries) => {
            batteryActive = entries.some((entry) => entry.isIntersecting);
            if (batteryActive) updateBattery();
        }, { rootMargin: '20% 0px' });
        batteryObserver.observe(batteryVisual);
    } else {
        batteryActive = true;
    }

    window.addEventListener('scroll', updateBattery, { passive: true });
    window.addEventListener('resize', updateBattery, { passive: true });
    updateBattery();
})();
