<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FreelanceController;
//company
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Company\ProjectController;

//freelancer


//admin




Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

//company
Route::middleware(['company'])->prefix('company')->name('company.')->group(function () {

        Route::get('/', [CompanyController::class, 'index'])->name('dashboard');
        Route::get('/project', [ProjectController::class, 'index'])->name('project');
        Route::post('/create', [ProjectController::class, 'create'])->name('create');
        Route::delete('/delete/{id}', [ProjectController::class, 'delete'])->name('delete');
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
    Route::view('freelancer', 'admins.freelancer')->name('admin.freelancer');
    Route::view('company', 'admins.company')->name('admin.company');
    Route::view('job', 'admins.job')->name('admin.job');
    Route::view('transaction', 'admins.transaction')->name('admin.transaction');
    Route::view('message', 'admins.message')->name('admin.message');
});

Route::get('/user-dashboard', function () {
    return view('users.dashbord');
});