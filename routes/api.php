<?php

use App\Http\Controllers\Admin\PersonController;
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
Route::post('/person/create',[PersonController::class,'create'])->name('person.create');
Route::get('/states/{country_id}',[OrganizationController::class,'states'])->name('load.states');
Route::get('/cities/{state_id}',[OrganizationController::class,'cities'])->name('load.cities');
Route::get('/getDepartments/{orgUuid}',[OrganizationController::class,'getDepartments'])->name('get.departments');

//create schedule and get storeHospitalPatients
// Route::post('/store/schedule',[ScheduleController::class,'insert'])->name('store.schedule');
// Route::post('/update/slots',[ScheduleController::class,'updateSlots'])->name('update.slot');
Route::get('/get/schedules/{doctor_id}/{date}',[homeController::class,'scheduleOfDoctor'])->name('get.schedules');
Route::get('/get/schedules/{doctor_id}/{date}/{coupon}/coupon',[homeController::class,'scheduleOfDoctorCoupon'])->name('get.schedules.coupon');
Route::post('/book/appointment',[homeController::class,'bookApppointment'])->name('book.appointment');
Route::post('/apply-coupon',[\App\Http\Controllers\Hospital\HospitalCouponController::class,'applyCoupon'])->name('apply.coupon');
Route::post('/store-token', [homeController::class, 'storeToken'])->name('store.token');

Route::post('/send-web-notification', [homeController::class, 'sendWebNotification'])->name('send.web-notification');
Route::get('/agoraToken',[PatientAuthenticationController::class,'generate_token' ]);

Route::get('/convert-currency',[CurrencyController::class,'ConvertCurrency'])->name('convert.currency');

//Patient
Route::post('/patient/logined', [APIPatientAuthenticationController::class, 'performLogin']);

Route::group(['prefix' => 'patient','middleware' => ['auth:sanctum']], function () {
    Route::post('/member/created', [APIFamilyMembersController::class, 'create'])->name('membersCreated');
    Route::get('/member/list', [APIFamilyMembersController::class, 'list'])->name('membersList');
    Route::post('/member/updated/{id}', [APIFamilyMembersController::class, 'update'])->name('membersUpdated');
    Route::post('/member/delete/{id}', [APIFamilyMembersController::class, 'delete'])->name('deleteMembers');
    Route::post('/Number/updated', [APIPersonalDetailsController::class, 'phoneNumberUpdated'])->name('phone.NumberUpdated');
    Route::post('/displayName/updated', [APIPersonalDetailsController::class, 'displayNameUpdated'])->name('displayNameUpdated');
    Route::post('/logout', [APIPatientAuthenticationController::class, 'logout']);
});


