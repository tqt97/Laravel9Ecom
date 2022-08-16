<?php

use App\Http\Controllers\Admin\AttachPermissionToRoleController;
// use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Admin\DeleteImageController;
use App\Http\Controllers\Admin\DetachPermissionFromRoleController;
use App\Http\Controllers\Admin\PermissionController;
// use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\RoleController;
// use App\Http\Controllers\Admin\UploadImagesController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::post('roles/attach-permission', AttachPermissionToRoleController::class)->name('roles.attach-permission');
    Route::post('roles/detach-permission', DetachPermissionFromRoleController::class)->name('roles.detach-permission');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
    // Route::resource('categories', CategoriesController::class);
    // Route::resource('products', ProductsController::class);
    // Route::post('upload-images', UploadImagesController::class)->name('images.store');
    // Route::post('delete-images', DeleteImageController::class)->name('images.destroy');
});

require __DIR__ . '/auth.php';
