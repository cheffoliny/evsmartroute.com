<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="<?= e($lang) ?>" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0b0f19">
    <script>
        (() => {
            try {
                const saved = localStorage.getItem('theme');
                const theme = saved === 'light' || saved === 'dark' ? saved : (matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');
                document.documentElement.dataset.theme = theme;
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
            <img class="brand__logo brand__logo--mark" src="<?= e(asset_url('/assets/images/evsmartroute-logo.webp')) ?>" width="128" height="128" alt="" fetchpriority="high">
            <img class="brand__logo brand__logo--text" src="<?= e(asset_url('/assets/images/evsmartroute-text-logo-light.webp')) ?>" data-theme-logo data-logo-light="<?= e(asset_url('/assets/images/evsmartroute-text-logo-dark.webp')) ?>" data-logo-dark="<?= e(asset_url('/assets/images/evsmartroute-text-logo-light.webp')) ?>" width="1024" height="100" alt="EVSmartRoute" fetchpriority="high">
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
            <a class="<?= is_active_route('blog') ? 'is-active' : '' ?>" href="<?= e(localized_url('blog')) ?>"><?= e(t('nav.blog')) ?></a>
            <a class="<?= is_active_route('real-time-data') ? 'is-active' : '' ?>" href="<?= e(localized_url('real-time-data')) ?>"><?= e(t('nav.data')) ?></a>
        </nav>

        <div class="header-actions">
            <button class="theme-toggle" type="button" data-theme-toggle data-label-light="<?= e(t('accessibility.light_theme')) ?>" data-label-dark="<?= e(t('accessibility.dark_theme')) ?>" aria-label="<?= e(t('accessibility.light_theme')) ?>">
                <svg class="theme-toggle__sun" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="4" fill="currentColor"/><path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42 1.42M2 12h2M20 12h2M4.93 19.07l1.42-1.42M17.65 6.35l1.42-1.42" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                <svg class="theme-toggle__moon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.3 15.2A8.5 8.5 0 0 1 8.8 3.7 8.5 8.5 0 1 0 20.3 15.2Z" fill="currentColor"/></svg>
            </button>
            <div class="language-switcher" aria-label="<?= e(t('accessibility.language')) ?>">
                <a href="<?= e(localized_url($canonicalPath ?? '', 'bg')) ?>" lang="bg" hreflang="bg" class="<?= $lang === 'bg' ? 'is-active' : '' ?>">BG</a>
                <span aria-hidden="true">/</span>
                <a href="<?= e(localized_url($canonicalPath ?? '', 'en')) ?>" lang="en" hreflang="en" class="<?= $lang === 'en' ? 'is-active' : '' ?>">EN</a>
            </div>
            <a class="login-link" href="<?= e(app_url('/login')) ?>"><?= e(t('actions.login')) ?></a>
            <a class="button button--primary button--small" href="<?= e(app_url('/')) ?>"><?= e(t('actions.plan_route')) ?></a>
        </div>
    </div>
</header>
