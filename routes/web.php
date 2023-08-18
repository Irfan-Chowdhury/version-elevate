<?php

use Illuminate\Support\Facades\Route;
use IrfanChowdhury\VersionElevate\Http\Controllers\DeveloperSectionController;

// Route::get('/test', function () {
//     return 12;
// });

Route::get('/test', [DeveloperSectionController::class, 'index']);
