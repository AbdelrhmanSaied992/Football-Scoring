<?php

use App\Http\Controllers\Admin\MatchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TournamentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'admin','as' => 'admin.'], function () {
    Route::get('/dashboard', 'App\Http\Controllers\Admin\Auth\LoginController2@index')->name('admin.dashboard');

    Route::resource('teams', TeamController::class);
    Route::resource('tournaments', TournamentController::class);
    Route::resource('matches', MatchController::class);

});
