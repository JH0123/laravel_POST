<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Setting\BoardController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'rhksfl.',
    'middleware' => ['level:admin'],
], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::group([
        'prefix' => 'setting',
    ], function () {
        Route::resource('board-infos', BoardController::class);
    });
});
