<?php
declare(strict_types=1);

$canonical = canonical_url($canonicalPath ?? '');
$ogImage = SITE_URL . '/assets/images/og-image.jpg';
$logoUrl = SITE_URL . '/assets/images/evsmartroute-logo.webp';
?>
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDescription) ?>">
<link rel="canonical" href="<?= e($canonical) ?>">
<link rel="alternate" hreflang="bg" href="<?= e(SITE_URL . localized_url($canonicalPath ?? '', 'bg')) ?>">
<link rel="alternate" hreflang="en" href="<?= e(SITE_URL . localized_url($canonicalPath ?? '', 'en')) ?>">
<link rel="alternate" hreflang="x-default" href="<?= e(SITE_URL . localized_url($canonicalPath ?? '', DEFAULT_LANGUAGE)) ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="EVSmartRoute">
<meta property="og:locale" content="<?= $lang === 'bg' ? 'bg_BG' : 'en_US' ?>">
<meta property="og:title" content="<?= e($pageTitle) ?>">
<meta property="og:description" content="<?= e($pageDescription) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e($ogImage) ?>">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="EVSmartRoute — Plan farther. Charge smarter.">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($pageTitle) ?>">
<meta name="twitter:description" content="<?= e($pageDescription) ?>">
<meta name="twitter:image" content="<?= e($ogImage) ?>">
<?php
$schemas = [];
$organization = [
    '@type' => 'Organization', '@id' => SITE_URL . '/#organization', 'name' => 'EVSmartRoute',
    'url' => SITE_URL, 'logo' => ['@type' => 'ImageObject', 'url' => $logoUrl],
    'email' => 'hello@evsmartroute.com',
];
$software = [
    '@type' => 'SoftwareApplication', 'name' => 'EVSmartRoute', 'url' => APP_URL,
    'applicationCategory' => 'NavigationApplication', 'operatingSystem' => 'Web, PWA',
    'description' => t('seo.home.description'),
    'offers' => [
        ['@type' => 'Offer', 'name' => 'FREE', 'price' => '0', 'priceCurrency' => 'EUR'],
        ['@type' => 'Offer', 'name' => 'PREMIUM Monthly', 'price' => '4.99', 'priceCurrency' => 'EUR'],
    ],
];
if (($pageKey ?? '') === 'home') {
    $schemas[] = ['@context' => 'https://schema.org', '@graph' => [
        $organization,
        ['@type' => 'WebSite', '@id' => SITE_URL . '/#website', 'name' => 'EVSmartRoute', 'url' => SITE_URL, 'publisher' => ['@id' => SITE_URL . '/#organization'], 'inLanguage' => ['bg', 'en']],
        $software,
    ]];
} elseif (($pageKey ?? '') === 'features') {
    $schemas[] = ['@context' => 'https://schema.org'] + $software;
} elseif (($pageKey ?? '') === 'pricing' && !empty($translations['pages']['pricing']['faq_items'])) {
    $schemas[] = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array_map(static fn(array $item): array => [
        '@type' => 'Question', 'name' => $item['question'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['answer']],
    ], $translations['pages']['pricing']['faq_items'])];
} elseif (($pageKey ?? '') === 'faq' && !empty($translations['pages']['faq']['sections'])) {
    $schemas[] = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array_map(static fn(array $item): array => [
        '@type' => 'Question', 'name' => $item['title'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['text']],
    ], $translations['pages']['faq']['sections'])];
}
foreach ($schemas as $schema): ?>
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
<?php endforeach; ?>
