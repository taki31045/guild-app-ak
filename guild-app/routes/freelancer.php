<?php
    use App\Http\Controllers\FreelanceController;

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
    Route::get('/profile/{id}/other', [App\Http\Controllers\Company\Profile\ProfileController::class, 'show'])->name('company.profile.show');

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
    Route::post('/projects/{id}/submit', [App\Http\Controllers\Freelancer\ProjectController::class, 'submitWork'])->name('projects.submit');
    Route::get('/download/{id}', [App\Http\Controllers\Freelancer\ProjectController::class, 'downloadFile'])->name('download.file');
    Route::get('/projects/{id}/result', [App\Http\Controllers\Freelancer\ProjectController::class, 'result'])->name('projects.result');

    //message
    Route::get('/messages/{id}/show', [App\Http\Controllers\Freelancer\MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{id}/store', [App\Http\Controllers\Freelancer\MessageController::class, 'store'])->name('messages.store');

    // contact
    Route::get('/contact', [App\Http\Controllers\Freelancer\ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send', [App\Http\Controllers\Freelancer\ContactController::class, 'sendMail'])->name('contact.send');

    });
?>