<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="<?= e($lang) ?>" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="google-adsense-account" content="ca-pub-7481074142505098">
    <meta name="theme-color" content="#0b0f19">
    <script>
        (() => {
            try {
                const readCookie = (name) => document.cookie.split('; ').find((part) => part.startsWith(name + '='))?.slice(name.length + 1);
                let saved = decodeURIComponent(readCookie('esr_theme') || '');
                if (saved !== 'light' && saved !== 'dark') {
                    const legacy = localStorage.getItem('theme');
                    if (legacy === 'light' || legacy === 'dark') {
                        saved = legacy;
                        document.cookie = `esr_theme=${legacy}; Max-Age=31536000; Path=/; SameSite=Lax${location.protocol === 'https:' ? '; Secure' : ''}`;
                        localStorage.removeItem('theme');
                    }
                }
                const theme = saved === 'light' || saved === 'dark' ? saved : (matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');
                document.documentElement.dataset.theme = theme;
                document.documentElement.style.colorScheme = theme;
                document.querySelector('meta[name="theme-color"]').content = theme === 'light' ? '#f8fafc' : '#0b0f19';
            } catch (_) {}
        })();
    </script>
    <?php require TEMPLATE_PATH . '/seo.php'; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet"></noscript>
    <link rel="stylesheet" href="<?= e(asset_url('/assets/css/website.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset_url('/assets/css/components.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset_url('/assets/css/responsive.css')) ?>">
    <script src="<?= e(asset_url('/assets/js/website.js')) ?>" defer></script>
    <script src="<?= e(asset_url('/assets/js/theme-toggle.js')) ?>" defer></script>
    <script src="<?= e(asset_url('/assets/js/cookie-consent.js')) ?>" defer></script>
    <script src="<?= e(asset_url('/assets/js/analytics.js')) ?>" defer></script>
    <script src="<?= e(asset_url('/assets/js/ads.js')) ?>" defer></script>
    <?php if (($pageKey ?? '') === 'home'): ?>
        <script src="<?= e(asset_url('/assets/js/simulator.js')) ?>" defer></script>
    <?php endif; ?>
    <?php if (in_array(($pageKey ?? ''), ['home', 'features'], true)): ?>
        <script src="<?= e(asset_url('/assets/js/animations.js')) ?>" defer></script>
    <?php endif; ?>
    <?php if (($pageKey ?? '') === 'pricing'): ?>
        <script src="<?= e(asset_url('/assets/js/pricing.js')) ?>" defer></script>
    <?php endif; ?>
</head>
<body>
<script id="evsrAdvertisingConfig" type="application/json"><?= json_encode(advertising_public_config(), JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
<div id="page-loader" class="page-loader" aria-hidden="true">
    <div class="page-loader__core">
        <span class="page-loader__ring"></span>
        <img src="<?= e(asset_url('/assets/images/evsmartroute-logo-light.webp')) ?>" width="256" height="72" alt="">
        <div class="page-loader__battery"><span></span></div>
        <small>EVSmartRoute · ESR</small>
    </div>
</div>
<a class="skip-link" href="#main-content"><?= e(t('accessibility.skip')) ?></a>
<header class="site-header" data-header>
    <div class="container site-header__inner">
        <a class="brand" href="<?= e(localized_url()) ?>" aria-label="EVSmartRoute — <?= e(t('nav.home')) ?>">
            <img class="brand__logo brand__logo--mark" src="<?= e(asset_url('/assets/images/evsmartroute-logo.webp')) ?>" width="256" height="72" alt="" fetchpriority="high">
            <img class="brand__logo brand__logo--text" src="<?= e(asset_url('/assets/images/evsmartroute-wordmark-light.webp')) ?>" data-theme-logo data-logo-light="<?= e(asset_url('/assets/images/evsmartroute-wordmark-dark.webp')) ?>" data-logo-dark="<?= e(asset_url('/assets/images/evsmartroute-wordmark-light.webp')) ?>" width="1024" height="72" alt="EVSmartRoute" fetchpriority="high">
        </a>

        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation" data-menu-toggle>
            <span class="sr-only"><?= e(t('accessibility.menu')) ?></span>
            <span></span><span></span>
        </button>

        <nav class="primary-nav" id="primary-navigation" aria-label="<?= e(t('accessibility.primary_nav')) ?>" data-navigation>
            <a class="<?= is_active_route('home') ? 'is-active' : '' ?>" href="<?= e(localized_url()) ?>"><?= e(t('nav.home')) ?></a>
            <a class="<?= is_active_route('features') ? 'is-active' : '' ?>" href="<?= e(localized_url('features')) ?>"><?= e(t('nav.features')) ?></a>
            <a class="<?= is_active_route('charging-network') ? 'is-active' : '' ?>" href="<?= e(localized_url('charging-network')) ?>"><?= e(t('nav.network')) ?></a>
            <a class="<?= is_active_route('pricing') ? 'is-active' : '' ?>" href="<?= e(localized_url('pricing')) ?>"><?= e(t('nav.pricing')) ?></a>
        </nav>

        <div class="header-actions">
            <button class="theme-toggle" type="button" data-theme-toggle data-label-light="<?= e(t('accessibility.light_theme')) ?>" data-label-dark="<?= e(t('accessibility.dark_theme')) ?>" aria-label="<?= e(t('accessibility.light_theme')) ?>">
                <svg class="theme-toggle__sun" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="4" fill="currentColor"/><path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42 1.42M2 12h2M20 12h2M4.93 19.07l1.42-1.42M17.65 6.35l1.42-1.42" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                <svg class="theme-toggle__moon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.3 15.2A8.5 8.5 0 0 1 8.8 3.7 8.5 8.5 0 1 0 20.3 15.2Z" fill="currentColor"/></svg>
            </button>
            <details class="language-dropdown" data-language-dropdown>
                <summary aria-label="<?= e(t('accessibility.language')) ?>">
                    <strong><?= strtoupper(e($lang)) ?></strong>
                    <svg viewBox="0 0 12 8" aria-hidden="true"><path d="m1 1 5 5 5-5"/></svg>
                </summary>
                <div class="language-dropdown__menu">
                    <?php if ($lang === 'bg'): ?>
                        <a href="<?= e(localized_url($canonicalPath ?? '', 'en')) ?>" lang="en" hreflang="en"><strong>EN</strong><small>English</small></a>
                    <?php else: ?>
                        <a href="<?= e(localized_url($canonicalPath ?? '', 'bg')) ?>" lang="bg" hreflang="bg"><strong>BG</strong><small>Български</small></a>
                    <?php endif; ?>
                </div>
            </details>
            <a class="button header-cta" href="<?= e(APP_URL . '/?auth=login&lang=' . rawurlencode($lang)) ?>">
                <svg class="header-cta__icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="7" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
                <span><?= e(t('actions.login')) ?></span>
            </a>
        </div>
    </div>
</header>
