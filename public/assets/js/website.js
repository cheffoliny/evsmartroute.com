(() => {
    'use strict';

    const loader = document.getElementById('page-loader');
    if (loader) {
        let seen = false;
        try { seen = sessionStorage.getItem('esr-loader-seen') === '1'; } catch (_) {}
        const hideLoader = () => {
            loader.classList.add('is-hidden');
            try { sessionStorage.setItem('esr-loader-seen', '1'); } catch (_) {}
        };
        if (seen || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            hideLoader();
        } else {
            window.setTimeout(hideLoader, 720);
        }
    }

    const header = document.querySelector('[data-header]');
    const menuToggle = document.querySelector('[data-menu-toggle]');
    const navigation = document.querySelector('[data-navigation]');

    const updateHeader = () => header?.classList.toggle('is-scrolled', window.scrollY > 12);
    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });

    menuToggle?.addEventListener('click', () => {
        const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', String(!isOpen));
        navigation?.classList.toggle('is-open', !isOpen);
    });

    navigation?.addEventListener('click', (event) => {
        if (!event.target.closest('a')) return;
        menuToggle?.setAttribute('aria-expanded', 'false');
        navigation.classList.remove('is-open');
    });

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const elements = document.querySelectorAll('.reveal');

    if (reducedMotion || !('IntersectionObserver' in window)) {
        elements.forEach((element) => element.classList.add('is-visible'));
    } else {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.12 });

        elements.forEach((element) => observer.observe(element));
    }

    const networkExperience = document.querySelector('[data-network-experience]');
    if (networkExperience) {
        const filters = [...networkExperience.querySelectorAll('[data-network-filter]')];
        const cards = [...networkExperience.querySelectorAll('[data-network-card]')];
        const markers = [...networkExperience.querySelectorAll('[data-map-network]')];
        const mapLabel = networkExperience.querySelector('[data-network-map-label]');

        const highlightNetwork = (network = '') => {
            cards.forEach((card) => {
                const active = network !== '' && card.dataset.networkCard === network;
                card.classList.toggle('is-active', active);
                card.setAttribute('aria-pressed', String(active));
            });
            markers.forEach((marker) => {
                marker.classList.toggle('is-muted', network !== '' && marker.dataset.mapNetwork !== network);
                marker.classList.toggle('is-highlighted', network === '' || marker.dataset.mapNetwork === network);
            });
            if (mapLabel) {
                const card = cards.find((item) => item.dataset.networkCard === network);
                mapLabel.textContent = card?.getAttribute('aria-label') || filters.find((item) => item.classList.contains('is-active'))?.textContent || '';
            }
        };

        filters.forEach((filter) => filter.addEventListener('click', () => {
            const mode = filter.dataset.networkFilter;
            filters.forEach((item) => item.classList.toggle('is-active', item === filter));
            cards.forEach((card) => {
                const visible = mode === 'all' || card.dataset[mode] === 'true';
                card.classList.toggle('is-filtered', !visible);
            });
            highlightNetwork('');
        }));

        cards.forEach((card) => card.addEventListener('click', () => {
            const network = card.classList.contains('is-active') ? '' : card.dataset.networkCard;
            highlightNetwork(network);
        }));

        highlightNetwork('');
    }
})();
