<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\FreelanceController;


Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/company.php';



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





//freelancer
Route::middleware(['freelancer', 'auth', 'verified'])->prefix('freelancer')->name('freelancer.')->group(function(){
    // Dashboard
    Route::get('/dashboard', [FreelanceController::class, 'index'])->name('index');

    // Todos
    Route::get('/todos/edit', [FreelanceController::class, 'editTodo'])->name('todos.edit');
    Route::post('/todos/store', [FreelanceController::class, 'store'])->name('todos.store');



    //Profile
    Route::get('/profile/{id}/show', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/edit', [App\Http\Controllers\Freelancer\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [App\Http\Controllers\Freelancer\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{id}/other', [App\Http\Controllers\Company\ProfileController::class, 'show'])->name('company.profile.show');

    //Project
    Route::get('/projects', [App\Http\Controllers\Freelancer\ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{id}/show', [App\Http\Controllers\Freelancer\ProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/comments/store', [App\Http\Controllers\Freelancer\ProjectController::class, 'store'])->name('projects.comments.store');
    Route::post('/projects/{project}/favorite', [App\Http\Controllers\Freelancer\ProjectController::class, 'favorite'])->name('projects.favorite');

    // Project Status
    Route::get('/projects/{id}/request', [App\Http\Controllers\Freelancer\ProjectController::class, 'request'])->name('projects.request');
    Route::get('/projects/{id}/cancel', [App\Http\Controllers\Freelancer\ProjectController::class, 'cancelRequest'])->name('projects.cancel');
    Route::get('/projects/{id}/start', [App\Http\Controllers\Freelancer\ProjectController::class, 'start'])->name('projects.start');
    Route::get('/projects/{id}/reject-acknowledge', [App\Http\Controllers\Freelancer\ProjectController::class, 'rejectAcknowledge'])->name('projects.acknowledge');
    Route::get('/projects/{id}/submit', [App\Http\Controllers\Freelancer\ProjectController::class, 'submit'])->name('projects.submit');
    Route::get('/projects/{id}/result', [App\Http\Controllers\Freelancer\ProjectController::class, 'result'])->name('projects.result');

    //message
    Route::get('/messages/{id}/show', [App\Http\Controllers\Freelancer\MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{id}/store', [App\Http\Controllers\Freelancer\MessageController::class, 'store'])->name('messages.store');

    // contact
    Route::get('/contact', [App\Http\Controllers\Freelancer\ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send', [App\Http\Controllers\Freelancer\ContactController::class, 'sendMail'])->name('contact.send');

});



//admin
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // freelancer management
    Route::get('freelancer', [App\Http\Controllers\Admin\FreelancerController::class, 'getAllFreelancers'])->name('freelancer');
    Route::get('freelancer/profile/{id}/', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('freelancer.profile');
    Route::delete('/freelancer/{id}/deactivate', [App\Http\Controllers\Admin\FreelancerController::class, 'deactivate'])->name('freelancer.deactivate');
    Route::patch('/freelancer/{id}/activate', [App\Http\Controllers\Admin\FreelancerController::class, 'activate'])->name('freelancer.activate');

    // company management
    Route::get('company', [App\Http\Controllers\Admin\CompanyController::class, 'getAllCompanies'])->name('company');
    Route::get('company/profile/{id}/', [App\Http\Controllers\Company\ProfileController::class, 'show'])->name('company.profile');
    Route::delete('/company/{id}/deactivate', [App\Http\Controllers\Admin\CompanyController::class, 'deactivateCompany'])->name('company.deactivate');
    Route::patch('/company/{id}/activate', [App\Http\Controllers\Admin\CompanyController::class, 'activateCompany'])->name('company.activate');

    // project list
    Route::get('project', [App\Http\Controllers\Admin\ProjectController::class, 'getAllProjects'])->name('project');

    // transaction
    Route::get('transaction', [App\Http\Controllers\Admin\TransactionController::class, 'getAllTransactions'])->name('transaction');
});
