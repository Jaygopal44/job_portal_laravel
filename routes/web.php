<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobApplicationController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use App\Http\Middleware\AuthToken;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobsController::class, 'index'])->name('jobs');
Route::get('/jobs/detail/{id}', [JobsController::class, 'detail'])->name('jobDetail');
Route::post('/apply-job', [JobsController::class, 'applyJob'])->name('applyJob');
Route::post('/save-job', [JobsController::class, 'saveJob'])->name('saveJob');





// authenticated routes
Route::middleware(['checkuser:auth'])->group(function () {
    Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::get('/account/logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::put('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
    Route::post('/update-profile-image', [AccountController::class, 'updateProfileImage'])->name('account.updateProfileImage');
    Route::get('/account/create-job', [AccountController::class, 'createJob'])->name('account.createJob');
    Route::post('/account/save-job', [AccountController::class, 'saveJob'])->name('account.saveJob');
    Route::get('/account/my-jobs', [AccountController::class, 'myJobs'])->name('account.myJobs');
    Route::get('/account/my-jobs/edit/{jobId}', [AccountController::class, 'editJob'])->name('account.editJob');
    Route::post('/update-job/{jobId}', [AccountController::class, 'updateJob'])->name('account.updateJob');
    Route::post('/delete-job', [AccountController::class, 'deleteJob'])->name('account.deleteJob');


    Route::get('/my-job-applications', [AccountController::class, 'myJobApplications'])->name('account.myJobApplications');

    Route::post('/remove-job-application', [AccountController::class, 'removeJobs'])->name('account.removeJobs');
    Route::get('/saved-jobs', [AccountController::class, 'savedJobs'])->name('account.savedJobs');
    Route::post('/remove-saved-job', [AccountController::class, 'removeSavedJob'])->name('account.removeSavedJob');
    Route::post('/update-password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');
});

// guest routes
Route::middleware(['checkuser:guest'])->group(function () {
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

    Route::get('/account/register', [AccountController::class, 'registration'])->name('account.registration');
    Route::post('/account/register-insert', [AccountController::class, 'processRegister'])->name('account.processRegister');
    Route::get('/account/login', [AccountController::class, 'login'])->name('account.login');
    Route::post('/account/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
});
