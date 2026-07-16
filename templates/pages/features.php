<?php
declare(strict_types=1);
$page = $translations['pages']['features'];
require TEMPLATE_PATH . '/header.php';
?>
<main id="main-content">
    <section class="inner-hero features-hero section"><div class="inner-hero__glow" aria-hidden="true"></div><div class="container inner-hero__content reveal"><p class="eyebrow"><?= e($page['eyebrow']) ?></p><h1><?= e($page['title']) ?></h1><p><?= e($page['intro']) ?></p><a class="button button--primary" href="<?= e(app_url('/')) ?>"><?= e(t('actions.plan_route')) ?></a></div></section>
    <section class="section feature-showcase-section"><div class="container feature-showcase">
        <?php foreach ($page['features'] as $index => $feature): ?><article class="showcase-row<?= $index % 2 ? ' showcase-row--reverse' : '' ?> reveal"><div class="showcase-copy"><span class="showcase-number">0<?= $index + 1 ?></span><p class="eyebrow"><?= e($feature['eyebrow']) ?></p><h2><?= e($feature['title']) ?></h2><p><?= e($feature['text']) ?></p><ul class="check-list"><?php foreach ($feature['items'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul></div><div class="showcase-visual glass-panel showcase-visual--<?= e($feature['visual']) ?>" aria-hidden="true"><div class="visual-grid"></div><span class="visual-primary"><?= e($feature['metric']) ?></span><span class="visual-secondary"><?= e($feature['label']) ?></span><i></i><i></i><i></i></div></article><?php endforeach; ?>
    </div></section>
    <section class="section section--cta"><div class="container"><div class="cta-panel glass-panel reveal"><div><p class="eyebrow"><?= e($page['cta_eyebrow']) ?></p><h2><?= e($page['cta_title']) ?></h2><p><?= e($page['cta_text']) ?></p></div><a class="button button--primary" href="<?= e(app_url('/register')) ?>"><?= e(t('actions.start_free')) ?></a></div></div></section>
</main>
<?php require TEMPLATE_PATH . '/footer.php'; ?>

