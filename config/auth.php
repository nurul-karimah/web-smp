<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    // GUARDS
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'guru' => [
            'driver' => 'session',
            'provider' => 'gurus',
        ],

        'orangtua' => [
            'driver' => 'session',
            'provider' => 'orangtuas',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],

    // PROVIDERS
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'gurus' => [
            'driver' => 'eloquent',
            'model' => App\Models\Guru::class,
        ],

        'orangtuas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Orangtua::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],

    // RESET PASSWORD
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'gurus' => [
            'provider' => 'gurus',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'orangtuas' => [
            'provider' => 'orangtuas',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
