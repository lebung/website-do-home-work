<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SectionController;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Route;


/**
 * Users Role Route
 */

Route::prefix('admin/sections')->middleware(['auth','verified','role:admin|teacher'])->name('admin.section.')->group(function () {
    Route::get('/add', [SectionController::class, 'create'])->name('create');
    Route::post('/add', [SectionController::class, 'store'])->name('store');
    Route::get('/{section}', [SectionController::class, 'edit'])->name('edit');
    Route::put('/{section}', [SectionController::class, 'update'])->name('update');
    Route::delete('/{section}', [SectionController::class, 'destroy'])->name('delete');
    Route::get('/{course}/sort', [SectionController::class, 'sort'])->name('sort');
    Route::patch('/{course}/sort', [SectionController::class, 'processSort'])->name('processSort');
});