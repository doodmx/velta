<?php

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

//User Unauthenticated Routes


Route::prefix('users')->group(function () {
    Route::post('login', 'Auth\LoginController@login')->name('api.login');
    Route::post('register', 'Auth\RegisterController@register')->name('api.register');
    Route::post('/validateEmail', 'User\UserController@validateEmail')->name('api.users.validateEmail');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
});


Route::middleware(['auth:api'])->group(function () {

    Route::get('/plans', 'Investment\PlanController@allActive')->name('api.plans.index');
    Route::get('/investments', 'Investment\InvestmentController@allByStatus')->name('api.investments.index');
    Route::get('/investments/{id}/transactions', 'Investment\InvestmentController@showTransactions')->name('api.investment.transactions');


    Route::prefix('users')->group(function () {
        Route::get('logout', 'Auth\LoginController@logout')->name('api.users.logout');

        Route::get('{id}', 'User\UserController@showById')->name('api.users.show');
        Route::patch('{id}', 'User\UserController@updateProfile')->name('api.users.update');
        Route::patch('{id}/credentials', 'User\UserController@resetCredentials')->name('api.users.credentials');
        Route::post('{id}/validateCurrentPassword', 'User\UserController@validateCurrentPassword');
    });


});
