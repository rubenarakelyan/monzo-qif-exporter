<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'monzo' => [
        'client_id' => env('MONZO_CLIENT_ID'),
        'client_secret' => env('MONZO_CLIENT_SECRET'),
        'redirect_uri' => env('MONZO_REDIRECT_URI'),
    ],

];
