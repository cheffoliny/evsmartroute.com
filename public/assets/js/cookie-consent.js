(() => {
    'use strict';

    const COOKIE_NAME = 'esr_cookie_consent';
    const CONSENT_VERSION = 1;
    const MAX_AGE_SECONDS = 60 * 60 * 24 * 180;
    const banner = document.getElementById('cookieConsentBanner');
    const modal = document.getElementById('cookieConsentModal');
    const preferencesInput = document.querySelector('[data-cookie-category="preferences"]');
    const analyticsInput = document.querySelector('[data-cookie-category="analytics"]');
    let lastFocusedElement = null;

    const readCookie = (name) => document.cookie
        .split('; ')
        .find((part) => part.startsWith(`${name}=`))
        ?.slice(name.length + 1);

    const readConsent = () => {
        try {
            const raw = readCookie(COOKIE_NAME);
            if (!raw) return null;
            const value = JSON.parse(decodeURIComponent(raw));
            if (value?.version !== CONSENT_VERSION) return null;
            return {
                necessary: true,
                preferences: Boolean(value.preferences),
                analytics: Boolean(value.analytics),
            };
        } catch (_) {
            return null;
        }
    };

    const emitConsent = (consent) => {
        window.EVSmartRouteConsent = Object.freeze({ ...consent });
        window.dispatchEvent(new CustomEvent('evsmartroute:consent', { detail: consent }));
    };

    const removeAnalyticsCookies = () => {
        document.cookie.split(';').forEach((part) => {
            const name = part.split('=')[0].trim();
            if (!/^(_ga|_gid|_gat|_gcl_au)/.test(name)) return;
            document.cookie = `${name}=; Max-Age=0; Path=/; SameSite=Lax`;
            document.cookie = `${name}=; Max-Age=0; Path=/; Domain=.evsmartroute.com; SameSite=Lax`;
        });
    };

    const saveConsent = ({ preferences = false, analytics = false }) => {
        const consent = { version: CONSENT_VERSION, necessary: true, preferences, analytics };
        const secure = location.protocol === 'https:' ? '; Secure' : '';
        document.cookie = `${COOKIE_NAME}=${encodeURIComponent(JSON.stringify(consent))}; Max-Age=${MAX_AGE_SECONDS}; Path=/; SameSite=Lax${secure}`;
        if (!preferences) {
            try { localStorage.removeItem('theme'); } catch (_) {}
        }
        if (!analytics) removeAnalyticsCookies();
        banner.hidden = true;
        closeSettings(false);
        emitConsent(consent);
    };

    const openSettings = () => {
        const consent = readConsent() || { preferences: false, analytics: false };
        lastFocusedElement = document.activeElement;
        preferencesInput.checked = Boolean(consent.preferences);
        analyticsInput.checked = Boolean(consent.analytics);
        modal.hidden = false;
        document.documentElement.classList.add('has-cookie-modal');
        modal.querySelector('.cookie-modal__close')?.focus();
    };

    function closeSettings(restoreFocus = true) {
        modal.hidden = true;
        document.documentElement.classList.remove('has-cookie-modal');
        if (restoreFocus && lastFocusedElement instanceof HTMLElement) lastFocusedElement.focus();
    }

    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('[data-cookie-action], [data-cookie-settings]');
        if (!trigger) return;
        const action = trigger.dataset.cookieAction || 'settings';
        if (action === 'settings') openSettings();
        if (action === 'close-settings') closeSettings();
        if (action === 'necessary') saveConsent({ preferences: false, analytics: false });
        if (action === 'accept-all') saveConsent({ preferences: true, analytics: true });
        if (action === 'save') saveConsent({
            preferences: preferencesInput.checked,
            analytics: analyticsInput.checked,
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !modal.hidden) closeSettings();
    });

    const existingConsent = readConsent();
    if (existingConsent) {
        emitConsent(existingConsent);
    } else {
        window.setTimeout(() => { banner.hidden = false; }, 500);
        emitConsent({ version: CONSENT_VERSION, necessary: true, preferences: false, analytics: false });
    }
})();
