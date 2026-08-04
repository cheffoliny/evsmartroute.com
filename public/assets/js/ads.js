(() => {
    'use strict';

    const configNode = document.getElementById('evsrAdvertisingConfig');
    const placements = [...document.querySelectorAll('[data-ad-placement]')];
    if (!configNode || placements.length === 0) return;

    let config = {};
    try {
        config = JSON.parse(configNode.textContent || '{}');
    } catch (_) {
        return;
    }

    if (!config.enabled || !config.cmpEnabled || !/^ca-pub-\d{16}$/.test(String(config.client || ''))) return;

    let providerPromise = null;
    let consentGranted = false;
    let tcfAttached = false;
    const initialisedSlots = new WeakSet();

    const loadProvider = () => {
        if (providerPromise) return providerPromise;
        providerPromise = new Promise((resolve, reject) => {
            const existing = document.querySelector('script[data-evsr-ad-provider="adsense"]');
            if (existing) {
                if (window.adsbygoogle) resolve();
                else existing.addEventListener('load', resolve, { once: true });
                return;
            }

            const script = document.createElement('script');
            script.async = true;
            script.crossOrigin = 'anonymous';
            script.dataset.evsrAdProvider = 'adsense';
            script.src = `https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=${encodeURIComponent(config.client)}`;
            script.addEventListener('load', resolve, { once: true });
            script.addEventListener('error', reject, { once: true });
            document.head.appendChild(script);
        });
        return providerPromise;
    };

    const hidePlacements = () => placements.forEach((placement) => {
        placement.hidden = true;
    });

    const initialise = async () => {
        if (!consentGranted) {
            hidePlacements();
            return;
        }

        try {
            await loadProvider();
            placements.forEach((placement) => {
                const surface = placement.querySelector('[data-ad-surface]');
                const slot = String(placement.dataset.adSlot || '');
                if (!surface || !/^\d+$/.test(slot) || initialisedSlots.has(placement)) return;

                const unit = document.createElement('ins');
                unit.className = 'adsbygoogle';
                unit.style.display = 'block';
                unit.dataset.adClient = config.client;
                unit.dataset.adSlot = slot;
                unit.dataset.adFormat = 'auto';
                unit.dataset.fullWidthResponsive = 'true';
                if (config.testMode) unit.dataset.adtest = 'on';
                surface.appendChild(unit);
                placement.hidden = false;
                initialisedSlots.add(placement);
                (window.adsbygoogle = window.adsbygoogle || []).push({});
            });
        } catch (_) {
            hidePlacements();
        }
    };

    const setConsent = (granted) => {
        consentGranted = granted === true;
        if (!consentGranted) {
            hidePlacements();
            return;
        }
        initialise();
    };

    const attachTcfConsent = () => {
        if (tcfAttached || typeof window.__tcfapi !== 'function') return false;
        tcfAttached = true;
        window.__tcfapi('addEventListener', 2, (tcData, success) => {
            if (!success || !tcData) return;
            if (tcData.gdprApplies === false) {
                setConsent(true);
                return;
            }
            const ready = tcData.eventStatus === 'tcloaded' || tcData.eventStatus === 'useractioncomplete';
            setConsent(ready && tcData.purpose?.consents?.[1] === true);
        });
        return true;
    };

    // Advertising consent is accepted only from the Google-certified TCF CMP.
    // The local preference banner cannot activate an AdSense placement.
    if (!attachTcfConsent()) {
        let attempts = 0;
        const timer = window.setInterval(() => {
            attempts += 1;
            if (attachTcfConsent() || attempts >= 80) window.clearInterval(timer);
        }, 250);
    }

    hidePlacements();
})();
