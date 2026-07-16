<?php declare(strict_types=1); ?>
<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <a class="brand" href="<?= e(localized_url()) ?>">
                <img class="brand__logo" src="<?= e(asset_url('/assets/images/evsmartroute-logo.webp')) ?>" width="128" height="36" alt="">
                <span class="brand__name">EVSmart<span>Route</span></span>
            </a>
            <p><?= e(t('footer.description')) ?></p>
        </div>
        <div>
            <h2><?= e(t('footer.product')) ?></h2>
            <a href="<?= e(localized_url('features')) ?>"><?= e(t('nav.features')) ?></a>
            <a href="<?= e(localized_url('route-planning')) ?>"><?= e(t('footer.route_planning')) ?></a>
            <a href="<?= e(localized_url('charging-network')) ?>"><?= e(t('nav.network')) ?></a>
            <a href="<?= e(localized_url('real-time-data')) ?>"><?= e(t('nav.data')) ?></a>
            <a href="<?= e(localized_url('pricing')) ?>"><?= e(t('nav.pricing')) ?></a>
        </div>
        <div>
            <h2><?= e(t('footer.company')) ?></h2>
            <a href="<?= e(localized_url('about')) ?>"><?= e(t('footer.about')) ?></a>
            <a href="<?= e(localized_url('blog')) ?>"><?= e(t('nav.blog')) ?></a>
            <a href="<?= e(localized_url('faq')) ?>"><?= e(t('footer.faq')) ?></a>
            <a href="<?= e(localized_url('contact')) ?>"><?= e(t('footer.contact')) ?></a>
        </div>
        <div>
            <h2><?= e(t('footer.legal')) ?></h2>
            <a href="<?= e(localized_url('privacy')) ?>"><?= e(t('footer.privacy')) ?></a>
            <a href="<?= e(localized_url('terms')) ?>"><?= e(t('footer.terms')) ?></a>
            <a href="<?= e(localized_url('cookies')) ?>"><?= e(t('footer.cookies')) ?></a>
            <a href="<?= e(localized_url('eu-data-act')) ?>"><?= e(t('footer.eu_data')) ?></a>
        </div>
    </div>
    <div class="container footer-bottom">
        <p>© <?= date('Y') ?> EVSmartRoute. <?= e(t('footer.rights')) ?></p>
        <div class="footer-status"><span aria-hidden="true"></span><?= e(t('footer.status')) ?></div>
    </div>
</footer>
</body>
</html>
