<?php

use Illuminate\Support\Facades\Route;
use IrfanChowdhury\VersionElevate\Http\Controllers\DeveloperSectionController;
use IrfanChowdhury\VersionElevate\Http\Controllers\ClientAutoUpdateController;
use IrfanChowdhury\VersionElevate\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/version-elevate-dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Auto Update
Route::controller(DeveloperSectionController::class)->group(function () {
    Route::prefix('developer-section')->group(function () {
        Route::get('/', 'index')->name('developer-section.index');
        Route::post('/', 'submit')->name('developer-section.submit');
        Route::post('/version-upgrade-setting', 'versionUpgradeSetting')->name('version-upgrade-setting.submit');
    });
});

Route::controller(ClientAutoUpdateController::class)->group(function () {
    Route::get('/new-release', 'newVersionReleasePage')->name('new-release');
    Route::post('version-upgrade', 'versionUpgradeProcees')->name('version-upgrade');
});
