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
    //project
    Route::group(['prefix' => 'project', 'as' =>'project.'], function(){
        Route::get('/', [CompanyController::class, 'index'])->name('on_going');  //ongoing
        Route::get('/project', [ProjectController::class, 'index'])->name('for_create'); //page for create
        Route::post('/create', [ProjectController::class, 'create'])->name('create');  //create
        Route::delete('/delete/{id}', [ProjectController::class, 'delete'])->name('delete'); //delete
        Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('for_update'); //page for update
        Route::post('/update/{id}',[ProjectController::class, 'update'])->name('update'); //update
        Route::get('/project/{id}/project-details', [CompanyController::class, 'show'])->name('detail'); //detail
        Route::get('/test/project_list', [CompanyController::class, 'project_list'])->name('list'); //list
        Route::post('/project/comment/store', [CompanyController::class, 'store'])->name('comment.store'); //comment store

        Route::get('/company/recommended_freelancers/{projectId}', [CompanyController::class, 'recommendedFreelancers'])
        ->name('recommended_freelancers'); //recommendedfreelancer related project

        Route::group(['prefix' => 'status', 'as' => 'status.'], function(){
            Route::get('/status/decline', [StatusController::class, 'decline'])->name('decline'); //decline requested

        });

    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function(){
        Route::get('/profile/{id}/', [App\Http\Controllers\Company\ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/{id}/edit', [App\Http\Controllers\Company\ProfileController::class, 'edit'])->name('for_update');
        Route::patch('/profile/update', [App\Http\Controllers\Company\ProfileController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'freelancer', 'as' => 'freelancer.'], function(){
        Route::get('/test/freelancer_list', [CompanyController::class, 'favorite_freelancer_list'])->name('favorite.list');
        Route::get('/freelancer_list', [FreelancerController::class, 'index'])->name('list');
        Route::post('/like/{freelancer}', [FreelancerController::class, 'favorite']);
        Route::get('/{id}/profile', [FreelancerController::class, 'show'])->name('profile.show');
    });

    Route::group(['prefix' => 'evaluation', 'as' => 'evaluation.'], function(){
        Route::get('/evaluation/{id}', [EvaluationController::class, 'index'])->name('evaluation');
        Route::post('/evaluate', [EvaluationController::class, 'store'])->name('store');
    });

    Route::group(['prefix' => 'contact', 'as' => 'contact.'], function(){
        Route::get('/message/{id}/show', [MessageController::class, 'index'])->name('with_freelancer');
        Route::POST('/message/{id}/store', [MessageController::class, 'store'])->name('store');
        Route::get('/contact', [MessageController::class, 'contact'])->name('contact');
        Route::post('/contact/send', [MessageController::class, 'sendMail'])->name('send_to_admin');

    });

    Route::group(['prefix' => 'paypal', 'as' => 'paypal.'],function(){
        Route::get('/paypal/payment', [PayPalController::class, 'payment'])->name('payment');
        Route::get('/paypal/success', [PayPalController::class, 'success'])->name('success');
        Route::get('/paypal/cancel', [PayPalController::class, 'cancel'])->name('cancel');
    });










        //freelancer list




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
