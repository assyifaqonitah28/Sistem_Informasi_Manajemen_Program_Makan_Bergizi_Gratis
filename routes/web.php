<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

// ============================================
// PUBLIC ROUTES
// ============================================
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Auth Google
Route::get('/auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);

// ============================================
// AUTHENTICATED ROUTES (Semua user yang login)
// ============================================
Route::middleware(['auth', 'verified', 'status'])->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // Profile (untuk semua user)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ============================================
    // ADMIN ROUTES
    // ============================================
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('programs', ProgramController::class);

        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

        Route::resource('regions', \App\Http\Controllers\Admin\RegionController::class);
        Route::get('/regions/children', [\App\Http\Controllers\Admin\RegionController::class, 'getChildren'])->name('regions.children');

        Route::resource('beneficiaries', \App\Http\Controllers\Admin\BeneficiaryController::class);

        Route::resource('distributions', \App\Http\Controllers\Admin\DistributionController::class);

        Route::resource('reports', \App\Http\Controllers\Admin\ReportController::class);
    });

    // ============================================
    // USER ROUTES
    // ============================================
    Route::middleware('role:user')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\User\UserDashboardController::class, 'index'])->name('dashboard');

            Route::get('/programs', [\App\Http\Controllers\User\AvailableProgramController::class, 'index'])->name('programs.index');
            Route::get('/history', [\App\Http\Controllers\User\HistoryController::class, 'index'])->name('history.index');
            Route::get('/my-reports', [\App\Http\Controllers\User\MyReportController::class, 'index'])->name('reports.index');
            Route::get('/my-reports/create', [\App\Http\Controllers\User\MyReportController::class, 'create'])->name('reports.create');
            Route::post('/my-reports', [\App\Http\Controllers\User\MyReportController::class, 'store'])->name('reports.store');
    });

});

require __DIR__.'/auth.php';
