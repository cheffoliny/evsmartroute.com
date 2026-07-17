<?php

declare(strict_types=1);

define('PROJECT_ROOT', dirname(__DIR__));
define('TEMPLATE_PATH', PROJECT_ROOT . '/templates');
define('LANG_PATH', PROJECT_ROOT . '/lang');

const SITE_URL = 'https://evsmartroute.com';
const APP_URL = 'https://app.evsmartroute.com';
const PLAN_CATALOG_ENDPOINT = APP_URL . '/api/v1/plans/catalog.php';
const SUPPORTED_LANGUAGES = ['bg', 'en'];
const DEFAULT_LANGUAGE = 'bg';

require TEMPLATE_PATH . '/functions.php';
require TEMPLATE_PATH . '/plan-catalog.php';

$requestPath = request_path();
$route = resolve_route($requestPath);
$lang = $route['lang'];
$routeName = $route['route'];

if ($route['redirect'] !== null) {
    header('Location: ' . $route['redirect'], true, 302);
    exit;
}

$dictionaryFile = LANG_PATH . '/website_' . $lang . '.php';
$translations = require $dictionaryFile;
$pageDictionaryFile = LANG_PATH . '/pages_' . $lang . '.php';
if (is_file($pageDictionaryFile)) {
    $translations = array_replace_recursive($translations, require $pageDictionaryFile);
}

if ($routeName !== 'home') {
    render_route_page($routeName);
}
