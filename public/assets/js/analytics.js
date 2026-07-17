(() => {
    'use strict';

    let initialised = false;

    const initialise = (consent) => {
        if (initialised || !consent?.analytics) return;
        initialised = true;

        // The actual analytics provider is deliberately injected by deployment.
        // No tracking request is made until the visitor grants analytics consent.
        if (typeof window.evsmartrouteAnalyticsInit === 'function') {
            window.evsmartrouteAnalyticsInit();
        }
    };

    initialise(window.EVSmartRouteConsent);
    window.addEventListener('evsmartroute:consent', (event) => initialise(event.detail));
})();
