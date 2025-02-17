<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\FreelanceController;
//company
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Company\ProjectController;

//freelancer



// create front
//admin




Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});



// ユーザーがメール内のリンクをクリックしたときの処理
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $user = $request->user();

    if($user->role_id == 2){
        return redirect()->route('company.dashboard');
    }elseif($user->role_id == 3){
        return redirect()->route('freelancer.index'); // 認証成功後のリダイレクト先
    }

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


//company
Route::middleware(['company', 'auth', 'verified'])->prefix('company')->name('company.')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('dashboard');
    Route::get('/project', [ProjectController::class, 'index'])->name('project');
    Route::post('/create', [ProjectController::class, 'create'])->name('create');
});

//freelancer
Route::middleware(['freelancer', 'auth', 'verified'])->prefix('freelancer')->name('freelancer.')->group(function(){
    Route::get('/user-dashboard', [FreelanceController::class, 'index'])->name('index');
    Route::get('/todo-list/edit', [FreelanceController::class, 'editTodo'])->name('todo-edit');
    Route::post('/todo-list/store', [FreelanceController::class, 'store'])->name('todo.store');

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
