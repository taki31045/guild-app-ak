<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FreelanceController;
//company
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Company\ProjectController;
use App\Http\Controllers\Company\EvaluationController;
use App\Http\Controllers\Company\MessageController;

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
        Route::delete('/delete/{id}', [ProjectController::class, 'delete'])->name('delete');
        Route::get('/evaluation', [EvaluationController::class, 'index'])->name('evaluation');
        Route::post('/evaluate', [EvaluationController::class, 'store'])->name('store');
        Route::get('/message/{id}/show', [MessageController::class, 'index'])->name('message');
        Route::POST('/message/{id}/store', [MessageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('edit');
        Route::post('/update/{id}',[ProjectController::class, 'update'])->name('update');
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

Route::prefix('admin')->group(function () {
    Route::view('freelancer', 'admins.freelancer')->name('admin.freelancer');
    Route::view('company', 'admins.company')->name('admin.company');
    Route::view('job', 'admins.job')->name('admin.job');
    Route::view('transaction', 'admins.transaction')->name('admin.transaction');
    Route::view('message', 'admins.message')->name('admin.message');
});
