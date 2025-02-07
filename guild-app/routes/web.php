<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// create front
Route::get('/', function () {
    return view('welcome');
});
Route::get('/create', function () {
    return view('companies.create');
});
Route::get('/company', function () {
    return view('companies.dashboard');
});
Route::get('company/profile', function () {
    return view('companies.profile');
});

Route::get('company/edit', function () {
    return view('companies.edit');
});

Route::get('/evaluation', function () {
    return view('companies.evaluation');
});
Route::get('/landing', function () {
    return view('companies.landing');
});

//
Route::get('/message', function () {
    return view('companies/message');
});


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
    // Route::view('company', 'admins.company')->name('admin.company');
    Route::view('job', 'admins.job')->name('admin.job');
    Route::view('transaction', 'admins.transaction')->name('admin.transaction');
    Route::view('message', 'admins.message')->name('admin.message');
});

Route::get('/user-dashboard', function () {
    return view('users.dashbord');
});
Route::get('/job-details', function () {
    return view('users.job-details');
});
    


Route::get('/edit-todo', function () {
    return view('users.edit-todo');
});
Route::get('/freelancer/profile/{id}/show', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('freelancer.profile');
Route::get('/freelancer/profile/{id}/edit', [App\Http\Controllers\Freelancer\ProfileController::class, 'edit'])->name('freelancer.profile-edit');
Route::patch('/freelancer/profile/update', [App\Http\Controllers\Freelancer\ProfileController::class, 'update'])->name('freelancer.profile-update');

Route::get('/user-job-list', function () {
    return view('users.job-list');
});
Route::get('/user-message', function () {
    return view('users.message');
});
Route::get('/confirm', function () {
    return view('email.confirm');
});
