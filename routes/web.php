<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// to only doctors
Route::group(['middleware' => ['auth', 'is_doctor']], function(){
    Route::get('/home', [App\Http\Controllers\Doctor\HomeController::class, 'index'])->name('home');
    Route::get('/appointments', [App\Http\Controllers\Doctor\HomeController::class, 'showBookedAppts'])->name('appointments');
    Route::delete('/deleteappt/{id}', [App\Http\Controllers\Doctor\HomeController::class, 'destroyAppt'])->name('deleteappt');

    Route::post('/apptdates', [App\Http\Controllers\Doctor\DoctordateController::class, 'storeDates']);
    Route::get('/apptdates/{id}', [App\Http\Controllers\Doctor\DoctordateController::class, 'getDatesFor']);
    Route::delete('/removeDate/{id}', [App\Http\Controllers\Doctor\DoctordateController::class, 'destroy']);
});

// to only patients
Route::group(['middleware' => ['auth', 'is_patient']], function(){
    Route::get('/homepage', [App\Http\Controllers\Patient\HomepageController::class, 'index'])->name('homepage');
    Route::get('/appointment', [App\Http\Controllers\Patient\AppointmentController::class, 'index'])->name('appointment');
    
    Route::get('/dates', [App\Http\Controllers\Patient\AppointmentController::class, 'getDates']);
    Route::post('/bookappt/{id}', [App\Http\Controllers\Patient\AppointmentController::class, 'bookAppt']);

    //Route::post('/bookedappt', [App\Http\Controllers\Patient\AppointmentController::class, 'bookedApptmt'])->name('bookedappt');
}); 
    


