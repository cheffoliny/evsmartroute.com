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
require TEMPLATE_PATH . '/advertising.php';

$requestPath = request_path();
$route = resolve_route($requestPath);
$lang = $route['lang'];
$routeName = $route['route'];

if (($_COOKIE['esr_lang'] ?? null) !== $lang) {
    setcookie('esr_lang', $lang, [
        'expires' => time() + 31536000,
        'path' => '/',
        'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
        'httponly' => false,
        'samesite' => 'Lax',
    ]);
}

if ($route['redirect'] !== null) {
    $redirectStatus = $route['status'] ?? 302;
    if ($redirectStatus === 302) {
        header('Cache-Control: private, no-store, max-age=0');
    }
    header('Location: ' . $route['redirect'], true, $redirectStatus);
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
