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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user-dashboard', function () {
    return view('users.dashbord');
});
Route::get('/job-details', function () {
    return view('users.job-details');
});
Route::get('/user-profile', function () {
    return view('users.profile');
});


Route::get('/edit-todo', function () {
    return view('users.edit-todo');
});
Route::get('/edit-user-profile', function () {
    return view('users.edit-profile');
});
Route::get('/user-job-list', function () {
    return view('users.job-list');
});
Route::get('/user-message', function () {
    return view('users.message');
});
Route::get('/confirm', function () {
    return view('email.confirm');
});



