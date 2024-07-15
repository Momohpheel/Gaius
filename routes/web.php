<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DoctorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::prefix('doctor')->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('login', [DoctorController::class , 'login']);
    Route::middleware(['auth'])->group(function () {
        Route::post('logout', [DoctorController::class , 'logout']);
        Route::get('dashboard', [DoctorController::class , 'dashboard']);
    });

   
    Route::get('report', function () {
        return view('doctor.report');
    });
    Route::get('appointment', function () {
        return view('doctor.appointments');
    });
    Route::get('medication', function () {
        return view('doctor.medications');
    });
    Route::get('students', function () {
        return view('doctor.students');
    });
    Route::get('all', function () {
        return view('doctor.doctors');
    });
    Route::get('report', function () {
        return view('doctor.report');
    });
});

Route::prefix('student')->group(function () {
    Route::get('login', function () {
        return view('auth.studentlogin');
    });
    Route::get('register', function () {
        return view('auth.studentregister');
    });
    Route::post('login', [StudentController::class , 'login']);
    
    Route::post('register', [StudentController::class , 'register']);
    Route::middleware(['auth'])->group(function () {
        Route::post('logout', [StudentController::class , 'logout']);
        Route::get('dashboard', [StudentController::class , 'dashboard']);
        Route::get('appointments', [StudentController::class , 'getAppointments']);
        Route::get('schedule-appointment', function () {
            return view('student.schedule');
        });
        Route::post('schedule', [StudentController::class , 'scheduleAppointment']);
        Route::get('profile', [StudentController::class , 'profile']);
        Route::post('profile', [StudentController::class , 'updateProfile']);
    });
   
});