<?php
declare(strict_types=1);

$page = $translations['pages'][$routeName] ?? [];
require TEMPLATE_PATH . '/header.php';
?>
<main id="main-content">
    <section class="inner-hero section">
        <div class="inner-hero__glow" aria-hidden="true"></div>
        <div class="container inner-hero__content reveal">
            <p class="eyebrow"><?= e($page['eyebrow'] ?? 'EVSmartRoute') ?></p>
            <h1><?= e($page['title'] ?? $pageTitle) ?></h1>
            <p><?= e($page['intro'] ?? $pageDescription) ?></p>
            <?php if (!empty($page['cta'])): ?>
                <a class="button button--primary" href="<?= e(app_url($page['cta_path'] ?? '/')) ?>"><?= e($page['cta']) ?></a>
            <?php endif; ?>
        </div>
    </section>

    <?php if (!empty($page['sections'])): ?>
        <section class="section content-page-section">
            <div class="container content-page-grid">
                <?php foreach ($page['sections'] as $section): ?>
                    <article class="content-card glass-panel reveal">
                        <?php if (!empty($section['icon'])): ?><span class="content-card__icon" aria-hidden="true"><?= e($section['icon']) ?></span><?php endif; ?>
                        <h2><?= e($section['title']) ?></h2>
                        <p><?= e($section['text']) ?></p>
                        <?php if (!empty($section['items'])): ?>
                            <ul class="check-list">
                                <?php foreach ($section['items'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if (!empty($page['note'])): ?>
        <section class="section section--compact">
            <div class="container"><div class="prose-panel glass-panel reveal"><h2><?= e($page['note_title'] ?? '') ?></h2><p><?= e($page['note']) ?></p></div></div>
        </section>
    <?php endif; ?>

    <section class="section section--cta">
        <div class="container"><div class="cta-panel glass-panel reveal"><div><p class="eyebrow"><?= e(t('home.cta.eyebrow')) ?></p><h2><?= e(t('home.cta.title')) ?></h2><p><?= e(t('home.cta.description')) ?></p></div><a class="button button--primary" href="<?= e(app_url('/register')) ?>"><?= e(t('actions.start_free')) ?></a></div></div>
    </section>
</main>
<?php require TEMPLATE_PATH . '/footer.php'; ?>

