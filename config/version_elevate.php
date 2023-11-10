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

        'version' => env('VERSION','0.0.0'),

        /*
        |--------------------------------------------------------------------------
        | Target URL
        |--------------------------------------------------------------------------
        |
        | You have to setup your Target URL before using this package
        |
        */

        'target_url' => env('TARGET_URL',''),
    ];



