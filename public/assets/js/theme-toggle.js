(() => {
    'use strict';

    const root = document.documentElement;
    const toggle = document.querySelector('[data-theme-toggle]');
    const themeColor = document.querySelector('meta[name="theme-color"]');
    if (!toggle) return;

    const preferencesAllowed = () => {
        if (window.EVSmartRouteConsent) return Boolean(window.EVSmartRouteConsent.preferences);
        try {
            const item = document.cookie.split('; ').find((part) => part.startsWith('esr_cookie_consent='));
            return item ? Boolean(JSON.parse(decodeURIComponent(item.split('=').slice(1).join('='))).preferences) : false;
        } catch (_) {
            return false;
        }
    };

    const applyTheme = (theme, persist = false) => {
        root.dataset.theme = theme;
        root.style.colorScheme = theme;
        toggle.setAttribute('aria-label', theme === 'dark' ? toggle.dataset.labelLight : toggle.dataset.labelDark);
        toggle.setAttribute('aria-pressed', String(theme === 'light'));
        document.querySelectorAll('[data-theme-logo]').forEach((logo) => {
            const nextSource = theme === 'light' ? logo.dataset.logoLight : logo.dataset.logoDark;
            if (nextSource && logo.getAttribute('src') !== nextSource) logo.setAttribute('src', nextSource);
        });
        if (themeColor) themeColor.content = theme === 'light' ? '#f8fafc' : '#0b0f19';
        if (persist && preferencesAllowed()) {
            try { localStorage.setItem('theme', theme); } catch (_) {}
        }
    };

    applyTheme(root.dataset.theme === 'light' ? 'light' : 'dark');
    toggle.addEventListener('click', () => applyTheme(root.dataset.theme === 'light' ? 'dark' : 'light', true));

    const preference = window.matchMedia('(prefers-color-scheme: light)');
    preference.addEventListener?.('change', (event) => {
        try {
            if (localStorage.getItem('theme')) return;
        } catch (_) {}
        applyTheme(event.matches ? 'light' : 'dark');
    });

    window.addEventListener('evsmartroute:consent', (event) => {
        try {
            if (event.detail?.preferences) localStorage.setItem('theme', root.dataset.theme);
            else localStorage.removeItem('theme');
        } catch (_) {}
    });
})();
