<?php

return
    [
        'product_mode' => env('PRODUCT_MODE'),

        'version' => env('VERSION'),

        // 'bug_no' => env('BUG_NO'),
        'demo_url' => 'https://peopleprohrm.com/demo/api',
        'domain_url' => 'https://peopleprohrm.com/demo',

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
        'directory_name' => 'version_upgrade_files',
    ];
?>
