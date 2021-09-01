<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'rhsfl.',
    'middleware' => ['level:admin'],
], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::group([
        'prefix' => 'setting',
    ], function () {
        Route::resource('goard-infos', BoardController::class);
    });
});
