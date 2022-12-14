<?php

// Admin Controllers
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ProfessionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DepartmentSpecializationController;
use App\Http\Controllers\Doctor\CreationController;
use App\Http\Controllers\Doctor\EprescriptionController;
use App\Http\Controllers\Doctor\PersonalDetails;
use App\Http\Controllers\Doctor\ScheduleController as DoctorSchedule;
use App\Http\Controllers\Doctor\Specialization;
use App\Http\Controllers\DoctorSpecializationController;
use App\Http\Controllers\FrontEnd\TemplateController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\Hospital\HospitalCouponController;
use App\Http\Controllers\Hospital\HospitalDepartmentController;
use App\Http\Controllers\Hospital\HospitalPatientController;
use App\Http\Controllers\Hospital\HospitalUserController;
use App\Http\Controllers\Hospital\ScheduleController;
use App\Http\Controllers\Patient\FamilyMembersController;
use App\Http\Controllers\Patient\PatientsFeedbackController;
use App\Http\Controllers\Patient\PersonalDetails as PatientDetails;
use App\Http\Controllers\PatientAuthenticationController;

use App\Http\Controllers\Patient\PatientDocumentController;

use App\Http\Controllers\CurrencyController;


use Illuminate\Support\Facades\Route;


// Hospital Controller


//Front End Controller

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

  Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');


  //  Route::group(['middleware' => ['guest']], function () {




  /**
   * Register Routes
   */
  // Route::get('/register', [AuthenticationController::class,'showRegister'])->name('register.show');
  // Route::post('/register', [AuthenticationController::class,'register'])->name('register.perform');

  /**
   * Login Routes
   */
  Route::get('/', [homeController::class, 'index'])->name('home.page');
  Route::get('/allHospitals', [homeController::class, 'allHospitals'])->name('home.allHospitals');
  Route::get('/our-services', [homeController::class, 'ourServices'])->name('home.ourServices');
  Route::get('/hospital/{id}', [homeController::class, 'hospitalDetails'])->name('home.hospital_details');
  Route::get('/allDepartments/{id}', [homeController::class, 'allDepartments'])->name('home.allDepartments');
  Route::get('/getAllDepartments', [homeController::class, 'getAllDepartments'])->name('home.getAllDepartments');
  Route::get('/department/{id}', [homeController::class, 'departmentDetails'])->name('home.department_details');
  Route::get('/doctor-specializations', [homeController::class, 'doctorSpecializations'])->name('home.doctorSpecializations');
  Route::get('/department-specializations', [homeController::class, 'departmentSpecializations'])->name('home.departmentSpecializations');
  Route::get('/allDoctors/{id}', [homeController::class, 'allDoctors'])->name('home.allDoctors');
  Route::get('/getAllDoctors', [homeController::class, 'getAllDoctors'])->name('home.getAllDoctors');
  //departments
  Route::get('/departments/{orgid}', [homeController::class, 'departmentsOfHospital'])->name('departments.of.hospital');
  //doctors
  Route::get('/doctors/{dptId}', [homeController::class, 'doctorsOfDepartment'])->name('doctors.of.department');
  //appointment page
  Route::get('appointment/doctor/{id}', [homeController::class, 'appointment'])->name('load.appointment');
  //About_Us Page
  Route::get('/about-us', [TemplateController::class, 'aboutUs'])->name('aboutUs');
  //About_Us Page
  Route::get('/contact-us', [TemplateController::class, 'contactUs'])->name('contactUs');

  // How it Works
  Route::get('/how-it-works', [TemplateController::class, 'howItWorks'])->name('howItWorks');
  // How it Works
  Route::get('/hospitals-list', [TemplateController::class, 'hospitalsList'])->name('hospitalsList');
