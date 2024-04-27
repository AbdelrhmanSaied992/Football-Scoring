<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;

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

Route::get('login', function () {

    return view('admin.login');
})->name('admin.login');

Route::get('/', 'App\Http\Controllers\Admin\Auth\LoginController@redirectToLogin')->name('admin.index');
Route::get('/admin', 'App\Http\Controllers\Admin\Auth\LoginController@redirectToLogin')->name('admin.index');

Route::post('login', 'App\Http\Controllers\Admin\Auth\LoginController@login')->name('login.store');

Route::post('logout', 'App\Http\Controllers\Admin\Auth\LoginController@logout')->name('admin.logout');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/dashboard', 'App\Http\Controllers\Admin\Auth\DashboardController@index')->name('admin.dashboard');

});
