<?php

return
    [
        'product_mode' => env('PRODUCT_MODE'),

        /*
        |--------------------------------------------------------------------------
        | Version Number
        |--------------------------------------------------------------------------
        |
        | You have to follow standard version number format (X.Y.Z) such as version 1.2.4
        | Put the version env('VERSION')
        |
        */

        'version' => env('VERSION','1.0.0'),

        /*
        |--------------------------------------------------------------------------
        | Domain URL
        |--------------------------------------------------------------------------
        |
        | You have to setup your domain name before using this package
        |
        */

        'domain_url' => env('DOMAIN_URL','https://your_domain.com'),

    ];


