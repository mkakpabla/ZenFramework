<?php
return [

    'mail' => [
        'driver'    => getenv('MAIL_DRIVER') ?: 'smtp',
        'host'      => getenv('MAIL_HOST') ?: 'localhost',
        'port'      => getenv('MAIL_PORT') ?: 1025,
        'username'  => getenv('MAIL_USERNAME'),
        'password'  => getenv('MAIL_PASSWORD'),
    ]

];