Route::get('/convert-currency/{to}',[CurrencyController::class,'ConvertCurrency'])->name('convertCurrency');
  //Rating page

  Route::get('/rate-doctor', [PatientsFeedbackController::class, 'index'])->name('rateDoctor');
  Route::post('/doctor/rated', [PatientsFeedbackController::class, 'store'])->name('doctorRated');
  //Bl0g Grid Page
  Route::get('/blog-grid', [TemplateController::class, 'blogGrid'])->name('blogGrid');
  //Blog Left Sidebar Page
  Route::get('/blog-right-sidebar', [TemplateController::class, 'blogRightSidebar'])->name('blogRightSidebar');
  //Blog Right Sidebar Page
  Route::get('/blog-left-sidebar', [TemplateController::class, 'blogLeftSidebar'])->name('blogLeftSidebar');

  //Left Sidebar Page
  Route::get('/left-sidebar', [TemplateController::class, 'leftSidebar'])->name('leftSidebar');
  //Right Sidebar Page
  Route::get('/right-sidebar', [TemplateController::class, 'rightSidebar'])->name('rightSidebar');
  //No Sidebar Page
  Route::get('/no-sidebar', [TemplateController::class, 'noSidebar'])->name('noSidebar');


  //Book Appointment Page
  Route::get('/book-appointment', [TemplateController::class, 'bookAppointment'])->name('bookAppointment');
  //Team Page
  Route::get('/our-team', [TemplateController::class, 'ourTeam'])->name('ourTeam');
  //Faq Page
  Route::get('/faq', [TemplateController::class, 'faq'])->name('faq');

  //Privacy Policy Page
  Route::get('/privacy-policy', [TemplateController::class, 'privacyPolicy'])->name('privacyPolicy');
  //Error Page
  Route::get('/error-page', [TemplateController::class, 'errorPage'])->name('errorPage');
  //No Sidebar Page
  Route::get('/terms-of-service', [TemplateController::class, 'termsOfService'])->name('termsOfService');

  //Testimonials Page
  Route::get('/testimonials', [TemplateController::class, 'testimonials'])->name('testimonials');
  //No Sidebar Page
  Route::get('/pricing-plan', [TemplateController::class, 'pricingPlan'])->name('pricingPlan');



  //patient login
  // Route::get('/login',[AuthController::class,'login'])->name('patient.login');

  // Admin Login
  Route::get('/admin/login', [AuthenticationController::class, 'showLogin'])->name('login.show');
  Route::post('/admin/login', [AuthenticationController::class, 'login'])->name('login.perform');

  //hospital login
  Route::get('/hospital/login/page', [AuthenticationController::class, 'showHospitalLogin'])->name('hospital.login');
  Route::post('/hospital/logined', [AuthenticationController::class, 'hospitalLogin'])->name('hospital.loggedin');

  //doctor login
  Route::get('/doctor/login', [AuthenticationController::class, 'showDoctorLogin'])->name('doctor.login');
  Route::post('/doctor/logined', [AuthenticationController::class, 'doctorLogin'])->name('doctor.loggedin');

  //paitent Register

  Route::get('/patient/register', [PatientAuthenticationController::class, 'register'])->name('patient.register');
  Route::post('/patient/registered', [PatientAuthenticationController::class, 'patientSignUp'])->name('patient.registered');

  //patient Login
  Route::get('/patient/login', [PatientAuthenticationController::class, 'login'])->name('patient.login');
  Route::post('/patient/logined', [PatientAuthenticationController::class, 'performLogin'])->name('patient.loggedin');


  Route::get('/conference/call', [PatientAuthenticationController::class, 'conference_call'])->name('conference');
  //  });
  //'permission'
  Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:ehrnadmin']], function () {

    //temp Dashboard
    Route::get('/dashboard', [AuthenticationController::class, 'dashboard'])->name('dashboard');

    // This Route shows list of All Registered roles
    Route::get('/roles', [AuthenticationController::class, 'roles'])->name('roles');
    //Create Specialization
    // Route::get('/create/specialization', [DoctorSpecializationController::class, 'index'])->name('createSpecialization');
    // Route::post('/specialization/created', [DoctorSpecializationController::class, 'create'])->name('specializationCreated');
    // //List of Specialization
    // Route::get('/show/specialization', [DoctorSpecializationController::class, 'show'])->name('showSpecialization');
    // //Update Specialization
    // Route::get('/update/specialization/{id}', [DoctorSpecializationController::class, 'updateView'])->name('updateSpecialization');
    // Route::post('/specialization/updated', [DoctorSpecializationController::class, 'update'])->name('specializationUpdated');
    //Create Department Specialization
    Route::get('/create/department-specialization', [DepartmentSpecializationController::class, 'index'])->name('create.departmentSpecialization');
    Route::post('/department-specialization/created', [DepartmentSpecializationController::class, 'create'])->name('departmentSpecialization.created');
    //List of Department Specialization
    Route::get('/show/department-specialization', [DepartmentSpecializationController::class, 'show'])->name('show.departmentSpecialization');
    //Update Department Specialization
    Route::get('/update/department-specialization/{id}', [DepartmentSpecializationController::class, 'updateView'])->name('update.departmentSpecialization');
    Route::post('/department-specialization/updated', [DepartmentSpecializationController::class, 'update'])->name('departmentSpecialization.Updated');
    //Create Doctor
    Route::get('/create/doctor/{uuid}', [CreationController::class, 'create'])->name('createDoctor');
    Route::post('/doctor/created', [CreationController::class, 'store'])->name('doctorCreated');
    //This Route is used to Map Patient with reference to Organization
    Route::get('/map/doctor/{userUuid}/{depUuid}', [CreationController::class, 'mapDoctor'])->name('mapDoctor');
    Route::post('/doctor/mapped', [CreationController::class, 'doctorMapped'])->name('doctorMapped');

    // This Route shows list of All Registered Professions
    Route::get('/professions', [ProfessionController::class, 'professions'])->name('professions');

    // This Route shows list of All Registered organizations
    Route::get('/organization/list', [OrganizationController::class, 'organization'])->name('organization');
    Route::get('/create/organization', [OrganizationController::class, 'create'])->name('create.organization');
    Route::get('/delete/organisation/{uuid}', [OrganizationController::class, 'deleteOrganisation'])->name('delete.organisation');
    Route::get('/delete/department/{uuid}', [DepartmentController::class, 'deleteDepartment'])->name('delete.department');
    Route::get('/feature/organization/{uuid}', [OrganizationController::class, 'featureOrganization'])->name('featureOrganization');

    Route::post('/organization', [OrganizationController::class, 'createOrganization'])->name('store.organization');
    //Get single record of organization and update it
    Route::get('/single/organization/{uuid}', [OrganizationController::class, 'singleOrganization'])->name('single.organization');
    Route::post('/update/organization', [OrganizationController::class, 'updateOrganization'])->name('update.organization');



    //create Department
    Route::get('/create/departments/{uuid}', [DepartmentController::class, 'index'])->name('create.newDepartment');
    Route::post('/department/created', [DepartmentController::class, 'create'])->name('newDepartment.created');


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
    Route::get('/create/user/{uuid}', [UserController::class, 'create_user'])->name('create.user');
    Route::post('/store/user', [UserController::class, 'store_user'])->name('store.user');

    // These Routes are used to Map Roles to Users
    Route::get('/mappingrole/{orgId}', [UserController::class, 'mapUser'])->name('mappingRole');
    Route::post('/mappedrole', [UserController::class, 'mapUserRole'])->name('role.mapped');

    Route::get('/doctor/delete/{uuid}', [UserController::class, 'doctorDelete'])->name('doctor.delete');

    // These Routes are used to Map Roles to Users
    Route::get('/updatingrole/{orgUuid}/{userUuid}', [UserController::class, 'updateUserRole'])->name('updatingRole');
    Route::post('/updatedRole', [UserController::class, 'updateUserRoleStore'])->name('role.updated');
    Route::get('/user/delete/{uuid}', [UserController::class, 'userDelete'])->name('user.delete');


    //This Route is used to Create Patient
    Route::get('/create/patients/{uuid}', [PatientController::class, 'createPatients'])->name('create.patients');
    Route::post('/store/patients', [PatientController::class, 'patient'])->name('store.patients');

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
    //Update patient
    Route::post('/patient/updated', [PatientController::class, 'patientUpdated'])->name('patient.updated');


    //Delete Patient
    Route::get('/patients/delete/{uuid}', [PatientController::class, 'patientDelete'])->name('patient.delete');
    //This Route is used to show Doctors list of a specific department
    Route::get('/doctors/list/{uuid}', [UserController::class, 'doctorsList'])->name('doctors.list');

    //This Route is used to show Doctors list of a specific department
    Route::get('/users/list/{uuid}', [UserController::class, 'usersList'])->name('users.list');
    //Delete User
  });




  Route::group(['prefix' => 'hospital', 'middleware' => ['auth', 'role:frontoffice,orgsuperadmin']], function () {
    // Routes used for login

    Route::get('/dashboard/page', [AuthenticationController::class, 'hospitalDashboard'])->name('hospital.dashboard');
    Route::get('/delete/department/{uuid}', [HospitalDepartmentController::class, 'deleteDepartment'])->name('hospital.delete.department');
    //Update Hospital
    Route::get('/update/hospital', [HospitalUserController::class, 'updateHospital'])->name('updateHospital');
    Route::post('/hospital/updated', [HospitalUserController::class, 'hospitalUpdated'])->name('hospitalUpdated');
    //Update  Profile
    Route::get('/update/password', [HospitalUserController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/password/updated', [HospitalUserController::class, 'passwordUpdated'])->name('passwordUpdated');
    Route::get('/doctor/delete/{uuid}', [UserController::class, 'doctorDelete'])->name('hospital.doctor.delete');
    //Route that is used to view all users, all unmapped users and to create users
    Route::get('/all/users', [HospitalUserController::class, 'allHospitalUsers'])->name('allHospital.users');
    Route::get('/unmapped/users', [HospitalUserController::class, 'hospitalUnmappedUsers'])->name('hospitalUnmapped.Users');
    Route::get('/create/user', [HospitalUserController::class, 'createHospitalUser'])->name('createHospital.user');
    Route::post('/store/user', [HospitalUserController::class, 'storeHospitalUser'])->name('storeHospital.user');

    Route::get('/user/delete/{uuid}', [HospitalUserController::class, 'userDelete'])->name('delete.hospitalUser');

    //Create Department Specialization
    Route::get('/create/department/specialization', [DepartmentSpecializationController::class, 'index'])->name('createDepartment.specialization');
    Route::post('/department-specialization/created', [DepartmentSpecializationController::class, 'create'])->name('department.specializationCreated');
    //List of Department Specialization
    Route::get('/show/department-specialization', [DepartmentSpecializationController::class, 'show'])->name('showDepartment.specialization');
    //Update Department Specialization
    Route::get('/update/department-specialization/{id}', [DepartmentSpecializationController::class, 'updateView'])->name('updateDepartment.specialization');
    Route::post('/department-specialization/updated', [DepartmentSpecializationController::class, 'update'])->name('department.specializationUpdated');

    //Create Doctor Specialization
    // Route::get('/create/doctor-specialization', [DoctorSpecializationController::class, 'index'])->name('create.specialization');
    // Route::post('/doctor-specialization/created', [DoctorSpecializationController::class, 'create'])->name('specialization.created');
    // //List of Doctor Specialization
    // Route::get('/show/doctor-specialization', [DoctorSpecializationController::class, 'show'])->name('show.specialization');
    // //Update Doctor Specialization
    // Route::get('/update/doctor-specialization/{id}', [DoctorSpecializationController::class, 'updateView'])->name('update.specialization');
    // Route::post('/doctor-specialization/updated', [DoctorSpecializationController::class, 'update'])->name('specialization.updated');

    //Create Doctor
    Route::get('/create/doctor/{uuid}', [CreationController::class, 'create'])->name('create.doctor');
    Route::post('/doctor/created', [CreationController::class, 'store'])->name('doctor.created');
    //This Route is used to Map Patient with reference to Organization
    Route::get('/map/doctor/{$userUuid}/{depUuid}', [CreationController::class, 'mapDoctor'])->name('map.doctor');
    Route::post('/doctor/mapped', [CreationController::class, 'doctorMapped'])->name('doctor.mapped');

    // These Routes are used to Map Roles to Users
    Route::get('/mapping/role/', [HospitalUserController::class, 'mapHospitalUser'])->name('mapHospital.user');
    Route::post('/role/mapped', [HospitalUserController::class, 'hospitalUserMapped'])->name('hospitalUser.mapped');


    // These Routes are used to Map Roles to Users
    Route::get('/updating/role/{uuid}', [HospitalUserController::class, 'updateHospitalUserRole'])->name('updatingUser.role');
    Route::post('/role/updated', [HospitalUserController::class, 'updateUserRoleStore'])->name('userUserRole.updated');

    //These Route is used to Create Mapped Patients
    Route::get('/createPatient/page', [HospitalPatientController::class, 'createHospitalPatients'])->name('createHospital.patients');
    Route::post('/storePatient', [HospitalPatientController::class, 'storeHospitalPatients'])->name('storeHospital.patients');

    //These Route is used to Create Mapped Patients
    Route::get('/all/patients', [HospitalPatientController::class, 'hospitalAllPatients'])->name('hospitalAll.patients');
    Route::get('/patients/delete/{uuid}', [HospitalPatientController::class, 'patientDelete'])->name('delete.hospitalPatient');

    //This Route is used to view Departments
    Route::get('/departments/page', [HospitalDepartmentController::class, 'hospitalDepartmentsList'])->name('hospitalDepartments.list');

    //Route to Create Department
    Route::get('/create/department', [HospitalDepartmentController::class, 'createHospitalDepartment'])->name('createHospital.department');
    Route::post('/department/created', [HospitalDepartmentController::class, 'hospitalDepartmentCreated'])->name('hospitalDepartment.created');

    //Route to update Department
    Route::get('/update/department/{uuid}', [HospitalDepartmentController::class, 'updateHospitalDepartment'])->name('updateHospital.department');
    Route::post('/department/updated', [HospitalDepartmentController::class, 'hospitalDepartmentUpdated'])->name('hospitalDepartment.updated');
    Route::get('/delete/department/{uuid}', [DepartmentController::class, 'deleteDepartment'])->name('delete.hospitalDepartment');


    //This Route is used to show Doctors list of a specific department
    Route::get('/doctors/{uuid}', [HospitalUserController::class, 'hospitalDoctorsList'])->name('hospitalDoctors.list');
    Route::get('/delete/doctors/{uuid}', [HospitalUserController::class, 'deleteHospitalDoctor'])->name('deleteHospital.doctor');

    //Create Schedule For Doctors
    Route::get('/create/schedule', [ScheduleController::class, 'createSchedule'])->name('create.schedule');
    Route::post('/store/schedule', [ScheduleController::class, 'insert'])->name('store.schedule');
    Route::get('/schedule/edit/{id}', [ScheduleController::class, 'edit'])->name('edit.schedule');
    Route::post('update/schedule', [ScheduleController::class, 'update'])->name('update.schedule');
    //list of Schedules
    Route::get('/schedules/page', [ScheduleController::class, 'schedules'])->name('list.schedules');
    //Create Schedule For Doctors
    Route::get('/schedule/{id}', [ScheduleController::class, 'delete'])->name('delete.schedule');


    Route::get('/hospital-coupon/create', [HospitalCouponController::class, 'create'])->name('hospital.coupon.create');
    Route::get('/hospital-coupon/index', [HospitalCouponController::class, 'index'])->name('hospital.coupon.index');
    Route::get('/hospital-coupon/assign', [HospitalCouponController::class, 'assignUser'])->name('hospital.coupon.assign');
    Route::post('/hospital-coupon/assign', [HospitalCouponController::class, 'assignUserPost'])->name('hospital.coupon.assigncoupon');
    Route::post('/hospital-coupon/create', [HospitalCouponController::class, 'store'])->name('hospital.coupon.store');
  });
  Route::group(['prefix' => 'doctor', 'middleware' => ['auth', 'role:practitioner',]], function () {
    Route::get('/dashboard', [AuthenticationController::class, 'DoctorDashboard'])->name('doctor.dashboard');

    //Update User name
    Route::get('/update/displayName', [PersonalDetails::class, 'updateDisplayName'])->name('updateDisplayName');
    Route::post('/displayName/updated', [PersonalDetails::class, 'displayNameUpdated'])->name('displayNameUpdated');
    //verify Phone Number
    Route::get('/verify/phoneNumber', [PersonalDetails::class, 'verifyPhoneNumber'])->name('verifyPhoneNumber');
    Route::post('/phoneNumber/verified', [PersonalDetails::class, 'phoneNumberVerified'])->name('phoneNumberVerified');
    //Update phone number
    Route::post('/phoneNumber/updated', [PersonalDetails::class, 'phoneNumberUpdated'])->name('phoneNumberUpdated');

    //Create Schedule
    Route::get('/create/schedule', [DoctorSchedule::class, 'createSchedule'])->name('create.schedule.doctor');
    //store Schedule
    Route::post('/store/schedule', [DoctorSchedule::class, 'insert'])->name('store.schedule.doctor');
    //Doctor Specialization
    Route::get('/specialization', [Specialization::class, 'index'])->name('doctorSpecialization');
    Route::post('/specialized', [Specialization::class, 'store'])->name('doctorSpecialized');

    //list of Schedules
    Route::get('/schedules', [DoctorSchedule::class, 'schedules'])->name('list.schedules.doctor');
    //Create Schedule
    Route::get('/schedule/{id}', [DoctorSchedule::class, 'delete'])->name('delete.schedule.doctor');
    Route::get('/schedule/edit/{id}', [DoctorSchedule::class, 'edit'])->name('edit.schedule.doctor');
    Route::post('update/schedule', [DoctorSchedule::class, 'update'])->name('update.schedule.doctor');
    Route::post('upload/letter', [DoctorSchedule::class, 'eLetter'])->name('doctor.eLetter');
    Route::get('/appointments', [DoctorSchedule::class, 'appointments'])->name('doctor.appointments');
    Route::get('/appointment/details-page/{id}', [DoctorSchedule::class, 'appointmentDetails'])->name('appointment.Details');
    Route::get('/appointments/list', [DoctorSchedule::class, 'appointmentList'])->name('doctor.appointments.list');
    Route::get('/eprescription/create', [EprescriptionController::class, 'create'])->name('doctor.eprescription.create');
    Route::post('/eprescription/store', [EprescriptionController::class, 'store'])->name('doctor.eprescription.store');
  });
  Route::group(['prefix' => 'patient', 'middleware' => ['auth']], function () {
    Route::get('/logout', [PatientAuthenticationController::class, 'logout'])->name('patient.logout');
    Route::get('/dashboard', [PatientAuthenticationController::class, 'patientDashboard'])->name('patient.dashboard');


    //Create Members
    Route::get('/create/member', [FamilyMembersController::class, 'index'])->name('createMembers');
    Route::post('/member/created', [FamilyMembersController::class, 'create'])->name('membersCreated');
    //List of Members
    Route::get('/show/members', [FamilyMembersController::class, 'show'])->name('showMembers');
    //Update Members
    Route::get('/update/members/{id}', [FamilyMembersController::class, 'updateView'])->name('updateMembers');
    Route::post('/members/updated', [FamilyMembersController::class, 'update'])->name('membersUpdated');
    //Delete Members
    Route::get('/delete/members/{id}', [FamilyMembersController::class, 'delete'])->name('deleteMembers');


    Route::get('/displayName/update', [PatientDetails::class, 'displayNameUpdate'])->name('displayNameUpdate');
    Route::post('/Name/updated', [PatientDetails::class, 'displayNameUpdated'])->name('display.NameUpdated');


    Route::get('/verify/number', [PatientDetails::class, 'verifyPhoneNumber'])->name('verify.phoneNumber');
    Route::get('/document', [PatientDocumentController::class, 'index'])->name('document.index');
    Route::get('/document/create', [PatientDocumentController::class, 'create'])->name('document.create');
    Route::delete('/document/delete/{id}', [PatientDocumentController::class, 'destroy'])->name('document.delete');


    Route::post('/document/save', [PatientDocumentController::class, 'store'])->name('document.save');
    Route::get('/appointment/details-page/{id}', [PatientDetails::class, 'appointmentDetails'])->name('appointmentDetails');
    Route::post('/upload/records', [PatientDetails::class, 'uploadRecords'])->name('uploadRecords');
    Route::post('/Number/verified', [PatientDetails::class, 'phoneNumberVerified'])->name('phone.numberVerified');
    Route::post('/phoneNumber/updated', [PatientDetails::class, 'phoneNumberUpdated'])->name('phoneNumber.updated');


    Route::get('/appointments', [PatientAuthenticationController::class, 'appointments'])->name('appointments');
  });


  //Please Don't Change the location of this Route Other-Wise U have to face lots of errors
  Route::get('/doctor/{id}', [homeController::class, 'doctorDetails'])->name('home.doctor_details');
});
