<?php

use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\EventController;
use App\Http\Controllers\Public\WhatsappController;

use App\Http\Controllers\SuperAdmin\DashboardController as SuperDashboardController;
use App\Http\Controllers\SuperAdmin\EventController as SuperAdminEventController;
use App\Http\Controllers\SuperAdmin\UserController as SuperAdminUserController;
use App\Http\Controllers\SuperAdmin\CompanyController as SuperAdminCompanyController;
use App\Http\Controllers\SuperAdmin\ReportController as SuperAdminReportController;

use App\Http\Controllers\Company\DashboardController as CompanyDashboardController;
use App\Http\Controllers\Company\EventController as CompanyEventController;
use App\Http\Controllers\Company\TicketTypeController as CompanyTicketTypeController;
use App\Http\Controllers\Company\WhatsappCtaController as CompanyWhatsappCtaController;
use App\Http\Controllers\Company\EnquiryController as CompanyEnquiryController;
use App\Http\Controllers\Company\BookingController as CompanyBookingController;

use App\Http\Controllers\Support\DashboardController as SupportDashboardController;
use App\Http\Controllers\Support\EnquiryController as SupportEnquiryController;
use App\Http\Controllers\Support\CheckInController as SupportCheckInController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{event:slug}/whatsapp', [WhatsappController::class, 'redirect'])->name('events.whatsapp');

Route::get('/dashboard', DashboardRedirectController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'role:super_admin'])
    ->prefix('super-admin')
    ->name('super.')
    ->group(function () {
        Route::get('/dashboard', [SuperDashboardController::class, 'index'])->name('dashboard');

        Route::get('/events', [SuperAdminEventController::class, 'index'])->name('events.index');
        Route::patch('/events/{event}/approve', [SuperAdminEventController::class, 'approve'])->name('events.approve');
        Route::patch('/events/{event}/reject', [SuperAdminEventController::class, 'reject'])->name('events.reject');
        Route::patch('/events/{event}/toggle-featured', [SuperAdminEventController::class, 'toggleFeatured'])->name('events.toggle-featured');

        Route::get('/users', [SuperAdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [SuperAdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [SuperAdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [SuperAdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [SuperAdminUserController::class, 'update'])->name('users.update');
        Route::patch('/users/{user}/activate', [SuperAdminUserController::class, 'activate'])->name('users.activate');
        Route::patch('/users/{user}/deactivate', [SuperAdminUserController::class, 'deactivate'])->name('users.deactivate');
        Route::patch('/users/{user}/block', [SuperAdminUserController::class, 'block'])->name('users.block');
        Route::patch('/users/{user}/reset-password', [SuperAdminUserController::class, 'resetPassword'])->name('users.reset-password');

        Route::get('/companies', [SuperAdminCompanyController::class, 'index'])->name('companies.index');
        Route::get('/companies/create', [SuperAdminCompanyController::class, 'create'])->name('companies.create');
        Route::post('/companies', [SuperAdminCompanyController::class, 'store'])->name('companies.store');
        Route::get('/companies/{company}/edit', [SuperAdminCompanyController::class, 'edit'])->name('companies.edit');
        Route::put('/companies/{company}', [SuperAdminCompanyController::class, 'update'])->name('companies.update');
        Route::patch('/companies/{company}/approve', [SuperAdminCompanyController::class, 'approve'])->name('companies.approve');
        Route::patch('/companies/{company}/activate', [SuperAdminCompanyController::class, 'activate'])->name('companies.activate');
        Route::patch('/companies/{company}/deactivate', [SuperAdminCompanyController::class, 'deactivate'])->name('companies.deactivate');
        Route::patch('/companies/{company}/block', [SuperAdminCompanyController::class, 'block'])->name('companies.block');
        Route::patch('/companies/{company}/reject', [SuperAdminCompanyController::class, 'reject'])->name('companies.reject');

        Route::get('/reports', [SuperAdminReportController::class, 'index'])->name('reports.index');
    });

Route::middleware(['auth', 'verified', 'role:company_admin'])
    ->prefix('company')
    ->name('company.')
    ->group(function () {
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');

        Route::get('/events', [CompanyEventController::class, 'index'])->name('events.index');
        Route::get('/events/create', [CompanyEventController::class, 'create'])->name('events.create');
        Route::post('/events', [CompanyEventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [CompanyEventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [CompanyEventController::class, 'update'])->name('events.update');

        Route::get('/events/{event}/tickets', [CompanyTicketTypeController::class, 'index'])->name('events.tickets.index');
        Route::get('/events/{event}/tickets/create', [CompanyTicketTypeController::class, 'create'])->name('events.tickets.create');
        Route::post('/events/{event}/tickets', [CompanyTicketTypeController::class, 'store'])->name('events.tickets.store');
        Route::get('/tickets/{ticketType}/edit', [CompanyTicketTypeController::class, 'edit'])->name('tickets.edit');
        Route::put('/tickets/{ticketType}', [CompanyTicketTypeController::class, 'update'])->name('tickets.update');
        Route::delete('/tickets/{ticketType}', [CompanyTicketTypeController::class, 'destroy'])->name('tickets.destroy');

        Route::get('/events/{event}/whatsapp', [CompanyWhatsappCtaController::class, 'edit'])->name('events.whatsapp.edit');
        Route::put('/events/{event}/whatsapp', [CompanyWhatsappCtaController::class, 'update'])->name('events.whatsapp.update');

        Route::get('/enquiries', [CompanyEnquiryController::class, 'index'])->name('enquiries.index');
        Route::patch('/enquiries/{enquiry}/status', [CompanyEnquiryController::class, 'updateStatus'])->name('enquiries.update-status');

        Route::get('/bookings', [CompanyBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [CompanyBookingController::class, 'show'])->name('bookings.show');
        Route::get('/enquiries/{enquiry}/booking/create', [CompanyBookingController::class, 'createFromEnquiry'])->name('enquiries.booking.create');
        Route::post('/enquiries/{enquiry}/booking', [CompanyBookingController::class, 'storeFromEnquiry'])->name('enquiries.booking.store');
    });

Route::middleware(['auth', 'verified', 'role:support_staff'])
    ->prefix('support')
    ->name('support.')
    ->group(function () {
        Route::get('/dashboard', [SupportDashboardController::class, 'index'])->name('dashboard');

        Route::get('/enquiries', [SupportEnquiryController::class, 'index'])->name('enquiries.index');
        Route::patch('/enquiries/{enquiry}/status', [SupportEnquiryController::class, 'updateStatus'])->name('enquiries.update-status');

        Route::get('/check-in', [SupportCheckInController::class, 'index'])->name('check-in.index');
        Route::post('/check-in/search', [SupportCheckInController::class, 'search'])->name('check-in.search');
        Route::post('/check-in/{qrTicket}/confirm', [SupportCheckInController::class, 'confirm'])->name('check-in.confirm');
        Route::post('/check-in/scan', [SupportCheckInController::class, 'scan'])->name('check-in.scan');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';