<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Domain\DomainController;
use App\Http\Controllers\User\TokenController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckJsonResultsController;

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

Route::get('/health', HealthCheckJsonResultsController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::post('accounts', [AccountController::class, 'store']);

    Route::middleware(['auth:sanctum', 'ability:basic-user'])->group(function () {
        Route::apiResource('abilities', TokenController::class);

        Route::apiResource('domains', DomainController::class)->middleware('ability:domains');

        Route::apiResource('users', UserController::class)->middleware('ability:users');
    });
});
