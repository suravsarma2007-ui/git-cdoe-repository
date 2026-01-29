
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\PaperAllocationController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\VideoRecordingScheduleController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\DailyRecordVideoController;


// Guest routes (unauthenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

// Protected routes (authenticated users only)
Route::middleware('auth')->group(function () {
            // AJAX: Get papers by program
            Route::get('/paper/by-program/{program_id}', [\App\Http\Controllers\PaperController::class, 'byProgram'])->name('paper.by-program');
        // PPT Management Routes
        Route::prefix('ppt')->name('ppt.')->group(function () {
            Route::get('/', [\App\Http\Controllers\PptController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\PptController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\PptController::class, 'store'])->name('store');
            Route::get('/{ppt}/edit', [\App\Http\Controllers\PptController::class, 'edit'])->name('edit');
            Route::put('/{ppt}', [\App\Http\Controllers\PptController::class, 'update'])->name('update');
            Route::delete('/{ppt}', [\App\Http\Controllers\PptController::class, 'destroy'])->name('destroy');
            Route::get('/export-csv', [\App\Http\Controllers\PptController::class, 'exportCsv'])->name('exportCsv');
        });
    // ESLM Module file upload
    Route::get('/eslm/{eslm}/module-upload', [\App\Http\Controllers\EslmController::class, 'moduleUploadForm'])->name('module-upload-form');
    Route::post('/eslm/{eslm}/module-upload', [\App\Http\Controllers\EslmController::class, 'moduleUpload'])->name('module-upload');
    Route::get('/', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Staff Management Routes
    Route::prefix('staff')->name('staff.')->group(function () {
        Route::get('/', [StaffController::class, 'index'])->name('index');
        Route::get('/create', [StaffController::class, 'create'])->name('create');
        Route::post('/', [StaffController::class, 'store'])->name('store');
        Route::get('/{staff}/edit', [StaffController::class, 'edit'])->name('edit');
        Route::put('/{staff}', [StaffController::class, 'update'])->name('update');
        Route::get('/{staff}/delete', [StaffController::class, 'destroy'])->name('delete');
        Route::delete('/{staff}', [StaffController::class, 'confirmDelete'])->name('confirm-delete');
        Route::get('/report', [StaffController::class, 'report'])->name('report');
        // AJAX: Only faculty
        Route::get('/faculty-only', [StaffController::class, 'facultyOnly'])->name('faculty-only');
    });

    // Program Management Routes
    Route::prefix('program')->name('program.')->group(function () {
        Route::get('/', [ProgramController::class, 'index'])->name('index');
        Route::get('/create', [ProgramController::class, 'create'])->name('create');
        Route::post('/', [ProgramController::class, 'store'])->name('store');
        Route::get('/{program}/edit', [ProgramController::class, 'edit'])->name('edit');
        Route::put('/{program}', [ProgramController::class, 'update'])->name('update');
        Route::get('/{program}/delete', [ProgramController::class, 'destroy'])->name('delete');
        Route::delete('/{program}', [ProgramController::class, 'confirmDelete'])->name('confirm-delete');
    });

    // Paper Management Routes
    Route::prefix('paper')->name('paper.')->group(function () {
        Route::get('/', [PaperController::class, 'index'])->name('index');
        Route::get('/create', [PaperController::class, 'create'])->name('create');
        Route::post('/', [PaperController::class, 'store'])->name('store');
        Route::get('/{paper}/edit', [PaperController::class, 'edit'])->name('edit');
        Route::put('/{paper}', [PaperController::class, 'update'])->name('update');
        Route::get('/{paper}/delete', [PaperController::class, 'destroy'])->name('delete');
        Route::delete('/{paper}', [PaperController::class, 'confirmDelete'])->name('confirm-delete');
        Route::get('/report', [PaperController::class, 'report'])->name('report');
        Route::get('/by-program/{program?}', [PaperController::class, 'byProgram'])->name('by-program');
        Route::get('/export/csv', [PaperController::class, 'exportCsv'])->name('export-csv');
        Route::get('/export/excel', [PaperController::class, 'exportExcel'])->name('export-excel');
    });

    // Paper Allocation Routes
    Route::prefix('paper-allocation')->name('paper_allocation.')->group(function () {
        Route::get('/', [PaperAllocationController::class, 'index'])->name('index');
        Route::get('/create', [PaperAllocationController::class, 'create'])->name('create');
        Route::post('/', [PaperAllocationController::class, 'store'])->name('store');
        Route::get('/{paper_allocation}/edit', [PaperAllocationController::class, 'edit'])->name('edit');
        Route::put('/{paper_allocation}', [PaperAllocationController::class, 'update'])->name('update');
        Route::get('/{paper_allocation}/delete', [PaperAllocationController::class, 'destroy'])->name('delete');
        Route::delete('/{paper_allocation}', [PaperAllocationController::class, 'confirmDelete'])->name('confirm-delete');
        Route::get('/export/csv', [PaperAllocationController::class, 'exportCsv'])->name('export-csv');
        Route::get('/export/excel', [PaperAllocationController::class, 'exportExcel'])->name('export-excel');
    });

    // Video Management Routes
    Route::prefix('video')->name('video.')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('index');
        Route::get('/create', [VideoController::class, 'create'])->name('create');
        Route::get('/report', [VideoController::class, 'report'])->name('report');
        Route::get('/export/csv', [VideoController::class, 'exportCsv'])->name('export-csv');
        Route::get('/export/excel', [VideoController::class, 'exportExcel'])->name('export-excel');
        Route::get('/semesters-by-program/{programId?}', [VideoController::class, 'semestersByProgram'])->name('semesters-by-program');
        Route::get('/papers-by-program-semester/{programId?}/{semester?}', [VideoController::class, 'papersByProgramSemester'])->name('papers-by-program-semester');
        Route::post('/', [VideoController::class, 'store'])->name('store');
        Route::get('/{video}/edit', [VideoController::class, 'edit'])->name('edit');
        Route::put('/{video}', [VideoController::class, 'update'])->name('update');
        Route::get('/{video}/delete', [VideoController::class, 'destroy'])->name('delete');
        Route::delete('/{video}', [VideoController::class, 'confirmDelete'])->name('confirm-delete');
    });

    // Academic Session Routes
    Route::resource('academic_session', AcademicSessionController::class)->names([
        'index'  => 'academic_session.index',
        'create' => 'academic_session.create',
        'store'  => 'academic_session.store',
        'edit'   => 'academic_session.edit',
        'update' => 'academic_session.update',
        'destroy'=> 'academic_session.destroy',
    ]);

    // Module Routes
    Route::resource('module', ModuleController::class)->names([
        'index'  => 'module.index',
        'create' => 'module.create',
        'store'  => 'module.store',
        'edit'   => 'module.edit',
        'update' => 'module.update',
        'destroy'=> 'module.destroy',
    ]);

    // Video Recording Schedule Routes
    Route::prefix('video-schedule')->name('video_schedule.')->group(function () {
        Route::get('/', [VideoRecordingScheduleController::class, 'index'])->name('index');
        Route::get('/create', [VideoRecordingScheduleController::class, 'create'])->name('create');
        Route::post('/', [VideoRecordingScheduleController::class, 'store'])->name('store');
        Route::get('/{video_schedule}/edit', [VideoRecordingScheduleController::class, 'edit'])->name('edit');
        Route::put('/{video_schedule}', [VideoRecordingScheduleController::class, 'update'])->name('update');
        Route::delete('/{video_schedule}', [VideoRecordingScheduleController::class, 'destroy'])->name('destroy');
        Route::get('/export-csv', [VideoRecordingScheduleController::class, 'exportCsv'])->name('exportCsv');
        Route::get('/papers-by-program', [VideoRecordingScheduleController::class, 'papersByProgram'])->name('papersByProgram');
    });

    // Target Routes
    Route::prefix('target')->name('target.')->group(function () {
        Route::get('/', [TargetController::class, 'index'])->name('index');
        Route::get('/create', [TargetController::class, 'create'])->name('create');
        Route::post('/', [TargetController::class, 'store'])->name('store');
        Route::get('/{target}/edit', [TargetController::class, 'edit'])->name('edit');
        Route::put('/{target}', [TargetController::class, 'update'])->name('update');
        Route::delete('/{target}', [TargetController::class, 'destroy'])->name('destroy');
        Route::get('/export-csv', [TargetController::class, 'exportCsv'])->name('exportCsv');
        Route::get('/papers-by-program', [TargetController::class, 'papersByProgram'])->name('papersByProgram');
        Route::get('/final-report', [TargetController::class, 'finalReport'])->name('finalReport');
        Route::get('/final-report/export-csv', [TargetController::class, 'finalReportCsv'])->name('finalReportCsv');
        Route::post('/final-report/{slno}/update', [TargetController::class, 'updateRemarkStatus'])->name('finalReport.update');
    });

        // Eslm Management Routes
        Route::prefix('eslm')->name('eslm.')->group(function () {
            Route::get('/', [\App\Http\Controllers\EslmController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\EslmController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\EslmController::class, 'store'])->name('store');
            Route::get('/{eslm}/edit', [\App\Http\Controllers\EslmController::class, 'edit'])->name('edit');
            Route::put('/{eslm}', [\App\Http\Controllers\EslmController::class, 'update'])->name('update');
            Route::get('/{eslm}/delete', [\App\Http\Controllers\EslmController::class, 'destroy'])->name('delete');
            Route::delete('/{eslm}', [\App\Http\Controllers\EslmController::class, 'destroy'])->name('confirm-delete');
            Route::get('/report', [\App\Http\Controllers\EslmController::class, 'report'])->name('report');
            Route::get('/export/csv', [\App\Http\Controllers\EslmController::class, 'exportCsv'])->name('export-csv');
            Route::post('/import/csv', [\App\Http\Controllers\EslmController::class, 'importCsv'])->name('import-csv');
        });

        //Eslm Daily Record Video Routes
        Route::prefix('daily-record-video')->name('daily_record_video.')->group(function () {

            Route::get('/', [DailyRecordVideoController::class, 'index'])->name('index');
            Route::get('/create', [DailyRecordVideoController::class, 'create'])->name('create');
            Route::post('/', [DailyRecordVideoController::class, 'store'])->name('store');
            Route::put('/update/{id}', [DailyRecordVideoController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [DailyRecordVideoController::class, 'destroy'])->name('delete');             
            Route::get('/edit/{id}', [DailyRecordVideoController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [DailyRecordVideoController::class, 'update'])->name('update');
            
        });
});


// Default redirect
Route::get('/home', function () {
    return redirect('/');
});
Route::get('/get-papers/{program_id}', [PaperController::class, 'getPapers']);
Route::get('/get-faculty-papers/{paper_id}', [PaperController::class, 'getFaculty']);