<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

// ユーザーがメール内のリンクをクリックしたときの処理
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $user = $request->user();

    if($user->role_id == 2){
        return redirect()->route('company.project.on_going');
    }elseif($user->role_id == 3){
        return redirect()->route('freelancer.index'); // 認証成功後のリダイレクト先
    }

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');



require __DIR__.'/company.php';
require __DIR__.'/freelancer.php';







//admin
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function(){
        return redirect()->route('admin.freelancer');
    })
    ->name('dashboard');
    // freelancer management
    Route::get('freelancer', [App\Http\Controllers\Admin\DashboardController::class, 'getAllFreelancers'])->name('freelancer');
    Route::get('freelancer/profile/{id}/', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('freelancer.profile');
    Route::delete('/freelancer/{id}/deactivate', [App\Http\Controllers\Admin\DashboardController::class, 'deactivate'])->name('freelancer.deactivate');
    Route::patch('/freelancer/{id}/activate', [App\Http\Controllers\Admin\DashboardController::class, 'activate'])->name('freelancer.activate');

    // company management
    Route::get('company', [App\Http\Controllers\Admin\DashboardController::class, 'getAllCompanies'])->name('company');
    Route::get('company/profile/{id}/', [App\Http\Controllers\Company\ProfileController::class, 'show'])->name('company.profile');
    Route::delete('/company/{id}/deactivate', [App\Http\Controllers\Admin\DashboardController::class, 'deactivateCompany'])->name('company.deactivate');
    Route::patch('/company/{id}/activate', [App\Http\Controllers\Admin\DashboardController::class, 'activateCompany'])->name('company.activate');

    // project management
    Route::get('project', [App\Http\Controllers\Admin\DashboardController::class, 'getAllProjects'])->name('project');
    Route::delete('/project/{id}/deactivate', [App\Http\Controllers\Admin\DashboardController::class, 'deactivateProject'])->name('project.deactivate');
    Route::patch('/project/{id}/activate', [App\Http\Controllers\Admin\DashboardController::class, 'activateProject'])->name('project.activate');

    // transaction
    Route::get('transaction', [App\Http\Controllers\Admin\DashboardController::class, 'getAllTransactions'])->name('transaction');
});
