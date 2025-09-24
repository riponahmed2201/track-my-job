<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\PasswordChangeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

//Login
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('admin')->group(function () {

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    //Password
    Route::get('password-change', [PasswordChangeController::class, 'passwordChange'])->name('passwordChange');
    Route::put('password/update', [PasswordChangeController::class, 'updatePassword'])->name('password.update');

    //Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('companies', CompanyController::class);
    Route::resource('job-applications', JobApplicationController::class);
    Route::resource('users', UserController::class);
});
