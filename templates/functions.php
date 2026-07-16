<?php

declare(strict_types=1);

function request_path(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $scriptDirectory = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));

    if ($scriptDirectory !== '/' && $scriptDirectory !== '.' && str_starts_with($path, $scriptDirectory)) {
        $path = substr($path, strlen($scriptDirectory)) ?: '/';
    }

    return '/' . trim($path, '/');
}

function resolve_route(string $path): array
{
    $segments = array_values(array_filter(explode('/', trim($path, '/'))));
    $lang = $segments[0] ?? null;

    if (!in_array($lang, SUPPORTED_LANGUAGES, true)) {
        return ['lang' => DEFAULT_LANGUAGE, 'route' => 'home', 'redirect' => '/' . DEFAULT_LANGUAGE . '/'];
    }

    $slug = $segments[1] ?? '';
    $routes = array_flip(route_slugs($lang));

    return ['lang' => $lang, 'route' => $routes[$slug] ?? '404', 'redirect' => null];
}

function t(string $key, ?string $fallback = null): string
{
    global $translations;
    $value = $translations;

    foreach (explode('.', $key) as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $fallback ?? $key;
        }
        $value = $value[$segment];
    }

    return is_string($value) ? $value : ($fallback ?? $key);
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function localized_url(string $route = '', ?string $targetLang = null): string
{
    global $lang;
    $language = $targetLang ?? $lang;
    $route = trim($route, '/');
    $slugs = route_slugs($language);
    $slug = $slugs[$route] ?? $route;
    return '/' . $language . '/' . ($slug !== '' ? $slug . '/' : '');
}

function route_slugs(string $language): array
{
    $common = [
        'home' => '', 'route-planning' => 'route-planning', 'charging-network' => 'charging-network',
        'battery-intelligence' => 'battery-intelligence', 'live-traffic' => 'live-traffic',
        'about' => 'about', 'faq' => 'faq', 'contact' => 'contact', 'blog' => 'blog',
        'privacy' => 'privacy', 'terms' => 'terms', 'cookies' => 'cookies', 'eu-data-act' => 'eu-data-act',
    ];

    if ($language === 'bg') {
        return array_merge($common, [
            'features' => 'funkcionalnosti', 'pricing' => 'abonamenti', 'real-time-data' => 'danni-v-realno-vreme',
        ]);
    }

    return array_merge($common, [
        'features' => 'features', 'pricing' => 'pricing', 'real-time-data' => 'real-time-data',
    ]);
}

function canonical_url(string $path = ''): string
{
    global $lang;
    return SITE_URL . localized_url($path, $lang);
}

function app_url(string $path = '/'): string
{
    global $lang;
    $separator = str_contains($path, '?') ? '&' : '?';
    return APP_URL . '/' . ltrim($path, '/') . $separator . 'lang=' . rawurlencode($lang);
}

function asset_url(string $path): string
{
    $path = '/' . ltrim($path, '/');
    $file = PROJECT_ROOT . '/public' . str_replace('/', DIRECTORY_SEPARATOR, $path);
    $version = is_file($file) ? (string) filemtime($file) : '1';
    return $path . '?v=' . rawurlencode($version);
}

function is_active_route(string $route): bool
{
    global $routeName;
    return $routeName === $route;
}

function render_route_page(string $route): never
{
    global $lang, $translations, $routeName;

    if ($route === '404') {
        http_response_code(404);
        $pageKey = '404';
        $pageTitle = t('placeholder.not_found');
        $pageDescription = t('placeholder.not_found_text');
        $canonicalPath = '';
        require TEMPLATE_PATH . '/placeholder.php';
        exit;
    }

    $routeName = $route;
    $pageKey = $route;
    $pageTitle = t("pages.$route.seo_title", t('seo.placeholder.title'));
    $pageDescription = t("pages.$route.seo_description", t('seo.placeholder.description'));
    $canonicalPath = $route;
    $specialTemplate = TEMPLATE_PATH . '/pages/' . $route . '.php';
    require is_file($specialTemplate) ? $specialTemplate : TEMPLATE_PATH . '/pages/generic.php';
    exit;
}
