<?php

use App\Http\Controllers\Admin\LessonController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LessonController as FrontendLessonController;

/**
 * Users Role Route
 */

Route::prefix('admin/lessons')->middleware(['auth','verified','role:admin|teacher'])->name('admin.lesson.')->group(function () {
    Route::get('/{section}/sort', [LessonController::class, 'sort'])->name('sort');
    Route::patch('/{section}/sort', [LessonController::class, 'processSort'])->name('processSort');
    Route::get('/{lesson}/edit', [LessonController::class, 'edit'])->name('edit');
    Route::put('/{lesson}/edit', [LessonController::class, 'update'])->name('update');
    Route::get('/quiz/{lesson}', [LessonController::class, 'quiz'])->name('quiz');
    Route::post('/quiz/{lesson}', [LessonController::class, 'addQuiz'])->name('addQuiz');
    Route::get('/type/{course}/{type?}', [LessonController::class, 'selectType'])->name('selecttype');
    Route::get('/{course}/{type?}', [LessonController::class, 'create'])->name('create');
    Route::post('/{course}', [LessonController::class, 'store'])->name('store');
    Route::delete('/{lesson}', [LessonController::class, 'destroy'])->name('delete');
});

Route::post('/mark-lesson/{lesson}', [FrontendLessonController::class, 'mark'])->name('mark-lesson');