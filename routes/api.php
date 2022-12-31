<?php

use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\API\Doctor\APIDoctorAuthenticationController;
use App\Http\Controllers\API\Doctor\APIDoctorScheduleController;
use App\Http\Controllers\API\Doctor\APIDoctorSpecializationController;
use App\Http\Controllers\API\Front\MainController;
use App\Http\Controllers\API\Patient\APIFamilyMembersController;
use App\Http\Controllers\API\Patient\APIPatientAuthenticationController;
use App\Http\Controllers\API\Patient\APIPersonalDetailsController;
use App\Http\Controllers\API\Doctor\APIPersonalDetailsController as PersonDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\PatientAuthenticationController;
use App\Http\Controllers\CurrencyController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Person
Route::post('/person/create',[PersonController::class,'create'])->name('person.create');
Route::get('/states/{country_id}',[OrganizationController::class,'states'])->name('load.states');
Route::get('/cities/{state_id}',[OrganizationController::class,'cities'])->name('load.cities');
Route::get('/getDepartments/{orgUuid}',[OrganizationController::class,'getDepartments'])->name('get.departments');

//create schedule and get storeHospitalPatients
// Route::post('/store/schedule',[ScheduleController::class,'insert'])->name('store.schedule');
// Route::post('/update/slots',[ScheduleController::class,'updateSlots'])->name('update.slot');
Route::get('/get/schedules/{doctor_id}/{date}',[homeController::class,'scheduleOfDoctor'])->name('get.schedules');
Route::get('/get/schedules/{id}',[homeController::class,'daySchedule'])->name('get.day.schedule');
Route::get('/get/schedules/{schedule_id}/{coupon}/coupon',[homeController::class,'scheduleOfDoctorCoupon'])->name('get.schedules.coupon');
Route::post('/book/appointment',[homeController::class,'bookApppointment'])->name('book.appointment');
Route::post('/apply-coupon',[\App\Http\Controllers\Hospital\HospitalCouponController::class,'applyCoupon'])->name('apply.coupon');
Route::post('/store-token', [homeController::class, 'storeToken'])->name('store.token');

Route::post('/send-web-notification', [homeController::class, 'sendWebNotification'])->name('send.web-notification');
Route::get('/agoraToken',[PatientAuthenticationController::class,'generate_token' ]);

Route::get('/convert-currency',[CurrencyController::class,'ConvertCurrency'])->name('convert.currency');
//Front
Route::get('/', [MainController::class, 'index']);
Route::get('/hospital/{id}', [MainController::class, 'hospitalDetails']);
Route::get('/department/{id}', [MainController::class, 'departmentDetails']);
Route::get('/allDoctors/{id}', [MainController::class, 'allDoctors']);
Route::get('/department-specializations', [MainController::class, 'departmentSpecializations']);
Route::get('/allDepartments/{id}', [MainController::class, 'allDepartments']);
Route::get('/doctor-specializations', [MainController::class, 'doctorSpecializations']);
Route::get('/getAllDoctors', [MainController::class, 'getAllDoctors']);
//Patient
Route::post('/patient/logined', [APIPatientAuthenticationController::class, 'performLogin']);
Route::get('/patient/get-organizations', [APIPatientAuthenticationController::class, 'getOrganizations']);
Route::post('/patient/registered', [APIPatientAuthenticationController::class, 'patientSignUp']);
Route::group(['prefix' => 'patient','middleware' => ['auth:sanctum']], function () {
    Route::post('/member/created', [APIFamilyMembersController::class, 'create'])->name('api.membersCreated');
    Route::get('/member/list', [APIFamilyMembersController::class, 'list'])->name('api.membersList');
    Route::post('/member/updated/{id}', [APIFamilyMembersController::class, 'update'])->name('api.membersUpdated');
    Route::post('/member/delete/{id}', [APIFamilyMembersController::class, 'delete'])->name('api.deleteMembers');
    Route::post('/Number/updated', [APIPersonalDetailsController::class, 'phoneNumberUpdated'])->name('api.phone.NumberUpdated');
    Route::post('/displayName/updated', [APIPersonalDetailsController::class, 'displayNameUpdated'])->name('api.displayNameUpdated');
    Route::get('/appointments', [APIPersonalDetailsController::class, 'appointments'])->name('api.appointments');
    Route::post('/logout', [APIPatientAuthenticationController::class, 'logout']);
});
//Doctor
Route::post('/doctor/logined', [APIDoctorAuthenticationController::class, 'doctorLogin']);
Route::group(['prefix' => 'doctor','middleware' => ['auth:sanctum']], function () {
    Route::post('/store/schedule', [APIDoctorScheduleController::class, 'insert'])->name('api.store.schedule.doctor');
    Route::get('/schedules', [APIDoctorScheduleController::class, 'schedules'])->name('api.list.schedules.doctor');
    Route::post('update/schedule/{id}', [APIDoctorScheduleController::class, 'update'])->name('api.update.schedule.doctor');
    Route::post('/delete/schedule/{id}', [APIDoctorScheduleController::class, 'delete'])->name('api.delete.schedule.doctor');
    Route::get('/appointments', [APIDoctorScheduleController::class, 'appointments'])->name('api.doctor.appointments');
    Route::post('/displayName/updated', [PersonDetails::class, 'displayNameUpdated'])->name('api.displayNameUpdatedDoctor');
    Route::get('/specialization', [APIDoctorSpecializationController::class, 'index'])->name('api.doctorSpecialization');
    Route::post('/specialized', [APIDoctorSpecializationController::class, 'store'])->name('api.doctorSpecialized');
});

