<?php

declare(strict_types=1);

/** Returns the merged, deployment-aware advertising configuration. */
function advertising_config(): array
{
    static $config = null;
    if (is_array($config)) {
        return $config;
    }

    $configPath = PROJECT_ROOT . '/config/advertising.php';
    $localPath = PROJECT_ROOT . '/config/advertising.local.php';
    $config = is_file($configPath) ? (array) require $configPath : [];

    if (is_file($localPath)) {
        $config = array_replace_recursive($config, (array) require $localPath);
    }

    return $config;
}

/** Exposes only non-secret values required by the browser ad loader. */
function advertising_public_config(): array
{
    $config = advertising_config();
    $client = trim((string) ($config['client'] ?? ''));
    $enabled = ($config['enabled'] ?? false) === true
        && ($config['provider'] ?? '') === 'adsense'
        && preg_match('/^ca-pub-\d{16}$/', $client) === 1;

    return [
        'enabled' => $enabled,
        'provider' => 'adsense',
        'client' => $enabled ? $client : '',
        'testMode' => $enabled && ($config['test_mode'] ?? false) === true,
    ];
}

/**
 * Renders a reserved slot without loading any third-party code. The matching
 * ad is created by ads.js only after explicit advertising consent.
 */
function render_ad_slot(string $name, string $modifier = ''): void
{
    $publicConfig = advertising_public_config();
    $config = advertising_config();
    $slotId = trim((string) ($config['slots'][$name] ?? ''));

    if (!$publicConfig['enabled'] || preg_match('/^\d+$/', $slotId) !== 1) {
        return;
    }

    $classes = trim('ad-placement ' . $modifier);
    ?>
    <aside class="<?= e($classes) ?>" data-ad-placement data-ad-slot="<?= e($slotId) ?>" aria-label="<?= e(t('advertising.sponsored')) ?>" hidden>
        <div class="container ad-placement__container">
            <span class="ad-placement__label"><?= e(t('advertising.sponsored')) ?></span>
            <div class="ad-placement__surface" data-ad-surface></div>
        </div>
    </aside>
    <?php
}
