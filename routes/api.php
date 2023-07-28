<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;

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
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});


Route::group(['prefix' => 'settings'], function () {
    Route::post('/insertOrupdate', [SettingsController::class, 'store']);
    Route::get('/list', [SettingsController::class, 'getSettingList']);
});

Route::group(['prefix' => 'user'], function () {
    Route::post('/insertOrupdate', [UserController::class, 'store']);
    Route::get('/getUserList', [UserController::class, 'getUserList']);
}); 