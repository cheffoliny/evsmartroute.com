<?php

declare(strict_types=1);

define('PROJECT_ROOT', dirname(__DIR__));
define('TEMPLATE_PATH', PROJECT_ROOT . '/templates');
const SITE_URL = 'https://evsmartroute.com';
const APP_URL = 'https://app.evsmartroute.com';
const SUPPORTED_LANGUAGES = ['bg', 'en'];
const DEFAULT_LANGUAGE = 'bg';

require TEMPLATE_PATH . '/functions.php';

$routes = [
    'home', 'features', 'route-planning', 'charging-network', 'battery-intelligence',
    'live-traffic', 'pricing', 'real-time-data', 'about', 'faq', 'contact', 'blog',
    'privacy', 'terms', 'cookies', 'eu-data-act',
];
$lastModified = gmdate('Y-m-d', max(
    filemtime(__FILE__) ?: 0,
    filemtime(PROJECT_ROOT . '/lang/pages_bg.php') ?: 0,
    filemtime(PROJECT_ROOT . '/lang/pages_en.php') ?: 0,
));

header('Content-Type: application/xml; charset=UTF-8');
header('Cache-Control: public, max-age=3600');

echo '<?xml version="1.0" encoding="UTF-8"?>', PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php foreach ($routes as $route): ?>
<?php foreach (SUPPORTED_LANGUAGES as $language): ?>
    <url>
        <loc><?= htmlspecialchars(SITE_URL . localized_url($route, $language), ENT_XML1, 'UTF-8') ?></loc>
        <lastmod><?= $lastModified ?></lastmod>
        <changefreq><?= in_array($route, ['home', 'blog'], true) ? 'weekly' : 'monthly' ?></changefreq>
        <priority><?= $route === 'home' ? '1.0' : (in_array($route, ['features', 'pricing', 'real-time-data'], true) ? '0.9' : '0.7') ?></priority>
        <xhtml:link rel="alternate" hreflang="bg" href="<?= htmlspecialchars(SITE_URL . localized_url($route, 'bg'), ENT_XML1, 'UTF-8') ?>" />
        <xhtml:link rel="alternate" hreflang="en" href="<?= htmlspecialchars(SITE_URL . localized_url($route, 'en'), ENT_XML1, 'UTF-8') ?>" />
        <xhtml:link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars(SITE_URL . localized_url($route, DEFAULT_LANGUAGE), ENT_XML1, 'UTF-8') ?>" />
    </url>
<?php endforeach; ?>
<?php endforeach; ?>
</urlset>

