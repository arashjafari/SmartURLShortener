<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', 'MainController@showHomePage')->name('homepage');
Route::post('create', 'LinkController@create' )->name('create');

Route::name('user.')->prefix('user')->middleware('auth')->group(function () {
    Route::get('dashboard', 'UserController@showDashboardPage')->name('dashboard');
    Route::get('{id}/stats', 'UserController@showLinkStatsPage')->name('stats');
});

Route::get('{short}', 'LinkController@short2Long')->where('short', '[A-Za-z0-9\-]{3,}');
