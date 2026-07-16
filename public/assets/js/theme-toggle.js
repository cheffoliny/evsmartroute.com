(() => {
    'use strict';

    const root = document.documentElement;
    const toggle = document.querySelector('[data-theme-toggle]');
    const themeColor = document.querySelector('meta[name="theme-color"]');
    if (!toggle) return;

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
        if (persist) {
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
})();

