<?php

use Illuminate\Support\Facades\Route;
use IrfanChowdhury\VersionElevate\Http\Controllers\DeveloperSectionController;

// Route::get('/test', function () {
//     return 12;
// });

Route::group(['prefix' => 'developer-section'], function () {
    Route::get('/', [DeveloperSectionController::class, 'index'])->name('developer-section.index');
    Route::post('/', [DeveloperSectionController::class, 'submit'])->name('developer-section.submit');
    Route::post('/bug-update-setting', [DeveloperSectionController::class, 'bugUpdateSetting'])->name('bug-update-setting.submit');
    Route::post('/version-upgrade-setting', [DeveloperSectionController::class, 'versionUpgradeSetting'])->name('version-upgrade-setting.submit');
});
