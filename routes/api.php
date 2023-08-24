<?php

use Illuminate\Support\Facades\Route;
use IrfanChowdhury\VersionElevate\Http\Controllers\DemoAutoUpdateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('fetch-data-general', [DemoAutoUpdateController::class, 'fetchDataGeneral'])->name('fetch-data-general');
Route::get('fetch-data-upgrade', [DemoAutoUpdateController::class, 'fetchDataForAutoUpgrade'])->name('data-read');
Route::get('fetch-data-bugs', [DemoAutoUpdateController::class, 'fetchDataForBugs'])->name('fetch-data-bugs');

