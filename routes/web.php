<?php

use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\EventController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperDashboardController;
use App\Http\Controllers\Company\DashboardController as CompanyDashboardController;
use App\Http\Controllers\Support\DashboardController as SupportDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');

Route::get('/dashboard', DashboardRedirectController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'role:super_admin'])
    ->prefix('super-admin')
    ->name('super.')
    ->group(function () {
        Route::get('/dashboard', [SuperDashboardController::class, 'index'])->name('dashboard');
    });

Route::middleware(['auth', 'verified', 'role:company_admin'])
    ->prefix('company')
    ->name('company.')
    ->group(function () {
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');
    });

Route::middleware(['auth', 'verified', 'role:support_staff'])
    ->prefix('support')
    ->name('support.')
    ->group(function () {
        Route::get('/dashboard', [SupportDashboardController::class, 'index'])->name('dashboard');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';