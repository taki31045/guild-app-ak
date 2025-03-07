<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\FreelanceController;
//company
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Company\ProjectController;
use App\Http\Controllers\Company\EvaluationController;
use App\Http\Controllers\Company\MessageController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\Company\StatusController;
use App\Http\Controllers\Company\FreelancerController;


//freelancer



// create front
//admin

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/landing', [CompanyController::class, 'landing'])->name('landing');





//company
Route::middleware(['company', 'auth', 'verified'])->prefix('company')->name('company.')->group(function () {

        Route::get('/', [CompanyController::class, 'index'])->name('dashboard');
        Route::get('/project', [ProjectController::class, 'index'])->name('project');
        Route::post('/create', [ProjectController::class, 'create'])->name('create');

        Route::get('/profile/{id}/', [App\Http\Controllers\Company\ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/{id}/edit', [App\Http\Controllers\Company\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [App\Http\Controllers\Company\ProfileController::class, 'update'])->name('profile.update');
        Route::get('/freelancer/profile/{id}/', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('freelancer.profile');

        Route::delete('/delete/{id}', [ProjectController::class, 'delete'])->name('delete');
        Route::get('/evaluation/{id}', [EvaluationController::class, 'index'])->name('evaluation');
        Route::post('/evaluate', [EvaluationController::class, 'store'])->name('store');
        Route::get('/message/{id}/show', [MessageController::class, 'index'])->name('message');
        Route::POST('/message/{id}/store', [MessageController::class, 'store'])->name('store.message');
        Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('edit');
        Route::post('/update/{id}',[ProjectController::class, 'update'])->name('update');
        Route::get('/paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
        Route::get('/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');
        Route::get('/paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');

        Route::get('/test/project_list', [CompanyController::class, 'project_list'])->name('test');
        Route::get('/project/{id}/project-details', [CompanyController::class, 'show'])->name('project-details');
        Route::post('/project/comment/store', [CompanyController::class, 'store'])->name('comment.store');
        Route::get('/profile/{id}/other', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('freelancer.profile');


        Route::get('/test/freelancer_list', [CompanyController::class, 'favorite_freelancer_list'])->name('test.freelancer');
        Route::get('/status/decline', [StatusController::class, 'decline'])->name('decline');

        Route::get('/contact', [MessageController::class, 'contact'])->name('contact');
        Route::post('/contact/send', [MessageController::class, 'sendMail'])->name('contact.send');

        //freelancer list
        Route::get('/freelancer_list', [FreelancerController::class, 'index'])->name('list.freelancer');
        Route::post('/freelancers/{freelancer}/favorite', [FreelancerController::class, 'favorite']);

        Route::get('/company/recommended_freelancers/{projectId}', [CompanyController::class, 'recommendedFreelancers'])
    ->name('recommended_freelancers');


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





//freelancer
Route::middleware(['freelancer', 'auth', 'verified'])->prefix('freelancer')->name('freelancer.')->group(function(){
    // Dashboard
    Route::get('/user-dashboard', [FreelanceController::class, 'index'])->name('index');
    Route::get('/todo-list/edit', [FreelanceController::class, 'editTodo'])->name('todo-edit');
    Route::post('/todo-list/store', [FreelanceController::class, 'store'])->name('todo.store');



    //Profile
    Route::get('/profile/{id}/show', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('profile');
    Route::get('/freelancer/profile/{id}/edit', [App\Http\Controllers\Freelancer\ProfileController::class, 'edit'])->name('profile-edit');
    Route::post('/freelancer/profile/update', [App\Http\Controllers\Freelancer\ProfileController::class, 'update'])->name('profile-update');
    Route::get('/profile/{id}/other', [App\Http\Controllers\Company\ProfileController::class, 'show'])->name('company.profile');

    //Project
    Route::get('/project-list', [App\Http\Controllers\Freelancer\ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/{id}/project-details', [App\Http\Controllers\Freelancer\ProjectController::class, 'show'])->name('project-details');
    Route::post('/project/comment/store', [App\Http\Controllers\Freelancer\ProjectController::class, 'store'])->name('comment.store');
    Route::post('/project/{project}/favorite', [App\Http\Controllers\Freelancer\ProjectController::class, 'favorite'])->name('project.favorite');

    // Project Status
    Route::get('/project/{id}/request', [App\Http\Controllers\Freelancer\ProjectController::class, 'request'])->name('project.request');
    Route::get('/project/{id}/cancel-request', [App\Http\Controllers\Freelancer\ProjectController::class, 'cancelRequest'])->name('project.cancel-request');
    Route::get('/project/{id}/start', [App\Http\Controllers\Freelancer\ProjectController::class, 'start'])->name('project.start');
    Route::get('/project/{id}/reject-acknowledge', [App\Http\Controllers\Freelancer\ProjectController::class, 'rejectAcknowledge'])->name('project.acknowledge');
    Route::get('/project/{id}/submit', [App\Http\Controllers\Freelancer\ProjectController::class, 'submit'])->name('project.submit');
    Route::get('/project/{id}/result', [App\Http\Controllers\Freelancer\ProjectController::class, 'result'])->name('project.result');

    //message
    Route::get('/message/{id}/show', [App\Http\Controllers\Freelancer\MessageController::class, 'index'])->name('message.index');
    Route::post('/message/{id}/store', [App\Http\Controllers\Freelancer\MessageController::class, 'store'])->name('message.store');

    // contact
    Route::get('/contact', [App\Http\Controllers\Freelancer\ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send', [App\Http\Controllers\Freelancer\ContactController::class, 'sendMail'])->name('contact.send');

});



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

    // message
    // Route::view('message', 'admins.message')->name('admin.message');
});
