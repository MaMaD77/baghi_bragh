<?php
return [
    'admin-password' => env('ADMIN_PASSWORD', 'Devistan@2024'),

    'description' => env('APP_DESCRIPTION', 'Printing & Packaging Solutions'),

    'default-currency-symbol' => env('DEFAULT_CURRENCY_SYMBOL', '$'),
    'default-currency-step' => env('DEFAULT_CURRENCY_STEP', '0.01'),
    'default-currency-precision' => env('DEFAULT_CURRENCY_PRECISION', '2'),

    'default-latitude' => env('DEFAULT_LATITUDE', 36.1911),
    'default-longitude' => env('DEFAULT_LONGITUDE', 44.0095),

    'phone-1' => '+964 750 100 8885',
    'phone-2' => '+964 770 990 8885',
    'email-1' => 'info@fabyab.co',
    'email-2' => '',
    'address-1' => 'Makhmour Road',
    'address-2' => 'Erbil, Iraq',

    'developed-by-name' => 'Pixel',
    'developed-by-url' => 'https://pixeliq.co',
    'developed-at' => '2023',

    'favicon' => 'favicon.ico',
    'favicon-32x32' => 'favicon-32x32.png',
    'favicon-16x16' => 'favicon-16x16.png',
    'apple-touch-icon' => 'apple-touch-icon.png',
    'android-chrome-192x192' => 'android-chrome-192x192.png',
    'android-chrome-384x384' => 'android-chrome-384x384.png',
    'safari-pinned-tab' => 'safari-pinned-tab.svg',
    'webmanifest' => 'site.webmanifest',
    'theme-color' => '#ffffff',
    'brand-color' => '#ffffff',

    'brandmark-dark' => 'brandmark.png',
    'brandmark-light' => 'brandmark.png',
    'wordmark-dark' => 'wordmark.png',
    'wordmark-light' => 'wordmark.png',
    'invoice-logo' => 'wordmark.png',
    'no-image' => 'brandmark.png',

    'social-accounts' => [
        [
            'title' => 'Facebook',
            'color' => 'btn-light-facebook',
            'icon' => 'fab fa-facebook-f',
            'link' => 'https://www.facebook.com/Fabyab.co',
            'image_link' => 'https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-outline-circle-default-gray/facebook@2x.png',
        ],
        [
            'title' => 'Instagram',
            'color' => 'btn-light-instagram',
            'icon' => 'fab fa-instagram',
            'link' => 'https://www.instagram.com/fabyab.co/',
            'image_link' => 'https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-outline-circle-default-gray/instagram@2x.png',
        ]
    ],

    'locales' => [
        [
            'code' => 'en',
            'name' => 'English',
            'dir' => 'ltr',
            'img' => 'assets/images/flags/icons8-usa-48.png',
        ],
        // [
        //     'code' => 'ar',
        //     'name' => 'Arabic',
        //     'dir' => 'rtl',
        //     'img' => 'assets/images/flags/icons8-iraq-48.png',
        // ],
    ],
];
