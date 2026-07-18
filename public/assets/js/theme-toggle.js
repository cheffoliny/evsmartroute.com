(() => {
    'use strict';

    const root = document.documentElement;
    const toggle = document.querySelector('[data-theme-toggle]');
    const themeColor = document.querySelector('meta[name="theme-color"]');
    if (!toggle) return;

    const readThemeCookie = () => {
        const value = document.cookie.split('; ').find((part) => part.startsWith('esr_theme='))?.slice(10);
        return value === 'light' || value === 'dark' ? value : null;
    };

    const saveThemeCookie = (theme) => {
        const secure = location.protocol === 'https:' ? '; Secure' : '';
        document.cookie = `esr_theme=${theme}; Max-Age=31536000; Path=/; SameSite=Lax${secure}`;
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
        if (persist) saveThemeCookie(theme);
    };

    applyTheme(root.dataset.theme === 'light' ? 'light' : 'dark');
    toggle.addEventListener('click', () => applyTheme(root.dataset.theme === 'light' ? 'dark' : 'light', true));

    const preference = window.matchMedia('(prefers-color-scheme: light)');
    preference.addEventListener?.('change', (event) => {
        if (readThemeCookie()) return;
        applyTheme(event.matches ? 'light' : 'dark');
    });
})();
