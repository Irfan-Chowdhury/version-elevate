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


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Auto Update
Route::controller(DeveloperSectionController::class)->group(function () {
    Route::prefix('developer-section')->group(function () {
        Route::get('/', 'index')->name('developer-section.index');
        Route::post('/', 'submit')->name('developer-section.submit');
        Route::post('/bug-update-setting', 'bugUpdateSetting')->name('bug-update-setting.submit');
        Route::post('/version-upgrade-setting', 'versionUpgradeSetting')->name('version-upgrade-setting.submit');
    });
});


Route::controller(ClientAutoUpdateController::class)->group(function () {
    Route::get('/new-release', 'newVersionReleasePage')->name('new-release');
    Route::get('/bugs', 'bugUpdatePage')->name('bug-update-page');
    // Action on Client server
    Route::post('version-upgrade', 'versionUpgrade')->name('version-upgrade');
    Route::post('bug-update', 'bugUpdate')->name('bug-update');
});
