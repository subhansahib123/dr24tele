<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{





    // Route::get('/logout', [AuthenticationController::class,'logout'])->name('logout');




    Route::group(['middleware' => ['guest']], function() {




        /**
         * Register Routes
         */
        // Route::get('/register', [AuthenticationController::class,'showRegister'])->name('register.show');
        // Route::post('/register', [AuthenticationController::class,'register'])->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', [AuthenticationController::class,'showLogin'])->name('login.show');
        Route::post('/login', [AuthenticationController::class,'login'])->name('login.perform');
        //temp Dashboard
        Route::get('/dashboard',[AuthenticationController::class,'dashboard'])->name('dashboard');
        Route::get('/roles',[AuthenticationController::class,'roles'])->name('roles');
        Route::get('/profession',[ProfessionController::class,'profession'])->name('profession');
        Route::get('/organization',[OrganizationController::class,'organization'])->name('organization');
        Route::get('/patient',[UserController::class,'patient'])->name('patient');
        Route::get('/allpatient',[UserController::class,'all_patient'])->name('all.patients');
        Route::get('/createuser',[UserController::class,'create_user'])->name('create.user');
        Route::post('/storeuser',[UserController::class,'store_user'])->name('store.user');

        //Forget Password Routes
        // Route::get('forget-password', [SocialAuthenticationController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        // Route::post('forget-password', [SocialAuthenticationController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
        // Route::get('reset-password/{token}', [SocialAuthenticationController::class, 'showResetPasswordForm'])->name('reset.password.get');
        // Route::post('reset-password', [SocialAuthenticationController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    });
    Route::group(['prefix' => 'user','middleware' => ['auth']], function() {




     });
//'permission'
    Route::group(['prefix' => 'admin','middleware' => ['auth']], function() {

    });
});

