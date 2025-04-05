<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerMasterController;
use App\Http\Controllers\DepartmentMasterController;
use App\Http\Controllers\PartyMasterController;
use App\Http\Controllers\AccountHeadMasterController;
use App\Http\Controllers\TenderEntryController;
use App\Http\Controllers\WorkOrderEntryController;
use App\Http\Controllers\BillDetailController;
use App\Http\Controllers\DailyExpenseController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PaymentEntryController;
use App\Http\Controllers\BillAdjustmentController;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Create admin user route (you can remove this after creating the admin user)
Route::get('create-admin', [AuthController::class, 'createAdminUser']);

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('/home');
    });

    // Master Routes
    Route::resource('partners', PartnerMasterController::class);
    Route::resource('departments', DepartmentMasterController::class);
    Route::resource('parties', PartyMasterController::class);
    Route::resource('account-heads', AccountHeadMasterController::class);

    // Transaction Routes
    Route::resource('tenders', TenderEntryController::class);
    Route::resource('work-orders', WorkOrderEntryController::class);
    Route::resource('bills', BillDetailController::class);
    Route::resource('daily-expenses', DailyExpenseController::class);
    Route::resource('materials', MaterialController::class);
    Route::resource('payments', PaymentEntryController::class);
    Route::resource('bill-adjustments', BillAdjustmentController::class);

    // Additional Routes
    Route::get('work-orders/get-tender-details', [WorkOrderEntryController::class, 'getTenderDetails']);
}); 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
