<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\UserClassroomController;
use App\Http\Controllers\ClassroomController as FrontEndClassroomController;

/**
 * Users Role Route
 */

Route::prefix('admin/classroom')->middleware(['auth','verified','role:admin|teacher'])->name('classroom.')->group(function () {
    Route::get('/',[ClassroomController::class,'index'])->name('index');
    Route::get('/form_store_classroom',[ClassroomController::class,'create'])->name('form_store_classroom');
    Route::post('/store/',[ClassroomController::class,'store_classroom'])->name('store');
    Route::get('change_status',[ClassroomController::class,'change_status']);
    Route::get('form_update_classroom/{classroom}',[ClassroomController::class,'form_update'])->name('form_update_classroom');
    Route::put('/update/{classroom}',[ClassroomController::class,'update_classroom'])->name('update');
    Route::get('/search_name',[ClassroomController::class,'search']);
    Route::get('/fillter',[ClassroomController::class,'fillter']);
});

Route::prefix('admin/userclass')->middleware(['auth','verified','role:admin|teacher'])->name('admin.userclass.')->group(function () {
    Route::get('/{id}',[UserClassroomController::class,'index'])->name('list');
    Route::get('/add-student/{id}',[UserClassroomController::class,'addStudent'])->name('addStudent');
    Route::post('/add-student/{id}',[UserClassroomController::class,'postAddStudent'])->name('postAddStudent');
    
    // Route::get('/import/{id}',[UserClassroomController::class,'formImport'])->name('formImport');    
    Route::post('/import/{id}',[UserClassroomController::class,'importExUserClass'])->name('importExUserClass');

    // Route::get('/add-student/{id}',[UserClassroomController::class,'addStudent'])->name('addStudent');

    Route::delete('/delete-student/{classId}',[UserClassroomController::class,'removeUserClass'])->name('removeUserClass');
});


Route::get('/classroom/{classroom}', [FrontEndClassroomController::class, 'show'])->middleware(['auth','verified','checkInClass'])->name('classroom');

