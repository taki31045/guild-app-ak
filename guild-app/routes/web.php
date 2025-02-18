<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FreelanceController;
//company
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Company\ProjectController;

//freelancer



// create front
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
        Route::get('/edit', [App\Http\Controllers\Company\ProjectController::class, 'edit'])->name('edit');
        Route::get('/profile/{id}/', [App\Http\Controllers\Company\ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/{id}/edit', [App\Http\Controllers\Company\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [App\Http\Controllers\Company\ProfileController::class, 'update'])->name('profile.update');
        

    });

//freelancer
Route::middleware(['freelancer'])->prefix('freelancer')->name('freelancer.')->group(function(){
    Route::get('/user-dashboard', [FreelanceController::class, 'index'])->name('index');

    //Freelancer Profile
    Route::get('/profile/{id}/show', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('profile');
    Route::get('/freelancer/profile/{id}/edit', [App\Http\Controllers\Freelancer\ProfileController::class, 'edit'])->name('profile-edit');
    Route::post('/freelancer/profile/update', [App\Http\Controllers\Freelancer\ProfileController::class, 'update'])->name('profile-update');

    //Project
    Route::get('/project-list', [App\Http\Controllers\Freelancer\ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/{id}/project-details', [App\Http\Controllers\Freelancer\ProjectController::class, 'show'])->name('project-details');
    Route::post('/project/comment/store', [App\Http\Controllers\Freelancer\ProjectController::class, 'store'])->name('comment.store');
    Route::post('/project/{project}/favorite', [App\Http\Controllers\Freelancer\ProjectController::class, 'favorite'])->name('project.favorite');

    //message
    Route::get('/message/{id}/show', [App\Http\Controllers\Freelancer\MessageController::class, 'index'])->name('message.index');
    Route::post('/message/{id}/store', [App\Http\Controllers\Freelancer\MessageController::class, 'store'])->name('message.store');

});



//admin
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/', function(){
        return redirect()->route('admin.freelancer');
    })
    ->name('dashboard');
    
    Route::get('freelancer', [App\Http\Controllers\Admin\DashboardController::class, 'getAllFreelancers'])->name('freelancer');
    Route::delete('/freelancer/{id}/deactivate', [App\Http\Controllers\Admin\DashboardController::class, 'deactivate'])->name('freelancer.deactivate');
    Route::patch('/freelancer/{id}/activate', [App\Http\Controllers\Admin\DashboardController::class, 'activate'])->name('freelancer.activate');

    Route::get('company', [App\Http\Controllers\Admin\DashboardController::class, 'getAllCompanies'])->name('company');
    Route::delete('/company/{id}/deactivate', [App\Http\Controllers\Admin\DashboardController::class, 'deactivateCompany'])->name('company.deactivate');
    Route::patch('/company/{id}/activate', [App\Http\Controllers\Admin\DashboardController::class, 'activateCompany'])->name('company.activate');

    Route::get('project', [App\Http\Controllers\Admin\DashboardController::class, 'getAllProjects'])->name('project');
    Route::delete('/project/{id}/deactivate', [App\Http\Controllers\Admin\DashboardController::class, 'deactivateProject'])->name('project.deactivate');
    Route::patch('/project/{id}/activate', [App\Http\Controllers\Admin\DashboardController::class, 'activateProject'])->name('project.activate');

    Route::get('transaction', [App\Http\Controllers\Admin\DashboardController::class, 'getAllTransactions'])->name('transaction');

    Route::view('message', 'admins.message')->name('admin.message');
});
