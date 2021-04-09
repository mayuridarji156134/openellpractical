<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'domain' => 'http://localhost:8000/',
    'facebook' => [
        'client_id' => '1795697137271906',
        'client_secret' => 'c2cb5babb6506c498fd695e936f0084a',
        'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => '664509118474-2v00leqe5gip6h6e9lehenc6shpvppus.apps.googleusercontent.com',
        'client_secret' => 'Bp5y0E7ENJnBx9AEzB-0RXGb',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],

];
