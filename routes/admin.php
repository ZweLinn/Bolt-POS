<?php

use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserAccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

    Route::group(['prefix' => 'account'], function () {
        Route::group(['middleware' => 'normalAdmin'], function () {
            Route::get('add/newAdmin', [ProfileController::class, 'createAdminAccountPage'])->name('account#addAdmin');
            Route::post('add/newAdmin', [ProfileController::class, 'createAdminAccount'])->name('account#createAdmin');
            Route::get('adminList', [AdminAccountController::class, 'adminList'])->name('account#adminList');
            Route::delete('deleteAdmin/{id}', [AdminAccountController::class, 'deleteAdmin'])->name('account#deleteAdmin');
        });

        Route::get('userList', [UserAccountController::class, 'userAccountPage'])->name('account#userList');
        Route::delete('deleteUser/{id}', [UserAccountController::class, 'deleteUser'])->name('account#deleteUser');

        Route::group(['prefix' => 'payment'], function () {
            Route::get('/', [PaymentController::class, 'paymentList'])->name('payment#list');
            Route::post('/create', [PaymentController::class, 'createPayment'])->name('payment#create');
            Route::get('/delete/{id}', [PaymentController::class, 'deletePayment'])->name('payment#delete');
            Route::get('/edit/{id}', [PaymentController::class, 'editPayment'])->name('payment#edit');
            Route::post('/update', [PaymentController::class, 'updatePayment'])->name('payment#update');

        });
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/create', [ProductController::class, 'productCreatePage'])->name('product#createPage');
        Route::post('/create', [ProductController::class, 'createProduct'])->name('product#create');
    });




});