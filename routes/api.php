<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\SkladController;
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
        Route::post('/new', [SkladController::class, 'create']);
        Route::put('/update/{id}', [SkladController::class, 'update']);
    });
});
