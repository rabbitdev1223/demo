<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthenController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('pages.home');
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/logout', [HomeController::class, 'logout']);

Route::get('/user-profile', [UsersController::class, 'getProfile']);
Route::post('/user-profile', [UsersController::class, 'updateProfile']);
Route::post('/user-password', [UsersController::class, 'updatePassword']);
Route::post('/user-email', [UsersController::class, 'updateEmail']);

// Route::get('/:any', function ()
// {
//     return redirect('/home');
// })
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

?>