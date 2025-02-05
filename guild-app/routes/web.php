<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FreelanceController;
use App\Http\Controllers\CompanyController;


Auth::routes();
Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'company'], function () {
    Route::get('/company', [CompanyController::class, 'index'])->name('company');
});


Route::group(['middleware' => 'freelancer'], function () {
    Route::get('/freelance', [FreelanceController::class, 'index'])->name('freelance');


    Route::get('/freelancer/profile/{id}/show', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('freelancer.profile');
Route::get('/freelancer/profile/{id}/edit', [App\Http\Controllers\Freelancer\ProfileController::class, 'edit'])->name('freelancer.profile-edit');
Route::patch('/freelancer/profile/update', [App\Http\Controllers\Freelancer\ProfileController::class, 'update'])->name('freelancer.profile-update');

});



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