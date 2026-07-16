<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="<?= e($lang) ?>" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0b0f19">
    <?php require TEMPLATE_PATH . '/seo.php'; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(asset_url('/assets/css/website.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset_url('/assets/css/components.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset_url('/assets/css/responsive.css')) ?>">
    <script src="<?= e(asset_url('/assets/js/website.js')) ?>" defer></script>
    <?php if (($pageKey ?? '') === 'home'): ?>
        <script src="<?= e(asset_url('/assets/js/simulator.js')) ?>" defer></script>
        <script src="<?= e(asset_url('/assets/js/animations.js')) ?>" defer></script>
    <?php endif; ?>
    <?php if (($pageKey ?? '') === 'pricing'): ?>
        <script src="<?= e(asset_url('/assets/js/pricing.js')) ?>" defer></script>
    <?php endif; ?>
</head>
<body>
<a class="skip-link" href="#main-content"><?= e(t('accessibility.skip')) ?></a>
<header class="site-header" data-header>
    <div class="container site-header__inner">
        <a class="brand" href="<?= e(localized_url()) ?>" aria-label="EVSmartRoute — <?= e(t('nav.home')) ?>">
            <img class="brand__logo" src="<?= e(asset_url('/assets/images/evsmartroute-logo.webp')) ?>" width="128" height="36" alt="" fetchpriority="high">
            <span class="brand__name">EVSmart<span>Route</span></span>
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
