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
    'cmp_enabled' => false,
    'enabled' => false,
    'provider' => 'adsense',
    'client' => 'ca-pub-7481074142505098',
    'test_mode' => false,
    'slots' => [
        'home_after_simulator' => '6464491051',
        'home_before_pricing' => '3247566705',
    ],
];
