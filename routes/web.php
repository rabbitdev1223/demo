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

Route::group(['namespace' => 'App\Http\Controllers\Admin'], function()
{   
    /**
     * Home Routes
     */

    Route::post('/password_init', 'UserController@password_init')->name('password.init');
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

       Route::get('forgot-password/{token}', 'UserController@forgotPasswordValidate')->name('forgotPasswordValidate');
       Route::get('reset-password', 'UserController@resetPassword')->name('reset-password');
       Route::put('reset-password', 'UserController@updatePassword')->name('update-password');
       
       
    });
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
   
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/create_password', 'UserController@create_password')->name('create_password');
        
 
    });
    

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */

        /**
         * Verification Routes
         */
        Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
        Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');
        
        Route::group(['middleware' => ['verified','password.init']], function() {

            Route::get('/', 'HomeController@index')->name('index');
            Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
            Route::view('verification/success', 'verification.success');

            //edit profile
            Route::get('/edit_profile', 'HomeController@editProfile')->name('profile.show');
            Route::post('/update_profile', 'HomeController@updateProfile')->name('profile.update');

            //for parots functionalities
            Route::prefix('parrot')->group(function (){
                Route::get('create', 'ParrotController@create')->name('parrot.create');
                Route::get('{id}', 'ParrotController@show')->name('parrot.show');
                Route::get('{id}/edit', 'ParrotController@edit')->name('parrot.edit');
                Route::post('', 'ParrotController@store')->name('parrot.save');
                Route::get('', 'ParrotController@index')->name('parrot.index');

                //for ajax api
                Route::post('{id}/delete','ParrotController@destroy')->name('parrot.destroy');
            });

            //for parots functionalities
            Route::prefix('couple')->group(function (){
                Route::get('create', 'CoupleController@create')->name('couple.create');
                Route::get('{id}', 'CoupleController@show')->name('couple.show');
                Route::get('{id}/edit', 'CoupleController@edit')->name('couple.edit');
                Route::post('', 'CoupleController@store')->name('couple.save');
                Route::get('', 'CoupleController@index')->name('couple.index');

                //for ajax api
                Route::post('{id}/delete','CoupleController@destroy')->name('couple.destroy');
            });
            
            Route::group(['prefix'=>'user', 'middleware' => ['role:1']], function() {
                //super admin
                Route::get('', 'UserController@index')->name('user.index');
                Route::get('{id}/edit', 'UserController@edit')->name('user.edit');
                Route::get('{id}/show', 'UserController@show')->name('user.show');
                Route::get('create', 'UserController@create')->name('user.create');
            });
        });
    });

   
    // Route::group(['middleware' => ['auth','verified']], function() {
    //     /**
    //      * Dashboard Routes
    //      */
       
    // });
});
