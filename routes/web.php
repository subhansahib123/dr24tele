<?php

use App\Http\Controllers\ProfessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PatientController;

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
        Route::post('/logout', [AuthenticationController::class,'logout'])->name('logout');
        //temp Dashboard
        Route::get('/dashboard',[AuthenticationController::class,'dashboard'])->name('dashboard');

        // This Route shows list of All Registered roles
        Route::get('/roles',[AuthenticationController::class,'roles'])->name('roles');


        // This Route shows list of All Registered Professions
        Route::get('/professions',[ProfessionController::class,'professions'])->name('professions');

        // This Route shows list of All Registered organizations
        Route::get('/organization/list',[OrganizationController::class,'organization'])->name('organization');
        Route::get('/create/organization',[OrganizationController::class,'create'])->name('create.organization');


        Route::post('/organization',[OrganizationController::class,'createOrganization'])->name('store.organization');


        // This Route shows list Unmapped User (roles are not assigned)
        Route::get('/users/unmapped',[UserController::class,'usersUnmapped'])->name('users.unmapped');

        // This Route shows list ?
        Route::get('/all/users',[UserController::class,'allusers'])->name('all.users');

        // These Routes are used to create Users
        Route::get('/create/user',[UserController::class,'create_user'])->name('create.user');
        Route::post('/store/user',[UserController::class,'store_user'])->name('store.user');

        // These Routes are used to Map Roles to Users
        Route::get('/mappingrole',[UserController::class,'mapUser'])->name('mappingRole');
        Route::post('/mappedrole',[UserController::class,'mapUserRole'])->name('role.mapped');

        // These Routes are used to Map Roles to Users
        Route::get('/updatingrole',[UserController::class,'updateUserRole'])->name('updatingRole');
        Route::post('/updatedRole',[UserController::class,'updateUserRoleStore'])->name('role.updated');


        //This Route is used to Create Patient 
        Route::get('/create/patients',[PatientController::class,'createPatients'])->name('create.patients');
        Route::post('/store/patients',[PatientController::class,'storePatients'])->name('store.patients');

        //This Route is used to Map Patient with reference to Organization 
        Route::get('/map/patients',[PatientController::class,'mapPatients'])->name('map.patients');
        Route::post('/patient/mapped',[PatientController::class,'patientMapped'])->name('patient.mapped');
        
        //This Route is used to show departments list 
        Route::get('/departments/list/{uuid}',[DepartmentController::class,'departmentsList'])->name('departments.list');
        
        //This Route is used to show Patients list 
        Route::get('/patients/list/{uuid}',[PatientController::class,'patientsList'])->name('patients.list');
        
        //This Route is used to show Doctors list of a specific department 
        Route::get('/doctors/list/{uuid}',[UserController::class,'doctorsList'])->name('doctors.list');
        
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

