<?php

use Framework\Extensions\FlashExtension;
use Framework\Extensions\FormExtension;
use Framework\Extensions\TwigRouteExtension;

return [

    'twig' => [
        'paths' => dirname(__DIR__) . '/views',
        'cache' => false,  // __DIR__ . '/cache',
        'extensions' => [
            TwigRouteExtension::class,
            FormExtension::class,
            FlashExtension::class
        ]
    ],
];