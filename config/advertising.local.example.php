<?php

declare(strict_types=1);

/**
 * Copy to advertising.local.php on the production server.
 * Publisher and slot identifiers are available in the AdSense dashboard.
 */
return [
    'enabled' => true,
    'client' => 'ca-pub-0000000000000000',
    'test_mode' => true,
    'slots' => [
        'home_after_simulator' => '0000000000',
        'home_before_pricing' => '0000000001',
    ],
];
