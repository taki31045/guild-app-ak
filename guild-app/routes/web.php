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
Route::get('/edit-todo', function () {
    return view('users.edit-todo');
});
Route::get('/edit-profile', function () {
    return view('users.edit-profile');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

