<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\PaperAllocationController;
use App\Http\Controllers\VideoController;

// Guest routes (unauthenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

// Protected routes (authenticated users only)
Route::middleware('auth')->group(function () {
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
});

// Default redirect
Route::get('/home', function () {
    return redirect('/');
});
