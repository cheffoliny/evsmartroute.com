<?php
declare(strict_types=1);
$page = $translations['pages']['real-time-data'];
$faqItems = $page['faq_items'];
$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'TechArticle',
            'headline' => $page['title'],
            'description' => $page['seo_description'],
            'inLanguage' => $lang,
            'mainEntityOfPage' => canonical_url('real-time-data'),
            'author' => ['@type' => 'Organization', 'name' => 'EVSmartRoute'],
            'publisher' => ['@type' => 'Organization', 'name' => 'EVSmartRoute', 'url' => SITE_URL],
            'dateModified' => date('Y-m-d'),
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn(array $item): array => [
                '@type' => 'Question', 'name' => $item['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['answer']],
            ], $faqItems),
        ],
    ],
];
require TEMPLATE_PATH . '/header.php';
?>
<main id="main-content">
    <section class="inner-hero data-hero section">
        <div class="inner-hero__glow" aria-hidden="true"></div>
        <div class="container data-hero-layout">
            <div class="inner-hero__content reveal"><p class="eyebrow"><?= e($page['eyebrow']) ?></p><h1><?= e($page['title']) ?></h1><p><?= e($page['intro']) ?></p><div class="data-freshness"><span></span><?= e($page['freshness']) ?></div></div>
            <div class="data-flow glass-panel reveal" aria-label="<?= e($page['flow_aria']) ?>">
                <div class="flow-node"><span>01</span><strong><?= e($page['flow_operators']) ?></strong><small>OCPI · OCPP · API</small></div><i>→</i>
                <div class="flow-node flow-node--cloud"><span>02</span><strong>EVSmartRoute Cloud</strong><small><?= e($page['flow_normalize']) ?></small></div><i>→</i>
                <div class="flow-node"><span>03</span><strong><?= e($page['flow_app']) ?></strong><small>Web · PWA</small></div>
            </div>
        </div>
    </section>

    <section class="section data-layers-section" aria-labelledby="layers-title"><div class="container"><div class="section-heading reveal"><p class="eyebrow"><?= e($page['layers_eyebrow']) ?></p><h2 id="layers-title"><?= e($page['layers_title']) ?></h2><p><?= e($page['layers_intro']) ?></p></div><div class="data-layer-grid">
        <?php foreach ($page['layers'] as $index => $layer): ?><article class="data-layer-card glass-panel reveal"><span class="layer-number">0<?= $index + 1 ?></span><div class="layer-icon" aria-hidden="true"><?= e($layer['icon']) ?></div><h3><?= e($layer['title']) ?></h3><p><?= e($layer['text']) ?></p><ul><?php foreach ($layer['items'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul></article><?php endforeach; ?>
    </div></div></section>

    <section class="section offline-section"><div class="container offline-layout"><div class="offline-visual glass-panel reveal" aria-hidden="true"><div class="station-signal"><span></span><i></i><i></i><i></i></div><div class="offline-status"><span><?= e($page['offline_last_update']) ?></span><strong>12:41</strong><small><?= e($page['offline_unknown']) ?></small></div></div><div class="offline-copy reveal"><p class="eyebrow"><?= e($page['offline_eyebrow']) ?></p><h2><?= e($page['offline_title']) ?></h2><p><?= e($page['offline_text']) ?></p><ul class="check-list"><?php foreach ($page['offline_items'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul></div></div></section>

    <section class="section transparency-section"><div class="container"><div class="transparency-panel glass-panel reveal"><div><p class="eyebrow"><?= e($page['promise_eyebrow']) ?></p><h2><?= e($page['promise_title']) ?></h2></div><p><?= e($page['promise_text']) ?></p></div></div></section>

    <section class="section cpo-section"><div class="container"><div class="cpo-panel reveal"><div><p class="eyebrow">B2B · CPO</p><h2><?= e($page['cpo_title']) ?></h2><p><?= e($page['cpo_text']) ?></p></div><div class="cpo-actions"><a class="button button--primary" href="<?= e(localized_url('contact')) ?>?subject=cpo-integration"><?= e($page['cpo_button']) ?></a><a class="button button--ghost" href="mailto:partners@evsmartroute.com">partners@evsmartroute.com</a></div></div></div></section>

    <section class="section faq-section"><div class="container faq-layout"><div class="section-heading reveal"><p class="eyebrow">FAQ</p><h2><?= e($page['faq_title']) ?></h2></div><div class="accordion"><?php foreach ($faqItems as $item): ?><details class="glass-panel reveal"><summary><?= e($item['question']) ?><span aria-hidden="true">+</span></summary><p><?= e($item['answer']) ?></p></details><?php endforeach; ?></div></div></section>
</main>
<script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
<?php require TEMPLATE_PATH . '/footer.php'; ?>

