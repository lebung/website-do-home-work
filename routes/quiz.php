<?php

use App\Http\Controllers\Admin\QuizController;
use Illuminate\Support\Facades\Route;


/**
 * Users Role Route
 */

 Route::prefix('admin/')->middleware(['auth','verified','role:admin|teacher'])->name('admin.')->group(function(){
    Route::prefix('quiz/')->name('quiz.')->group(function () {
        Route::get('', [QuizController::class, 'index'])->name('index');
        Route::get('create', [QuizController::class, 'create'])->name('create');
        Route::post('create', [QuizController::class, 'store'])->name('store');
        Route::get('update/{quiz}', [QuizController::class, 'edit'])->name('edit');
        Route::put('update/{quiz}', [QuizController::class,'update'])->name('update');
        Route::get('delete/{quiz}',[QuizController::class,'destroy'])->name('destroy');
        Route::post('insert_user/{quiz}', [QuizController::class,'insertUser'])->name('insert');
        Route::post('insert_classroom/{quiz}', [QuizController::class,'insertClass'])->name('insertClass');
    });
 });
