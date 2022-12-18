<?php

use App\Http\Controllers\v1\DomainController;
use App\Http\Controllers\v1\TokenController;
use App\Http\Controllers\v1\UserController;
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
        Route::prefix('tokens')->group(function () {
            Route::post('/{id}', [TokenController::class, 'updateAbilities'])->middleware('ability:update-user');
        });

        Route::prefix('domains')->group(function () {
            Route::get('/', [DomainController::class, 'index'])->middleware('ability:list-domains');
            Route::put('/', [DomainController::class, 'store'])->middleware('ability:create-domain');
            Route::post('/{id}', [DomainController::class, 'update'])->middleware('ability:update-domain');
            Route::delete('/{id}', [DomainController::class, 'destroy'])->middleware('ability:delete-domain');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::put('/', [UserController::class, 'store']);
            Route::post('/{id}', [UserController::class, 'update']);
            //Route::delete('/{id}', [UserController::class, 'destroy']);
        });
    });
});
