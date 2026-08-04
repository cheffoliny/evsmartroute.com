<?php

declare(strict_types=1);

/**
 * Loads the public plan catalogue owned by app.evsmartroute.com.
 *
 * Development can use EVSMARTROUTE_PLAN_CATALOG_FILE for a direct shared file.
 * Production uses the public API with a short cache and a local fallback, so a
 * temporary application outage never blocks the presentation website.
 */
function load_plan_catalog(): array
{
    static $catalog = null;
    if (is_array($catalog)) {
        return $catalog;
    }

    $fallback = [
        'schema_version' => 2,
        'currency' => 'EUR',
        'trial' => ['duration' => 'P1M'],
        'plans' => [
            'free' => [
                'limits' => ['max_route_km' => 500.0, 'daily_routes' => 10, 'garage_cars' => 1, 'saved_routes' => 2],
                'features' => ['multi_stop' => false, 'live_traffic' => false, 'advanced_routing' => false],
                'prices' => [],
            ],
            'premium' => [
                'limits' => ['max_route_km' => null, 'daily_routes' => null, 'garage_cars' => null, 'saved_routes' => null],
                'features' => ['multi_stop' => true, 'live_traffic' => true, 'advanced_routing' => true],
                'prices' => [
                    'monthly' => ['amount' => 4.99, 'currency' => 'EUR', 'interval' => 'month'],
                    'yearly' => ['amount' => 39.99, 'currency' => 'EUR', 'interval' => 'year'],
                ],
            ],
        ],
    ];

    $configuredFile = trim((string) getenv('EVSMARTROUTE_PLAN_CATALOG_FILE'));
    $localCandidates = array_filter([
        $configuredFile,
        dirname(PROJECT_ROOT) . '/SmartEV/app/Config/plans.php',
    ]);
    foreach ($localCandidates as $file) {
        if (!is_file($file)) {
            continue;
        }
        $loaded = require $file;
        if (valid_plan_catalog($loaded)) {
            return $catalog = $loaded;
        }
    }

    $cacheFile = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'evsmartroute-plan-catalog.json';
    $cached = read_plan_catalog_cache($cacheFile);
    if ($cached !== null && (time() - (int) filemtime($cacheFile)) < 300) {
        return $catalog = $cached;
    }

    $remote = fetch_plan_catalog(PLAN_CATALOG_ENDPOINT);
    if ($remote !== null) {
        @file_put_contents($cacheFile, json_encode($remote, JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR), LOCK_EX);
        return $catalog = $remote;
    }

    return $catalog = ($cached ?? $fallback);
}

function valid_plan_catalog(mixed $catalog): bool
{
    return is_array($catalog)
        && isset($catalog['plans']['free']['limits'], $catalog['plans']['premium']['prices']);
}

function read_plan_catalog_cache(string $file): ?array
{
    if (!is_file($file)) {
        return null;
    }
    $decoded = json_decode((string) @file_get_contents($file), true);
    return valid_plan_catalog($decoded) ? $decoded : null;
}

function fetch_plan_catalog(string $endpoint): ?array
{
    if (!function_exists('curl_init')) {
        return null;
    }

    $curl = curl_init($endpoint);
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT_MS => 800,
        CURLOPT_TIMEOUT_MS => 1500,
        CURLOPT_HTTPHEADER => ['Accept: application/json'],
        CURLOPT_USERAGENT => 'EVSmartRoute-Website/1.0',
    ]);
    $body = curl_exec($curl);
    $status = (int) curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
    if (!is_string($body) || $status !== 200) {
        return null;
    }

    $envelope = json_decode($body, true);
    $data = is_array($envelope) ? ($envelope['data'] ?? null) : null;
    return valid_plan_catalog($data) ? $data : null;
}

function plan_limit(string $name): int|float|null
{
    return load_plan_catalog()['plans']['free']['limits'][$name] ?? null;
}

function plan_price(string $period): array
{
    return load_plan_catalog()['plans']['premium']['prices'][$period]
        ?? ['amount' => 0.0, 'currency' => 'EUR', 'interval' => $period];
}

function plan_copy(string $text): string
{
    $catalog = load_plan_catalog();
    $limits = $catalog['plans']['free']['limits'];
    $monthly = $catalog['plans']['premium']['prices']['monthly'];
    $yearly = $catalog['plans']['premium']['prices']['yearly'];
    $format = static fn (int|float $value): string => fmod((float) $value, 1.0) === 0.0
        ? (string) (int) $value
        : rtrim(rtrim(number_format((float) $value, 2, '.', ''), '0'), '.');

    return strtr($text, [
        '{{free.max_route_km}}' => $format((float) $limits['max_route_km']),
        '{{free.daily_routes}}' => (string) (int) $limits['daily_routes'],
        '{{free.garage_cars}}' => (string) (int) $limits['garage_cars'],
        '{{free.saved_routes}}' => (string) (int) $limits['saved_routes'],
        '{{premium.monthly_price}}' => number_format((float) $monthly['amount'], 2, '.', ''),
        '{{premium.yearly_price}}' => number_format((float) $yearly['amount'], 2, '.', ''),
        '{{premium.yearly_month_equivalent}}' => number_format((float) $yearly['amount'] / 12, 2, '.', ''),
    ]);
}
