<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'user.'], function () {
    Route::post('register', 'Auth\LoginController@register')->name('register');
    Route::post('login', 'Auth\LoginController@login')->name('login');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::prefix('team')->name('team.')->group(function () {
            Route::get('/', 'TeamController@index')->name('index');
            Route::put('/update', 'TeamController@update')->name('update');

        });

        Route::prefix('tournament')->name('tournament.')->group(function () {
            Route::get('/', 'TournamentController@index')->name('index');
            Route::get('/leaderboard/{id}', 'TournamentController@leaderboard')->name('leaderboard');

        });

        Route::prefix('matches')->name('match.')->group(function () {
            Route::get('/', 'MatchController@index')->name('index');
            Route::get('/live/{id}', 'MatchController@scores')->name('live');

        });
    });
});
