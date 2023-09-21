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
    IrfanChowdhury\VersionElevate\Traits\AutoUpdateTrait::class,
)->in('Feature');

uses(
    IrfanChowdhury\VersionElevate\Traits\AutoUpdateTrait::class,
)->in('Unit');

uses(TestCase::class)->in(__DIR__);
