<?php

use App\Module\Http\Controllers\DistributeController;
use Illuminate\Support\Facades\Route;
use App\Module\Http\Controllers\StayAliveController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('')->group(function () {
    Route::get('stay-alive', [StayAliveController::class, 'index']);
    Route::get('distribute', [DistributeController::class, 'index']);
});
