<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\ForgotController;
use App\Http\Livewire\Admin\UserComponent;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth','verified','role:admin'])->name('admin.')->group(function () {
    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('list-user');
        Route::get('/edit-user', [UserController::class, 'editUser'])->name('edit-user');
        Route::get('edit', [UserController::class, 'editUser'])->name('edit');
        Route::get('list', [UserController::class, 'showUser'])->name('show-user');

        Route::get('export/{user}', [UserController::class, 'exportUser'])->name('export-user');

    
    });
    Route::prefix('role')->middleware(['auth','verified','role:admin'])->name('role.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('list-role');
        Route::get('/create-role', [RoleController::class, 'createRole'])->name('create-role');
        Route::post('/post-role', [RoleController::class, 'processRole'])->name('post-role');
    });
    Route::prefix('permission')->middleware(['auth','verified','role:admin'])->name('permission.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('list-permission');
        Route::get('/create-permission', [PermissionController::class, 'createPermission'])->name('create-permission');
        Route::post('/post-permission', [PermissionController::class, 'processPermission'])->name('post-permission');
    });
});

