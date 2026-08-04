(() => {
    'use strict';

    const COOKIE_NAME = 'esr_cookie_consent';
    const CONSENT_VERSION = 4;
    const MAX_AGE_SECONDS = 60 * 60 * 24 * 180;
    const banner = document.getElementById('cookieConsentBanner');
    const modal = document.getElementById('cookieConsentModal');
    const preferencesInput = document.querySelector('[data-cookie-category="preferences"]');
    const analyticsInput = document.querySelector('[data-cookie-category="analytics"]');
    const advertisingConfigNode = document.getElementById('evsrAdvertisingConfig');
    let lastFocusedElement = null;
    let localBannerShown = false;

    const cmpEnabled = (() => {
        try {
            return JSON.parse(advertisingConfigNode?.textContent || '{}').cmpEnabled === true;
        } catch (_) {
            return false;
        }
    })();

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
        const expires = new Date(Date.now() + MAX_AGE_SECONDS * 1000).toUTCString();
        document.cookie = `${COOKIE_NAME}=${encodeURIComponent(JSON.stringify(consent))}; Max-Age=${MAX_AGE_SECONDS}; Expires=${expires}; Path=/; SameSite=Lax${secure}`;
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
        modal.setAttribute('aria-hidden', 'false');
        modal.querySelector('.cookie-modal__close')?.focus();
    };

    function closeSettings(restoreFocus = true) {
        modal.hidden = true;
        modal.setAttribute('aria-hidden', 'true');
        document.documentElement.classList.remove('has-cookie-modal');
        if (restoreFocus && lastFocusedElement instanceof HTMLElement) lastFocusedElement.focus();
    }

    const showLocalBanner = () => {
        if (localBannerShown) return;
        localBannerShown = true;
        window.setTimeout(() => { banner.hidden = false; }, 350);
    };

    const showLocalBannerAfterCmp = () => {
        if (!cmpEnabled) {
            showLocalBanner();
            return;
        }

        let attached = false;
        let attempts = 0;
        const attach = () => {
            if (attached || typeof window.__tcfapi !== 'function') return false;
            attached = true;
            window.__tcfapi('addEventListener', 2, (tcData, success) => {
                if (!success || !tcData) return;
                const decisionAvailable = tcData.gdprApplies === false
                    || tcData.eventStatus === 'useractioncomplete'
                    || (tcData.eventStatus === 'tcloaded' && Boolean(tcData.tcString));
                if (decisionAvailable) showLocalBanner();
            });
            return true;
        };

        if (attach()) return;
        const timer = window.setInterval(() => {
            attempts += 1;
            if (attach() || attempts >= 80) {
                window.clearInterval(timer);
                if (!attached) showLocalBanner();
            }
        }, 250);
    };

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
        if (modal.hidden) return;
        if (event.key === 'Escape') {
            closeSettings();
            return;
        }
        if (event.key !== 'Tab') return;
        const focusable = [...modal.querySelectorAll('button:not([disabled]), input:not([disabled]), a[href]')]
            .filter((element) => element.tabIndex >= 0 && !element.hidden && element.getClientRects().length > 0);
        if (!focusable.length) return;
        const first = focusable[0];
        const last = focusable[focusable.length - 1];
        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    });

    const existingConsent = readConsent();
    if (existingConsent) {
        emitConsent(existingConsent);
    } else {
        showLocalBannerAfterCmp();
        emitConsent({ version: CONSENT_VERSION, necessary: true, preferences: false, analytics: false });
    }
})();
