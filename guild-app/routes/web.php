<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FreelanceController;
//company
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Company\ProjectController;


Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

//company
    Route::middleware(['company'])->prefix('company')->name('company.')->group(function () {

        Route::get('/company', [CompanyController::class, 'index'])->name('dashboard');
        Route::get('/company/create', [ProjectController::class, 'create'])->name('create');
    });

//freelancer
    // Route::middleware(['freelance']->prefix('freelancer')->name('freelancer')->group(function()){
    Route::middleware(['freelancer'])->group(function () {
        Route::get('/freelance', [FreelanceController::class, 'index'])->name('freelance');
        Route::get('/freelancer/profile/{id}/show', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('freelancer.profile');
        Route::get('/freelancer/profile/{id}/edit', [App\Http\Controllers\Freelancer\ProfileController::class, 'edit'])->name('freelancer.profile-edit');
        Route::patch('/freelancer/profile/update', [App\Http\Controllers\Freelancer\ProfileController::class, 'update'])->name('freelancer.profile-update');

    });
    
//admin
Route::prefix('admin')->group(function () {
    
    Route::get('/', function(){
        return redirect()->route('admin.freelancer');
    })
    ->name('admin.dashboard');
    
    Route::get('freelancer', [App\Http\Controllers\Admin\DashboardController::class, 'getAllFreelancers'])->name('admin.freelancer');
    Route::delete('/freelancer/{id}/deactivate', [App\Http\Controllers\Admin\DashboardController::class, 'deactivate'])->name('admin.freelancer.deactivate');
    Route::patch('/freelancer/{id}/activate', [App\Http\Controllers\Admin\DashboardController::class, 'activate'])->name('admin.freelancer.activate');
    Route::get('company', [App\Http\Controllers\Admin\DashboardController::class, 'getAllCompanies'])->name('admin.company');
    Route::delete('/company/{id}/deactivate', [App\Http\Controllers\Admin\DashboardController::class, 'deactivateCompany'])->name('admin.company.deactivate');
    Route::patch('/company/{id}/activate', [App\Http\Controllers\Admin\DashboardController::class, 'activateCompany'])->name('admin.company.activate');
    Route::get('project', [App\Http\Controllers\Admin\DashboardController::class, 'getAllProjects'])->name('admin.project');
    Route::delete('/project/{id}/deactivate', [App\Http\Controllers\Admin\DashboardController::class, 'deactivateProject'])->name('admin.project.deactivate');
    Route::patch('/project/{id}/activate', [App\Http\Controllers\Admin\DashboardController::class, 'activateProject'])->name('admin.project.activate');
    Route::get('transaction', [App\Http\Controllers\Admin\DashboardController::class, 'getAllTransactions'])->name('admin.transaction');


    // Route::view('transaction', 'admins.transaction')->name('admin.transaction');

    Route::view('message', 'admins.message')->name('admin.message');
});

Route::get('/user-dashboard', function () {
    return view('users.dashbord');
});
