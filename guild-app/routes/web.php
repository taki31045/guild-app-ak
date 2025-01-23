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
//

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
