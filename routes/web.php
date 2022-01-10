<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */


    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
   
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/create_password', 'UserController@create_password')->name('create_password');
        Route::post('/password_init', 'UserController@password_init')->name('password.init');
 
    });
    

    Route::group(['middleware' => ['auth','password.init']], function() {
        /**
         * Logout Routes
         */

        Route::get('/', 'HomeController@index')->name('index');
       
        /**
         * Verification Routes
         */
        Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
        Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');
        
        //edit profile
        Route::get('/edit_profile', 'HomeController@editProfile')->name('profile.show');
        Route::post('/update_profile', 'HomeController@updateProfile')->name('profile.update');

        //for parots functionalities
        Route::get('/parot/create', 'ParotController@create')->name('parot.create');
        Route::post('/parot', 'ParotController@store')->name('parot.save');

        Route::group(['middleware' => ['role:1']], function() {
            //super admin
            Route::get('/users', 'UserController@index')->name('user.index');
            Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
            Route::get('/user/{id}/show', 'UserController@show')->name('user.show');
            Route::get('/user/create', 'UserController@create')->name('user.create');
        });
    });

   
    Route::group(['middleware' => ['auth','verified']], function() {
        /**
         * Dashboard Routes
         */
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
    });
});
