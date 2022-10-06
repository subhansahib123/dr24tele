<?php

// Admin Controllers
use App\Http\Controllers\Admin\ProfessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PatientController;
// Hospital Controller

use App\Http\Controllers\Hospital\HospitalUserController;
use App\Http\Controllers\Hospital\HospitalPatientController;
use App\Http\Controllers\Hospital\HospitalDepartmentController;

use App\Http\Controllers\Hospital\ScheduleController;
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

Route::group(['namespace' => 'App\Http\Controllers'], function () {





    // Route::get('/logout', [AuthenticationController::class,'logout'])->name('logout');




    Route::group(['middleware' => ['guest']], function () {




        /**
         * Register Routes
         */
        // Route::get('/register', [AuthenticationController::class,'showRegister'])->name('register.show');
        // Route::post('/register', [AuthenticationController::class,'register'])->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/', function () {
            return view('home');
        });
        // Admin Login
        Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login.show');
        Route::post('/admin/login', [AuthenticationController::class, 'login'])->name('login.perform');

        Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');




        //Forget Password Routes
        // Route::get('forget-password', [SocialAuthenticationController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        // Route::post('forget-password', [SocialAuthenticationController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
        // Route::get('reset-password/{token}', [SocialAuthenticationController::class, 'showResetPasswordForm'])->name('reset.password.get');
        // Route::post('reset-password', [SocialAuthenticationController::class, 'submitResetPasswordForm'])->name('reset.password.post');

        Route::get('/hospital/login', [AuthenticationController::class, 'showHospitalLogin'])->name('hospital.login');
        Route::post('/logined', [AuthenticationController::class, 'hospitalLogin'])->name('hospitalLogin');
    });
    Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

        //temp Dashboard
        Route::get('/dashboard', [AuthenticationController::class, 'dashboard'])->name('dashboard');

        // This Route shows list of All Registered roles
        Route::get('/roles', [AuthenticationController::class, 'roles'])->name('roles');


        // This Route shows list of All Registered Professions
        Route::get('/professions', [ProfessionController::class, 'professions'])->name('professions');

        // This Route shows list of All Registered organizations
        Route::get('/organization/list', [OrganizationController::class, 'organization'])->name('organization');
        Route::get('/create/organization', [OrganizationController::class, 'create'])->name('create.organization');
        Route::get('/delete/organisation/{uuid}', [OrganizationController::class, 'deleteOrganisation'])->name('delete.organisation');

        Route::post('/organization', [OrganizationController::class, 'createOrganization'])->name('store.organization');
        //Get single record of organization and update it
        Route::get('/single/organization/{uuid}', [OrganizationController::class, 'singleOrganization'])->name('single.organization');
        Route::post('/update/organization', [OrganizationController::class, 'updateOrganization'])->name('update.organization');



        // This Route shows list Unmapped User (roles are not assigned)
        Route::get('/users/unmapped', [UserController::class, 'usersUnmapped'])->name('users.unmapped');
        //actual Users
        Route::get('/users/all', [UserController::class, 'allusersActual'])->name('users.all.actual');
        //Update actual Users
        Route::get('/update/user/{uuid}/{username}/{name}', [UserController::class, 'updateUser'])->name('updateUser');
        Route::post('/user/update', [UserController::class, 'userUpdated'])->name('userUpdated');
        //actual unmapped user
        Route::get('/unmapped/users', [UserController::class, 'allUnmappedUsersActual'])->name('users.unmapped.actual');
        //
        // This Route shows list ?
        Route::get('/all/users', [UserController::class, 'allusers'])->name('all.users');

        // These Routes are used to create Users
        Route::get('/create/user', [UserController::class, 'create_user'])->name('create.user');
        Route::post('/store/user', [UserController::class, 'store_user'])->name('store.user');

        // These Routes are used to Map Roles to Users
        Route::get('/mappingrole', [UserController::class, 'mapUser'])->name('mappingRole');
        Route::post('/mappedrole', [UserController::class, 'mapUserRole'])->name('role.mapped');

        // These Routes are used to Map Roles to Users
        Route::get('/updatingrole/{uuid}', [UserController::class, 'updateUserRole'])->name('updatingRole');
        Route::post('/updatedRole', [UserController::class, 'updateUserRoleStore'])->name('role.updated');


        //This Route is used to Create Patient
        Route::get('/create/patients', [PatientController::class, 'createPatients'])->name('create.patients');
        Route::post('/store/patients', [PatientController::class, 'storePatients'])->name('store.patients');

        //This Route is used to Map Patient with reference to Organization
        Route::get('/map/patients', [PatientController::class, 'mapPatients'])->name('map.patients');
        Route::post('/patient/mapped', [PatientController::class, 'patientMapped'])->name('patient.mapped');

        //This Route is used to show departments list
        Route::get('/departments/list/{uuid}', [DepartmentController::class, 'departmentsList'])->name('departments.list');

        //Get single record of organization and update it
        Route::get('/single/department/{uuid}', [OrganizationController::class, 'singleOrganization'])->name('single.department');
        Route::post('/update/department', [DepartmentController::class, 'updateDepartment'])->name('update.department');

        //This Route is used to show Patients list
        Route::get('/patients/list/{uuid}', [PatientController::class, 'patientsList'])->name('patients.list');
        //Show single patient
        Route::get('/update/patient/{personId}', [PatientController::class, 'updatePatient'])->name('update.patient');
        //Update patient
        Route::post('/patient/updated', [PatientController::class, 'patientUpdated'])->name('patient.updated');


        //Delete Patient
        Route::get('/patients/delete/{uuid}', [PatientController::class, 'patientDelete'])->name('patient.delete');
        //This Route is used to show Doctors list of a specific department
        Route::get('/doctors/list/{uuid}', [UserController::class, 'doctorsList'])->name('doctors.list');

        //This Route is used to show Doctors list of a specific department
        Route::get('/users/list/{uuid}', [UserController::class, 'usersList'])->name('users.list');
        //Delete User
        Route::get('/user/delete/{uuid}', [UserController::class, 'deleteUser'])->name('user.delete');
    });




    Route::group(['prefix' => 'hospital', 'middleware' => ['auth']], function () {
        // Routes used for login

        Route::get('/dashboard', [AuthenticationController::class, 'hospitalDashboard'])->name('hospital.dashboard');

        //Update Hospital
        Route::get('/update/hospital', [HospitalUserController::class, 'updateHospital'])->name('updateHospital');
        Route::post('/hospital/updated', [HospitalUserController::class, 'hospitalUpdated'])->name('hospitalUpdated');
        //Update  Profile
        Route::get('/update/password', [HospitalUserController::class, 'updatePassword'])->name('updatePassword');
        Route::post('/password/updated', [HospitalUserController::class, 'passwordUpdated'])->name('passwordUpdated');

        //Route that is used to view all users, all unmapped users and to create users
        Route::get('/all/users', [HospitalUserController::class, 'allHospitalUsers'])->name('allHospital.users');
        Route::get('/unmapped/users', [HospitalUserController::class, 'hospitalUnmappedUsers'])->name('hospitalUnmapped.Users');
        Route::get('/create/user', [HospitalUserController::class, 'createHospitalUser'])->name('createHospital.user');
        Route::post('/store/user', [HospitalUserController::class, 'storeHospitalUser'])->name('storeHospital.user');


        // These Routes are used to Map Roles to Users
        Route::get('/mapping/role', [HospitalUserController::class, 'mapHospitalUser'])->name('mapHospital.user');
        Route::post('/role/mapped', [HospitalUserController::class, 'hospitalUserMapped'])->name('hospitalUser.mapped');


        // These Routes are used to Map Roles to Users
        Route::get('/updating/role/{dep}', [HospitalUserController::class, 'updateHospitalUserRole'])->name('updatingUser.role');
        Route::post('/role/updated', [HospitalUserController::class, 'updateUserRoleStore'])->name('userUserRole.updated');

        //These Route is used to Create Mapped Patients
        Route::get('/createPatients', [HospitalPatientController::class, 'createHospitalPatients'])->name('createHospital.patients');
        Route::post('/storePatients', [HospitalPatientController::class, 'storeHospitalPatients'])->name('storeHospital.patients');

        //These Route is used to Create and view Departments


        Route::get('/departments', [HospitalDepartmentController::class, 'hospitalDepartmentsList'])->name('hospitalDepartments.list');
        Route::get('/create/department', [HospitalDepartmentController::class, 'createHospitalDepartment'])->name('createHospital.department');
        Route::post('/department/created', [HospitalDepartmentController::class, 'hospitalOrganizationCreated'])->name('hospitalOrganization.created');


        //This Route is used to show Doctors list of a specific department
        Route::get('/doctors/{uuid}', [HospitalUserController::class, 'hospitalDoctorsList'])->name('hospitalDoctors.list');

        //Create Schedule For Doctors
        Route::get('/create/schedule',[ScheduleController::class,'createSchedule'])->name('create.schedule');
        //list of Schedules
        Route::get('/schedules',[ScheduleController::class,'schedules'])->name('list.schedules');
        //Create Schedule For Doctors
        Route::get('/schedule/{id}',[ScheduleController::class,'delete'])->name('delete.schedule');
    });
    Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    });
    //'permission'
    Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    });
});
