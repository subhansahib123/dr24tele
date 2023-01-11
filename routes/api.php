<?php

use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\API\Doctor\APIDoctorAuthenticationController;
use App\Http\Controllers\API\Doctor\APIDoctorScheduleController;
use App\Http\Controllers\API\Front\MainController;
use App\Http\Controllers\API\Patient\APIFamilyMembersController;
use App\Http\Controllers\API\Patient\APIPatientAuthenticationController;
use App\Http\Controllers\API\Patient\APIPersonalDetailsController;
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
Route::post('/person/create',[PersonController::class,'create']);
Route::get('/states/{country_id}',[OrganizationController::class,'states']);
Route::get('/cities/{state_id}',[OrganizationController::class,'cities']);
Route::get('/getDepartments/{orgUuid}',[OrganizationController::class,'getDepartments']);

//create schedule and get storeHospitalPatients
// Route::post('/store/schedule',[ScheduleController::class,'insert'])->name('store.schedule');
// Route::post('/update/slots',[ScheduleController::class,'updateSlots'])->name('update.slot');
Route::get('/get/schedules/{doctor_id}/{date}/{patient_id}',[homeController::class,'scheduleOfDoctor']);
Route::get('/get/schedules/{id}',[homeController::class,'daySchedule']);
Route::get('/get/schedules/{schedule_id}/{coupon}/coupon',[homeController::class,'scheduleOfDoctorCoupon']);
Route::post('/book/appointment',[homeController::class,'bookApppointment']);
Route::post('/apply-coupon',[\App\Http\Controllers\Hospital\HospitalCouponController::class,'applyCoupon']);
Route::post('/store-token', [homeController::class, 'storeToken']);

Route::post('/send-web-notification', [homeController::class, 'sendWebNotification']);
Route::get('/agoraToken',[PatientAuthenticationController::class,'generate_token' ]);

Route::get('/convert-currency',[CurrencyController::class,'ConvertCurrency']);
//Front
Route::get('/', [MainController::class, 'index']);
Route::get('/hospitals-list', [MainController::class, 'hospitalsList']);
Route::get('/hospital/{id}', [MainController::class, 'hospitalDetails']);
Route::get('/department/{id}', [MainController::class, 'departmentDetails']);
Route::get('/doctor-details/{id}', [MainController::class, 'doctorDetails']);
Route::get('/department-specializations', [MainController::class, 'departmentSpecializations']);
Route::get('/allDepartments/{id}', [MainController::class, 'allDepartments']);
//Patient
Route::post('/patient/logined', [APIPatientAuthenticationController::class, 'performLogin']);
Route::post('/patient/registered', [APIPatientAuthenticationController::class, 'patientSignUp']);
Route::group(['prefix' => 'patient','middleware' => ['auth:sanctum']], function () {
    Route::post('/member/created', [APIFamilyMembersController::class, 'create']);
    Route::get('/member/list', [APIFamilyMembersController::class, 'list']);
    Route::post('/member/updated/{id}', [APIFamilyMembersController::class, 'update']);
    Route::post('/member/delete/{id}', [APIFamilyMembersController::class, 'delete']);
    Route::post('/Number/updated', [APIPersonalDetailsController::class, 'phoneNumberUpdated']);
    Route::post('/displayName/updated', [APIPersonalDetailsController::class, 'displayNameUpdated']);
    Route::get('/appointments', [APIPersonalDetailsController::class, 'appointments']);
    Route::post('/logout', [APIPatientAuthenticationController::class, 'logout']);
});
//Doctor
Route::post('/doctor/logined', [APIDoctorAuthenticationController::class, 'doctorLogin']);
Route::group(['prefix' => 'doctor','middleware' => ['auth:sanctum']], function () {
    Route::post('/store/schedule', [APIDoctorScheduleController::class, 'insert']);
    Route::get('/schedules', [APIDoctorScheduleController::class, 'schedules']);
    Route::post('update/schedule/{id}', [APIDoctorScheduleController::class, 'update']);
    Route::post('/delete/schedule/{id}', [APIDoctorScheduleController::class, 'delete']);
    Route::get('/appointments', [APIDoctorScheduleController::class, 'appointments']);
    Route::post('/logout', [APIDoctorScheduleController::class, 'logout']);
});

