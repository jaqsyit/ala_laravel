<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\BankController;
use App\Http\Controllers\V1\KezekController;
use App\Http\Controllers\V1\SkladActivityController;
use App\Http\Controllers\V1\SkladController;
use App\Http\Controllers\V1\UslugiController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'actionLoginUser']);

    Route::middleware('auth:api')->group(function (){
        Route::get('/me', [AuthController::class, 'actionCheckUser']);
        Route::get('/logout', [AuthController::class, 'actionLogoutUser']);

        Route::get('/tovars', [SkladController::class, 'index']);
        Route::post('/tovar', [SkladController::class, 'create']);
        Route::put('/tovar/{id}', [SkladController::class, 'update']);
        Route::delete('/tovar/{id}', [SkladController::class, 'destroy']);

        Route::get('/actives', [SkladActivityController::class, 'index']);

        Route::get('/kezek', [KezekController::class, 'index']);
        Route::post('/kezek', [KezekController::class, 'create']);
        Route::delete('/kezek/{id}', [KezekController::class, 'destroy']);

        Route::get('/uslugi', [UslugiController::class, 'index']);
        Route::post('/uslugi', [UslugiController::class, 'create']);
        Route::delete('/uslugi/{id}', [UslugiController::class, 'destroy']);

        Route::get('/bank', [BankController::class, 'index']);
    });
});
