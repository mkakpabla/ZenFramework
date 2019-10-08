<?php
return [

    'mail' => [
        'driver'    => env('MAIL_DRIVER', 'smtp'),
        'host'      => env('MAIL_HOST', 'localhost'),
        'port'      => env('MAIL_PORT', 1025),
        'username'  => env('MAIL_USERNAME'),
        'password'  => env('MAIL_PASSWORD'),
    ]

];