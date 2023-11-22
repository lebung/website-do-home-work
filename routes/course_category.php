<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseCategoryController;

/**
 * Users Role Route
 */

Route::prefix('admin/course_category')->middleware('auth')->name('course_category.')->group(function () {
    Route::get('/',[CourseCategoryController::class,'index'])->name('list');
    Route::post('/store',[CourseCategoryController::class,'store']);
    Route::post('/update',[CourseCategoryController::class,'update']);
    Route::get('course_category/delete/{course_category}',[CourseCategoryController::class,'destroy'])->name('delete');
    Route::get('/search_course_category',[CourseCategoryController::class,'search']);

});
