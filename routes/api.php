<?php

use App\Http\Controllers\Admin\PersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\homeController;
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
Route::post('/get/schedules',[homeController::class,'scheduleOfDoctor'])->name('get.schedules');
