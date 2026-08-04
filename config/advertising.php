<?php

declare(strict_types=1);

/**
 * Safe advertising defaults.
 *
 * Advertising is deliberately disabled in source control. Production enables
 * it through advertising.local.php after AdSense and the consent flow are
 * approved and configured.
 */
return [
    'enabled' => false,
    'provider' => 'adsense',
    'client' => '',
    'test_mode' => false,
    'slots' => [
        'home_after_simulator' => '',
        'home_before_pricing' => '',
    ],
];
