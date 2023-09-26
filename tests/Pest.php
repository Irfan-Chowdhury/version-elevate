<?php

use Orchestra\Testbench\PHPUnit\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
| ./vendor/bin/pest --filter FaqTest
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(
    // PHPUnit\Framework\TestCase::class,
    // Orchestra\Testbench\PHPUnit\TestCase::class,
    // PHPUnit\Framework\TestCase::class,
    IrfanChowdhury\VersionElevate\Traits\AutoUpdateTrait::class,
)->in('Feature');

uses(
    IrfanChowdhury\VersionElevate\Traits\AutoUpdateTrait::class,
)->in('Unit');

uses(Orchestra\Testbench\PHPUnit\TestCase::class)->in(__DIR__);

function generalData(): array
{
    return [
        '_token'=> 'OpxytnHTw67kMF3Q5A6U014DbJ4pCBV71gtH8Zm1',
        'product_mode' => 'DEVELOPER',
        'minimum_required_version' => '1.2.0',
        'version' => '1.2.3',
        'latest_version_upgrade_enable' => true,
        'latest_version_db_migrate_enable' => false,
        'version_upgrade_base_url' => 'https://peopleprohrm.com/version_upgrade_files/',
    ];
}
