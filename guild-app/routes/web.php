<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('users.dashbord');
});
Route::get('/job-details', function () {
    return view('users.job-details');
});
Route::get('/profile', function () {
    return view('users.profile');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

