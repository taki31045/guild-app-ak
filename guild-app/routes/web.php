<?php

use Illuminate\Support\Facades\Route;



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

Route::get('/admindashboard', function () {
    return view('admins/dashboard');
});
Route::get('/message', function () {
    return view('companies/message');
});

Route::prefix('admin')->group(function () {
    Route::view('freelancer', 'admins.freelancer')->name('admin.freelancer');
    Route::view('company', 'admins.company')->name('admin.company');
    Route::view('job', 'admins.job')->name('admin.job');
    Route::view('transaction', 'admins.transaction')->name('admin.transaction');
    Route::view('message', 'admins.message')->name('admin.message');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




//Freelancer Profile
Route::get('/freelancer/profile/{id}/show', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('freelancer.profile');
Route::get('/freelancer/profile/{id}/edit', [App\Http\Controllers\Freelancer\ProfileController::class, 'edit'])->name('freelancer.profile-edit');
Route::post('/freelancer/profile/update', [App\Http\Controllers\Freelancer\ProfileController::class, 'update'])->name('freelancer.profile-update');

//Project
Route::get('/project-list', [App\Http\Controllers\Freelancer\ProjectController::class, 'index'])->name('index');
Route::get('/project/{id}/project-details', [App\Http\Controllers\Freelancer\ProjectController::class, 'show'])->name('project-details');
Route::post('/project/comment/store', [App\Http\Controllers\Freelancer\ProjectController::class, 'store'])->name('comment.store');
Route::post('/project/{project}/favorite', [App\Http\Controllers\Freelancer\ProjectController::class, 'favorite'])->name('project.favorite');


Route::get('/edit-todo', function () {
    return view('users.edit-todo');
});
Route::get('/user-dashboard', function () {
    return view('users.dashboard');
});
Route::get('/job-details', function () {
    return view('users.job-details');
});

