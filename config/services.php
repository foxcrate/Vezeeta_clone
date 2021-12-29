<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    // 'twilio'=> [
    //     'sid'   => env('TWILIO_SID'),
    //     'token' => env('TWILIO_AUTH_TOKEN'),
    // ]

    'facebook' => [
        'client_id' => '936502656872745',
        'client_secret' => 'd6aa0a1c358f7b97647c69c10e9aa007',
        'redirect' => 'https://phistory.life/public/callback/facebook'
    ],

    'google' => [
        'client_id' => '959883475680-trmrlorphs0c7uopevsdspfih6r92hfc.apps.googleusercontent.com',
        'client_secret' => 'ZCHHTeHxVsdMB_tyCIeuB4jS',
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],

];
