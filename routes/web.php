<?php

use Illuminate\Support\Facades\Route;

// ── Auth Controllers ──
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ── Mahasiswa Controllers ──
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfile;
use App\Http\Controllers\Mahasiswa\VacancyController as MahasiswaVacancy;
use App\Http\Controllers\Mahasiswa\ApplicationController as MahasiswaApplication;
use App\Http\Controllers\Mahasiswa\LogbookController as MahasiswaLogbook;
use App\Http\Controllers\Mahasiswa\FinalReportController as MahasiswaFinalReport;
use App\Http\Controllers\Mahasiswa\NotificationController as MahasiswaNotification;

// ── Dosen Controllers ──
use App\Http\Controllers\Dosen\DashboardController as DosenDashboard;
use App\Http\Controllers\Dosen\LogbookController as DosenLogbook;
use App\Http\Controllers\Dosen\GradingController as DosenGrading;
use App\Http\Controllers\Dosen\NotificationController as DosenNotification;

// ── Admin Controllers ──
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\StudentController as AdminStudent;
use App\Http\Controllers\Admin\LecturerController as AdminLecturer;
use App\Http\Controllers\Admin\CompanyController as AdminCompany;
use App\Http\Controllers\Admin\VacancyController as AdminVacancy;
use App\Http\Controllers\Admin\ApplicationController as AdminApplication;
use App\Http\Controllers\Admin\PlottingController as AdminPlotting;
use App\Http\Controllers\Admin\BroadcastController as AdminBroadcast;
use App\Http\Controllers\Admin\ActivityLogController as AdminActivityLog;

/*
|--------------------------------------------------------------------------
| Public / Guest Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Mahasiswa Routes
|--------------------------------------------------------------------------
*/
Route::prefix('mahasiswa')
    ->middleware(['auth', 'role:mahasiswa'])
    ->name('mahasiswa.')
    ->group(function () {
        Route::get('/dashboard', [MahasiswaDashboard::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile', [MahasiswaProfile::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [MahasiswaProfile::class, 'update'])->name('profile.update');

        // Vacancies
        Route::get('/vacancies', [MahasiswaVacancy::class, 'index'])->name('vacancies.index');
        Route::get('/vacancies/{vacancy}', [MahasiswaVacancy::class, 'show'])->name('vacancies.show');

        // Applications
        Route::get('/applications', [MahasiswaApplication::class, 'index'])->name('applications.index');
        Route::post('/applications/{vacancy}', [MahasiswaApplication::class, 'store'])->name('applications.store');

        // Logbooks
        Route::get('/logbooks', [MahasiswaLogbook::class, 'index'])->name('logbooks.index');
        Route::get('/logbooks/create', [MahasiswaLogbook::class, 'create'])->name('logbooks.create');
        Route::post('/logbooks', [MahasiswaLogbook::class, 'store'])->name('logbooks.store');

        // Final Report
        Route::get('/final-report', [MahasiswaFinalReport::class, 'create'])->name('final-report.create');
        Route::post('/final-report', [MahasiswaFinalReport::class, 'store'])->name('final-report.store');

        // Notifications
        Route::get('/notifications', [MahasiswaNotification::class, 'index'])->name('notifications.index');
        Route::post('/notifications/{id}/read', [MahasiswaNotification::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/read-all', [MahasiswaNotification::class, 'markAllRead'])->name('notifications.readAll');
    });

/*
|--------------------------------------------------------------------------
| Dosen Routes
|--------------------------------------------------------------------------
*/
Route::prefix('dosen')
    ->middleware(['auth', 'role:dosen'])
    ->name('dosen.')
    ->group(function () {
        Route::get('/dashboard', [DosenDashboard::class, 'index'])->name('dashboard');

        // Logbooks
        Route::get('/logbooks/{student}', [DosenLogbook::class, 'index'])->name('logbooks.index');
        Route::post('/logbooks/{logbook}/validate', [DosenLogbook::class, 'validate_entry'])->name('logbooks.validate');

        // Grading
        Route::get('/grading', [DosenGrading::class, 'index'])->name('grading.index');
        Route::get('/grading/{finalReport}', [DosenGrading::class, 'show'])->name('grading.show');
        Route::post('/grading/{finalReport}', [DosenGrading::class, 'grade'])->name('grading.grade');
        Route::get('/grading/{finalReport}/download', [DosenGrading::class, 'download'])->name('grading.download');

        // Notifications
        Route::get('/notifications', [DosenNotification::class, 'index'])->name('notifications.index');
        Route::post('/notifications/{id}/read', [DosenNotification::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/read-all', [DosenNotification::class, 'markAllRead'])->name('notifications.readAll');
    });

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        // Master Data CRUD
        Route::resource('students', AdminStudent::class)->except('show');
        Route::resource('lecturers', AdminLecturer::class)->except('show');
        Route::resource('companies', AdminCompany::class)->except('show');
        Route::resource('vacancies', AdminVacancy::class)->except('show');

        // Applications
        Route::get('/applications', [AdminApplication::class, 'index'])->name('applications.index');
        Route::post('/applications/{application}/verify', [AdminApplication::class, 'verify'])->name('applications.verify');
        Route::post('/applications/{application}/accept', [AdminApplication::class, 'accept'])->name('applications.accept');
        Route::post('/applications/{application}/reject', [AdminApplication::class, 'reject'])->name('applications.reject');

        // Plottings
        Route::get('/plottings', [AdminPlotting::class, 'index'])->name('plottings.index');
        Route::get('/plottings/create', [AdminPlotting::class, 'create'])->name('plottings.create');
        Route::post('/plottings', [AdminPlotting::class, 'store'])->name('plottings.store');
        Route::delete('/plottings/{plotting}', [AdminPlotting::class, 'destroy'])->name('plottings.destroy');

        // Broadcast
        Route::get('/broadcast', [AdminBroadcast::class, 'index'])->name('broadcast.index');
        Route::post('/broadcast', [AdminBroadcast::class, 'send'])->name('broadcast.send');

        // Activity Log
        Route::get('/activity-log', [AdminActivityLog::class, 'index'])->name('activity-log.index');
    });
