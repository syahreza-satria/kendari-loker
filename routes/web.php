<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyManageController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobManageController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index'])->name('index');
Route::get('/kategori', [AppController::class, 'showAllCategory'])->name('showAllCategory');
Route::get('/loker', [AppController::class, 'showAllJob'])->name('showAllJobs');
Route::get('/loker/{slug}', [AppController::class, 'show'])->name('show');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

Route::middleware(['auth', 'role:employer'])->prefix('employer')->name('employer.')->group(function () {

    Route::get('/profile', [EmployerController::class, 'profile'])->name('profile');

    Route::put('/profile/update/{user}', [EmployerController::class, 'update'])->name('profile.update');

    Route::resource('/company', CompanyManageController::class)->names('company');

    Route::resource('/jobs', JobManageController::class);

    Route::get('/settings', [EmployerController::class, 'settings'])->name('settings');

    Route::delete('/account', [EmployerController::class, 'deleteAccount'])->name('account.delete');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/pengguna', UserController::class)
        ->parameters(['pengguna' => 'user'])
        ->names('user')
        ->except(['show', 'create', 'edit']);

    Route::resource('/kategori', JobCategoryController::class)
        ->parameters(['kategori' => 'category'])
        ->names('category')
        ->except(['show', 'create', 'edit']);

    Route::resource('/tipe-pekerjaan', JobTypeController::class)
        ->parameters(['tipe-pekerjaan' => 'type'])
        ->names('type')
        ->except(['show', 'create', 'edit']);

    Route::resource('/perusahaan', CompanyController::class)
        ->parameters(['perusahaan' => 'company'])
        ->names('company')
        ->except(['show', 'create', 'edit']);

    Route::resource('/pekerjaan', JobController::class)
        ->parameters(['pekerjaan' => 'job'])
        ->names('job');
});
