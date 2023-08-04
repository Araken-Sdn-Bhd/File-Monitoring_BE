<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\clientsController;
use App\Http\Controllers\FilesController;

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
    Route::post('reset', 'reset');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(SettingsController::class)->group(function () {
    Route::post('settingStore', 'settingStore');
    Route::get('settingList', 'settingList');
    Route::get('typeList', 'typeList');
    Route::get('{type}/typeSearchList', 'typeSearchList');
    Route::post('deleteSetting', 'deleteSetting');
    Route::get('getList', 'getList');

});

Route::controller(ClientsController::class)->group(function () {
    Route::post('clientStore', 'clientStore');
    Route::get('clientList', 'clientList');
    Route::get('{status}/statusSearchList', 'statusSearchList');

});

Route::group(['prefix' => 'user'], function () {
    Route::post('/insertOrupdate', [UserController::class, 'store']);
    Route::get('/getUserList', [UserController::class, 'getUserList']);
}); 

Route::controller(FilesController::class)->group(function () {
    Route::post('fileList', 'fileList');
});