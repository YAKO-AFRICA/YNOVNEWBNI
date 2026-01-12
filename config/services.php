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

    'sign_api' => env('SIGN_API'),
    'otp_api' => env('OTP_API'),
    'base_url_api' => env('BASE_URL_API'),

    'api' => [
        'encaissement_bis' => env('API_ENCAISSEMENT_BIS'),
        'filiations' => env('API_FILIATIONS'),
    ],

    'touchpay' => [
        'agency_code' => env('TOUCHPAY_AGENCY_CODE'),
        'secure_code' => env('TOUCHPAY_SECURE_CODE'),
    ],


    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
