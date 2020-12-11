<?php

use App\Module\Http\Controllers\DistributeController;
use App\Module\Http\Controllers\HealthCheckController;
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
    Route::get('healthcheck', [HealthCheckController::class, 'index']);
    Route::get('stay-alive', [StayAliveController::class, 'index']);
    Route::post('distribute', [DistributeController::class, 'index']);
});
