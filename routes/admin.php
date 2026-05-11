<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin' , 'middleware' => ['auth' , 'admin']], function () {
    Route::get('/home' , [AdminController::class, 'adminHome'])->name('adminHome');

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'categoryList'])->name('category#list');
        Route::post('/create', [CategoryController::class, 'createCategory'])->name('category#create');
        Route::get('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category#delete');
        Route::get('/edit/{id}', [CategoryController::class, 'editCategory'])->name('category#edit');
        Route::post('/update', [CategoryController::class, 'updateCategory'])->name('category#update');
    });


});