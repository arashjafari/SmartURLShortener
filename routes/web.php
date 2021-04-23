<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;

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

Route::get('/', [MainController::class, 'showHomePage'])->name('homepage');
Route::post('create', [LinkController::class, 'create'] )->name('create');

Route::name('user.')->prefix('user')->middleware('auth')->group(function () {
    Route::get('dashboard', [UserController::class, 'showDashboardPage'])->name('dashboard');
    Route::get('{id}/stats', [UserController::class, 'showLinkStatsPage'])->name('stats');
});

Route::get('{short}', [LinkController::class, 'short2Long'])->where('short', '[A-Za-z0-9\-]{3,}');
