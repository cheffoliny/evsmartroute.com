<?php
declare(strict_types=1);

$page = $translations['pages']['charging-network'];
$dataPage = $translations['pages']['real-time-data'];
$faqItems = $dataPage['faq_items'];
$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'TechArticle',
            'headline' => $dataPage['title'],
            'description' => $dataPage['seo_description'],
            'inLanguage' => $lang,
            'mainEntityOfPage' => canonical_url('charging-network') . '#live-data',
            'author' => ['@type' => 'Organization', 'name' => 'EVSmartRoute'],
            'publisher' => ['@type' => 'Organization', 'name' => 'EVSmartRoute', 'url' => SITE_URL],
            'dateModified' => date('Y-m-d'),
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn(array $item): array => [
                '@type' => 'Question',
                'name' => $item['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['answer']],
            ], $faqItems),
        ],
    ],
];
require TEMPLATE_PATH . '/header.php';
?>
<main id="main-content">
    <section class="inner-hero section">
        <div class="inner-hero__glow" aria-hidden="true"></div>
        <div class="container inner-hero__content reveal">
            <p class="eyebrow"><?= e($lang === 'bg' ? 'Зарядна мрежа' : $page['eyebrow']) ?></p>
            <h1><?= e($page['title']) ?></h1>
            <p><?= e($page['intro']) ?></p>
            <a class="button button--primary" href="<?= e(app_url('/')) ?>"><?= e($page['cta']) ?></a>
        </div>
    </section>

    <section class="section section--visual-story">
        <div class="container">
            <figure class="story-visual glass-panel reveal">
                <img src="<?= e(asset_url('/assets/images/charging-network.webp')) ?>" width="1280" height="720" alt="<?= e($page['image_alt']) ?>" loading="lazy" decoding="async">
                <figcaption>
                    <span class="live-badge"><span></span><?= e($lang === 'bg' ? 'Мрежа EVSmartRoute' : 'EVSmartRoute Network') ?></span>
                    <strong><?= e($page['visual_caption']) ?></strong>
                </figcaption>
            </figure>
        </div>
    </section>

    <section class="section content-page-section">
        <div class="container content-page-grid">
            <?php foreach ($page['sections'] as $section): ?>
                <article class="content-card glass-panel reveal">
                    <?php if (!empty($section['icon'])): ?><span class="content-card__icon" aria-hidden="true"><?= e($section['icon']) ?></span><?php endif; ?>
                    <h2><?= e($section['title']) ?></h2>
                    <p><?= e(plan_copy($section['text'])) ?></p>
                    <?php if (!empty($section['items'])): ?>
                        <ul class="check-list"><?php foreach ($section['items'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <div id="live-data" class="section-anchor" aria-hidden="true"></div>
    <section class="inner-hero data-hero section" aria-labelledby="live-data-title">
        <div class="inner-hero__glow" aria-hidden="true"></div>
        <div class="container data-hero-layout">
            <div class="inner-hero__content reveal">
                <p class="eyebrow"><?= e($dataPage['eyebrow']) ?></p>
                <h2 id="live-data-title"><?= e($dataPage['title']) ?></h2>
                <p><?= e($dataPage['intro']) ?></p>
                <div class="data-freshness"><span></span><?= e($dataPage['freshness']) ?></div>
            </div>
            <div class="data-visual-stack reveal">
                <img class="data-hero-image" src="<?= e(asset_url('/assets/images/real-time-charging.webp')) ?>" width="1280" height="720" alt="<?= e($dataPage['image_alt']) ?>" loading="lazy" decoding="async">
                <div class="data-flow glass-panel" aria-label="<?= e($dataPage['flow_aria']) ?>">
                    <div class="flow-node"><span>01</span><strong><?= e($dataPage['flow_operators']) ?></strong><small>OCPI · OCPP · API</small></div><i>→</i>
                    <div class="flow-node flow-node--cloud"><span>02</span><strong>EVSmartRoute Cloud</strong><small><?= e($dataPage['flow_normalize']) ?></small></div><i>→</i>
                    <div class="flow-node"><span>03</span><strong><?= e($dataPage['flow_app']) ?></strong><small>Web · PWA</small></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section data-layers-section" aria-labelledby="layers-title">
        <div class="container">
            <div class="section-heading reveal"><p class="eyebrow"><?= e($dataPage['layers_eyebrow']) ?></p><h2 id="layers-title"><?= e($dataPage['layers_title']) ?></h2><p><?= e($dataPage['layers_intro']) ?></p></div>
            <div class="data-layer-grid">
                <?php foreach ($dataPage['layers'] as $index => $layer): ?>
                    <article class="data-layer-card glass-panel reveal"><span class="layer-number">0<?= $index + 1 ?></span><div class="layer-icon" aria-hidden="true"><?= e($layer['icon']) ?></div><h3><?= e($layer['title']) ?></h3><p><?= e($layer['text']) ?></p><ul><?php foreach ($layer['items'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul></article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section offline-section">
        <div class="container offline-layout">
            <div class="offline-visual glass-panel reveal" aria-hidden="true"><div class="station-signal"><span></span><i></i><i></i><i></i></div><div class="offline-status"><span><?= e($dataPage['offline_last_update']) ?></span><strong>12:41</strong><small><?= e($dataPage['offline_unknown']) ?></small></div></div>
            <div class="offline-copy reveal"><p class="eyebrow"><?= e($dataPage['offline_eyebrow']) ?></p><h2><?= e($dataPage['offline_title']) ?></h2><p><?= e($dataPage['offline_text']) ?></p><ul class="check-list"><?php foreach ($dataPage['offline_items'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul></div>
        </div>
    </section>

    <section class="section transparency-section"><div class="container"><div class="transparency-panel glass-panel reveal"><div><p class="eyebrow"><?= e($dataPage['promise_eyebrow']) ?></p><h2><?= e($dataPage['promise_title']) ?></h2></div><p><?= e($dataPage['promise_text']) ?></p></div></div></section>

    <section class="section cpo-section"><div class="container"><div class="cpo-panel reveal"><div><p class="eyebrow">B2B · CPO</p><h2><?= e($dataPage['cpo_title']) ?></h2><p><?= e($dataPage['cpo_text']) ?></p></div><div class="cpo-actions"><a class="button button--primary" href="<?= e(localized_url('contact')) ?>?subject=cpo-integration"><?= e($dataPage['cpo_button']) ?></a><a class="button button--ghost" href="mailto:partners@evsmartroute.com">partners@evsmartroute.com</a></div></div></div></section>

    <section class="section faq-section"><div class="container faq-layout"><div class="section-heading reveal"><p class="eyebrow">FAQ</p><h2><?= e($dataPage['faq_title']) ?></h2></div><div class="accordion"><?php foreach ($faqItems as $item): ?><details class="glass-panel reveal"><summary><?= e($item['question']) ?><span aria-hidden="true">+</span></summary><p><?= e($item['answer']) ?></p></details><?php endforeach; ?></div></div></section>

    <section class="section section--cta"><div class="container"><div class="cta-panel glass-panel reveal"><div><p class="eyebrow"><?= e(t('home.cta.eyebrow')) ?></p><h2><?= e(t('home.cta.title')) ?></h2><p><?= e(t('home.cta.description')) ?></p></div><a class="button button--primary" href="<?= e(app_url('/register')) ?>"><?= e(t('actions.start_free')) ?></a></div></div></section>
</main>
<script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
<?php require TEMPLATE_PATH . '/footer.php'; ?>
