<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportProgressController;

Route::prefix('admin/report')->name('report.')->group(function () {

    Route::get('/report_course/{course}',[ReportProgressController::class,'report_course'])->name('report_course');
});
