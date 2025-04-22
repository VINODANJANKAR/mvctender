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
use App\Http\Controllers\ContractorMasterController;
use App\Http\Controllers\SubContractorMasterController;
use App\Http\Controllers\UnitMasterController;

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
    // Route::resource('units', UnitMasterController::class);
    Route::get('work-orders/get-tender-details', [WorkOrderEntryController::class, 'getTenderDetails']);
    Route::get('work-orders/get-contractors', [WorkOrderEntryController::class, 'getContractors']);
    Route::get('/bill-details/get-work-order-details', [BillDetailController::class, 'getWorkOderDetails']);
    // Transaction Routes
    Route::resource('tenders', TenderEntryController::class);
    Route::resource('work-orders', WorkOrderEntryController::class);
    Route::resource('bill-details', BillDetailController::class);
    Route::resource('daily-expenses', DailyExpenseController::class);
    Route::resource('materials', MaterialController::class);
    Route::resource('payments', PaymentEntryController::class);
    Route::resource('bill-adjustments', BillAdjustmentController::class);
    Route::resource('contractor', ContractorMasterController::class);
    Route::resource('subcontractor', SubContractorMasterController::class);

    

    // Additional Routes
}); 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
