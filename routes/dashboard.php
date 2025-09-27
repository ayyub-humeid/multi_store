<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth','verified'])
->prefix('dashboard/')
->group(function () {
    Route::get('',[DashboardController::class,'index'])->name('dashboard');
    Route::get('categories/trash',[CategoryController::class,'trash'])->name('categories.trash');

    Route::resource('categories',CategoryController::class);
    Route::put('categories/{category}/restore',[CategoryController::class,'restore'])->name('categories.restore');
    Route::delete('categories/{category}/force_delete',[CategoryController::class,'force_delete'])->name('categories.force_delete');
    //product
    Route::resource('products',ProductController::class);
    Route::get('profile/edit',[ProfileController::class,'edit'])->name('dashboard.profile.edit');

});
