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
Route::group(['prefix' => 'developer-section'], function () {
    Route::get('/', [DeveloperSectionController::class, 'index'])->name('developer-section.index');
    Route::post('/', [DeveloperSectionController::class, 'submit'])->name('developer-section.submit');
    Route::post('/bug-update-setting', [DeveloperSectionController::class, 'bugUpdateSetting'])->name('bug-update-setting.submit');
    Route::post('/version-upgrade-setting', [DeveloperSectionController::class, 'versionUpgradeSetting'])->name('version-upgrade-setting.submit');
});

Route::get('/new-release', [ClientAutoUpdateController::class, 'newVersionReleasePage'])->name('new-release');
Route::get('/bugs', [ClientAutoUpdateController::class, 'bugUpdatePage'])->name('bug-update-page');
// Action on Client server
Route::post('version-upgrade', [ClientAutoUpdateController::class, 'versionUpgrade'])->name('version-upgrade');
Route::post('bug-update', [ClientAutoUpdateController::class, 'bugUpdate'])->name('bug-update');
