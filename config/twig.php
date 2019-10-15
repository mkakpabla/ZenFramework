<?php

use Framework\View\FlashExtension;
use Framework\View\FormExtension;
use Framework\View\TwigRouteExtension;

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