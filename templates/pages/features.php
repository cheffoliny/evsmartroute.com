<?php
declare(strict_types=1);
$page = $translations['pages']['features'];
$featureLabelsBg = [
    'route' => 'Множество спирки',
    'battery' => 'Интелигентност за батерията',
    'traffic' => 'TomTom трафик в реално време',
    'filter' => 'Филтри за зареждане',
    'modes' => 'Режими на пътуване',
    'mobile' => 'PWA и мобилни устройства',
];
require TEMPLATE_PATH . '/header.php';
?>
<main id="main-content">
    <section class="inner-hero features-hero section">
        <div class="inner-hero__glow" aria-hidden="true"></div>
        <div class="container inner-hero__content reveal">
            <p class="eyebrow"><?= e($page['eyebrow']) ?></p>
            <h1><?= e($page['title']) ?></h1>
            <p><?= e($page['intro']) ?></p>
            <a class="button button--primary" href="<?= e(app_url('/')) ?>"><?= e(t('actions.plan_route')) ?></a>
        </div>
    </section>
    <section class="section feature-showcase-section">
        <div class="container feature-showcase">
            <?php foreach ($page['features'] as $index => $feature):
                $visualImage = match ($feature['visual']) {
                    'route' => 'garage-multistop.webp',
                    'traffic' => 'live-traffic-neon.webp',
                    default => null,
                };
                $featureEyebrow = $lang === 'bg' ? ($featureLabelsBg[$feature['visual']] ?? $feature['eyebrow']) : $feature['eyebrow'];
            ?>
                <article class="showcase-row<?= $index % 2 ? ' showcase-row--reverse' : '' ?> reveal">
                    <div class="showcase-copy">
                        <span class="showcase-number">0<?= $index + 1 ?></span>
                        <p class="eyebrow"><?= e($featureEyebrow) ?></p>
                        <h2><?= e($feature['title']) ?></h2>
                        <p><?= e($feature['text']) ?></p>
                        <ul class="check-list"><?php foreach ($feature['items'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul>
                    </div>
                    <?php if ($feature['visual'] === 'battery'): ?>
                        <div class="showcase-visual battery-feature-widget glass-panel" data-battery-visual>
                            <img src="<?= e(asset_url('/assets/images/mountain-soc-road.webp')) ?>" width="1280" height="720" alt="" loading="lazy" decoding="async">
                            <div class="battery-feature-widget__hud">
                                <span><?= e($lang === 'bg' ? 'ЗАРЯД ПРИ ПРЕВЪРТАНЕ' : 'SCROLL CHARGE') ?></span>
                                <div class="battery-shell battery-shell--vertical"><div class="battery-fill" data-battery-fill></div><strong data-soc-output>15%</strong></div>
                                <small><?= e($feature['label']) ?></small>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="showcase-visual glass-panel showcase-visual--<?= e($feature['visual']) ?><?= $visualImage ? ' showcase-visual--photo' : '' ?>" aria-hidden="true">
                            <?php if ($visualImage): ?><img src="<?= e(asset_url('/assets/images/' . $visualImage)) ?>" width="1280" height="720" alt="" loading="lazy" decoding="async"><?php endif; ?>
                            <div class="visual-grid"></div><span class="visual-primary"><?= e($feature['metric']) ?></span><span class="visual-secondary"><?= e($feature['label']) ?></span><i></i><i></i><i></i>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="section section--cta"><div class="container"><div class="cta-panel glass-panel reveal"><div><p class="eyebrow"><?= e($page['cta_eyebrow']) ?></p><h2><?= e($page['cta_title']) ?></h2><p><?= e($page['cta_text']) ?></p></div><a class="button button--primary" href="<?= e(app_url('/register')) ?>"><?= e(t('actions.start_free')) ?></a></div></div></section>
</main>
<?php require TEMPLATE_PATH . '/footer.php'; ?>
