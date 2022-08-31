<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ViewdashboardController;
use Illuminate\Support\Facades\Route;

// Login
Route::get('login', [AuthController::class, 'login'])->name('core.login');
Route::post('auth', [AuthController::class, 'auth'])->name('core.auth');
Route::get('/token', function () {
    return csrf_token();
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/viewdashboard/{name}', [ViewdashboardController::class, 'viewdashboard'])->name('viewdashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('core.logout');

    // User Management
    Route::get('user-management', [UserManagementController::class, 'index'])->name('user.index');
    Route::get('user-management/datatable', [UserManagementController::class, 'datatable'])->name('user.datatable');
    Route::post('user-management', [UserManagementController::class, 'store'])->name('user.store');
    Route::get('user-management/{id}', [UserManagementController::class, 'detail'])->name('user.detail');
    Route::patch('user-management/{id}', [UserManagementController::class, 'update'])->name('user.update');
    Route::delete('user-management/{id}', [UserManagementController::class, 'destroy'])->name('user.destroy');
    Route::post('user-management/export', [UserManagementController::class, 'export'])->name('user.export');

    // Profile
    Route::get('profile-user/{id}', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile-user-cp/{id}', [ProfileController::class, 'changephoto'])->name('profile.store');
    Route::patch('profile-user/{id}', [ProfileController::class, 'update'])->name('profile.update');

    // Menu Management
    Route::get('menu-management', [MenusController::class, 'index'])->name('menu.index');
    Route::get('menu-management/datatable', [MenusController::class, 'datatable'])->name('menu.datatable');
    Route::post('menu-management', [MenusController::class, 'store'])->name('menu.store');
    Route::get('menu-management/{id}', [MenusController::class, 'detail'])->name('menu.detail');
    Route::get('menu-management/{id}/edit', [MenusController::class, 'edit'])->name('menu.edit');
    Route::patch('menu-management/{id}', [MenusController::class, 'update'])->name('menu.update');
    Route::delete('menu-management/{id}', [MenusController::class, 'destroy'])->name('menu.destroy');

    // User Roles
    Route::get('user-role', [RolesController::class, 'index'])->name('role.index');
    Route::post('user-role', [RolesController::class, 'store'])->name('role.store');
    Route::get('user-role/{id}', [RolesController::class, 'detail'])->name('role.detail');
    Route::patch('user-role/{id}', [RolesController::class, 'update'])->name('role.update');
    Route::delete('user-role/{id}', [RolesController::class, 'destroy'])->name('role.destroy');

    // Change Password
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('changepassword');

    // Log Data
    Route::get('log-data/datatable', [LogController::class, 'datatable'])->name('log.datatable');
    Route::get('log-data', [LogController::class, 'index'])->name('log.index');
});
