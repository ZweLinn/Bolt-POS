<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin' , 'middleware' => ['auth' , 'admin']], function () {
    Route::get('/home' , [AdminController::class, 'adminHome'])->name('adminHome');

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'categoryList'])->name('category#list');
    });
});