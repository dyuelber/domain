<?php

use App\Http\Controllers\v1\DomainController;
use App\Http\Controllers\v1\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::prefix('tokens')->group(function () {
        Route::get('/abilities', [TokenController::class, 'index']);
        Route::put('/', [TokenController::class, 'store']);
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::prefix('domains')->group(function () {
            Route::put('/', [DomainController::class, 'store']);
            Route::post('/', [DomainController::class, 'update']);
        });
    });
});
