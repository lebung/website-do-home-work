<?php

use App\Http\Controllers\admin\QuestionAnswerController;
use Illuminate\Support\Facades\Route;


/**
 * Users Role Route
 */
// Route::prefix('admin/')->name('admin.')->group(function(){
    Route::prefix('question')->middleware(['auth','verified','role:admin|teacher'])->name('question.')->group(function () {
        Route::get('list',[QuestionAnswerController::class,'index'])->name('list');

        Route::get('create/{type}',[QuestionAnswerController::class,'create'])->name('create');
        Route::post('store',[QuestionAnswerController::class,'store'])->name('store');

        Route::get('update/{id}',[QuestionAnswerController::class,'update'])->name('update');
        Route::post('edit',[QuestionAnswerController::class,'edit'])->name('edit');

        Route::delete('destroy/{id}',[QuestionAnswerController::class,'destroyAnswer'])->name('destroy');
        Route::delete('destroy-question/{id}',[QuestionAnswerController::class,'destroyQuestion'])->name('destroyQuestion');

        Route::get('datalist/{sort}/{title}',[QuestionAnswerController::class,'datalist'])->name('datalist');
    });

