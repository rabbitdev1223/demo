<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api;
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

Route::get('users', [UserController::class, 'getUsers']);
Route::post('user/{id}/setsuspend',[UserController::class, 'setSuspendStatus']);
Route::post('user/{id}/delete',[UserController::class, 'destroy']);
Route::post('user/{id}/setSuperadmin',[UserController::class, 'setSuperadmin']);
