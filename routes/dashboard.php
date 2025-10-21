<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ImportProductsController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\RoleController;

Route::group([
    'middleware' => ['auth:admin','last_active','update_notification_status'],
    'as' => 'dashboard.',
    'prefix' => '/admin/dashboard',
    //'namespace' => 'App\Http\Controllers\Dashboard',
], function () {

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');



    // Route::get('/categories/{category}', [CategoriesController::class, 'show'])
    //     ->name('categories.show')
    //     ->where('category', '\d+');

    Route::get('/categories/trash/search', [CategoryController::class, 'trash'])
        ->name('categories.trash');
    Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])
        ->name('categories.restore');
    Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])
        ->name('categories.force-delete');

    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/roles', RoleController::class);

    // Route::get('products/import', [ImportProductsController::class, 'create'])
    //     ->name('products.import');
    // Route::post('products/import', [ImportProductsController::class, 'store']);

    // Route::resources([
    //     'products' => ProductsController::class,
    //     'categories' => CategoriesController::class,
    //     'roles' => RolesController::class,
    //     'users' => UsersController::class,
    //     'admins' => AdminsController::class,
    // ]);
});

// Route::middleware('auth')->as('dashboard.')->prefix('dashboard')->group(function() {

// });
