<?php

use Illuminate\Support\Facades\Route;
use Domains\Category\Http\Controllers\CategoryController;

Route::controller(CategoryController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});
