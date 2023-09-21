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

        /*
        |--------------------------------------------------------------------------
        | Files Directory Name
        |--------------------------------------------------------------------------
        |
        | For version upgrade, you need to keep relevant files in a directory on your server.
        | If your website url is www.xyz.com, and file directory name is "updated_files",
        | then your url will be "www.xyz.com/updated_files"
        |
        */
        'directory_name' => env('DIRECTORY_NAME',''),

    ];


