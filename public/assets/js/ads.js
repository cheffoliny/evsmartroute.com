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

    if (!config.enabled || !/^ca-pub-\d{16}$/.test(String(config.client || ''))) return;

    let providerPromise = null;
    const initialisedSlots = new WeakSet();

    const loadProvider = () => {
        if (providerPromise) return providerPromise;
        providerPromise = new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.async = true;
            script.crossOrigin = 'anonymous';
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

    const initialise = async (consent) => {
        if (!consent?.advertising) {
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

    initialise(window.EVSmartRouteConsent);
    window.addEventListener('evsmartroute:consent', (event) => initialise(event.detail));
})();
