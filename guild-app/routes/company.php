<?php
//company
use App\Http\Controllers\company\project\ProjectViewController;
use App\Http\Controllers\company\project\ProjectController;
use App\Http\Controllers\company\project\ProjectStatusController;
use App\Http\Controllers\company\project\ProjectRecommendationController;
use App\Http\Controllers\Company\Profile\ProfileController;
use App\Http\Controllers\Company\Message\MessageController;
use App\Http\Controllers\Company\Freelancer\FavoriteFreelancerController;
use App\Http\Controllers\Company\Freelancer\FreelancerController;
use App\Http\Controllers\Company\Evaluation\EvaluationController;
use App\Http\Controllers\Company\Admin\AdminController;
//paypal
use App\Http\Controllers\PayPalController;
use App\Models\Message;

//company
Route::middleware(['company', 'auth', 'verified'])->prefix('company')->name('company.')->group(function () {
    //project
    Route::group(['prefix' => 'project', 'as' =>'project.'], function(){
        Route::get('/', [ProjectViewController::class, 'index'])->name('on_going');  //ongoing
        Route::get('/test/project_list', [ProjectViewController::class, 'project_list'])->name('list'); //list
        Route::get('/project/{id}/project-details', [ProjectViewController::class, 'show'])->name('detail'); //detail
        Route::get('/download/{id}', [App\Http\Controllers\Freelancer\ProjectController::class, 'downloadFile'])->name('download.file');

        Route::get('/project', [ProjectController::class, 'index'])->name('for_create'); //page for create
        Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('for_update'); //page for update
        Route::post('/create', [ProjectController::class, 'create'])->name('create');  //create
        Route::patch('/update/{id}',[ProjectController::class, 'update'])->name('update'); //update
        Route::delete('/delete/{id}', [ProjectController::class, 'delete'])->name('delete'); //delete
        Route::post('/project/comment/store', [ProjectController::class, 'store'])->name('comment.store'); //comment store
        Route::get('/company/recommended_freelancers/{projectId}', [ProjectRecommendationController::class, 'recommendedFreelancers'])->name('recommended_freelancers'); //recommendedFreelancer related project

        //status
        Route::group(['prefix' => 'status', 'as' => 'status.'], function(){
            Route::get('/status/decline', [ProjectStatusController::class, 'decline'])->name('decline'); //decline requested
            Route::get('/status/decline/submitted', [ProjectStatusController::class, 'submittedDecline'])->name('submittedDecline');
        });
    });

    //profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function(){
        Route::get('/profile/{id}/', [ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('for_update');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('update');
    });

    //freelancer
    Route::group(['prefix' => 'freelancer', 'as' => 'freelancer.'], function(){
        Route::get('/test/freelancer_list', [FavoriteFreelancerController::class, 'favorite_freelancer_list'])->name('favorite.list');
        Route::get('/freelancer_list', [FreelancerController::class, 'index'])->name('list');
        Route::post('/like/{freelancer}', [FavoriteFreelancerController::class, 'favorite']);
        Route::get('/{id}/profile', [FreelancerController::class, 'show'])->name('profile.show');
    });

    //evaluation
    Route::group(['prefix' => 'evaluation', 'as' => 'evaluation.'], function(){
        Route::get('/evaluation/{id}', [EvaluationController::class, 'index'])->name('evaluation');
        Route::post('/evaluate', [EvaluationController::class, 'store'])->name('store');
    });

    //contact
    Route::group(['prefix' => 'contact', 'as' => 'contact.'], function(){
        Route::get('/message/{id}/show', [MessageController::class, 'index'])->name('with_freelancer');
        Route::get('/contact', [AdminController::class, 'contact'])->name('contact');
        Route::POST('/message/{id}/store', [MessageController::class, 'store'])->name('store');
        Route::post('/contact/send', [AdminController::class, 'sendMail'])->name('send_to_admin');
    });

    //paypal
    Route::group(['prefix' => 'paypal', 'as' => 'paypal.'],function(){
        Route::get('/paypal/payment', [PayPalController::class, 'payment'])->name('payment');
        Route::get('/paypal/success', [PayPalController::class, 'success'])->name('success');
        Route::get('/paypal/cancel', [PayPalController::class, 'cancel'])->name('cancel');
    });
    });
