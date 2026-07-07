<?php

use App\Http\Controllers\Auth\AuthenticareController;
use App\Http\Controllers\Auth\ForgotpasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetpasswordController;
use App\Http\Controllers\Member\ConfirmExplainationController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\DepartmentController;
use App\Http\Controllers\Member\EmployeeController;
use App\Http\Controllers\Member\ExpalainationController;
use App\Http\Controllers\Member\GetUserController;
use App\Http\Controllers\Member\LeaveRequestController;
use App\Http\Controllers\Member\OtController;
use App\Http\Controllers\Member\PositionController;
use App\Http\Controllers\Member\ProfileController;
use App\Http\Controllers\Member\RoleController;
use App\Http\Controllers\Member\TimeEntryController;
use App\Http\Controllers\Member\TypeController;
use App\Http\Controllers\Member\UserController;
use App\Http\Controllers\Member\WorkingDayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register',[RegisterController::class,'store']);
Route::post('authenticare',[AuthenticareController::class,'store']);
Route::post('forgot-password',[ForgotpasswordController::class,'store']);
Route::post('reset-password',[ResetpasswordController::class,'store']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('count_user',[DashboardController::class,'countUser']);
    Route::get('get-account-info',[UserController::class,'getAccountInfo']);
    Route::get('get-user',[GetUserController::class,'GetUser']);
    Route::get('logout',[AuthenticareController::class,'logout']);
    Route::prefix('profile')->controller(ProfileController::class)->group(function(){
        Route::get('/','getProfile');
        Route::put('/update-profile/{id}', 'updateProfile');
        Route::post('/change-password', 'changePassword');
    });
    Route::prefix('department')->controller(DepartmentController::class)->group(function(){
        Route::get('/','getDepartment');
        Route::post('/create-department','createDepartment');
        Route::put('/update/{id}','updateDepartment');
        Route::put('/action-department/{id}','actionDepartment');
        Route::delete('/delete/{id}','deleteDepartment');
    });
    Route::prefix('role')->controller(RoleController::class)->group(function(){
        Route::get('/','getrole');
        Route::post('/create-role','createRole');
        Route::put('/update/{id}','updateRole');
        Route::delete('/delete/{id}','deleteRole');
    });
    Route::prefix('position')->controller(PositionController::class)->group(function(){
        Route::get('/','getPosition');
        Route::post('/create-pos','createPosition');
        Route::put('/update/{id}','updatePosition');
        Route::delete('/delete/{id}','deletePosition');
    });
    Route::prefix('employee')->controller(EmployeeController::class)->group(function(){
        Route::get('/','getEmployee');
        Route::post('/create-employee','createEmployee');
        Route::put('/update/{id}','updateEmployee');
        Route::put('/action-employee/{id}','actionEmployee');
        Route::delete('/delete/{id}','deleteEmployee');
    });
    Route::prefix('type')->controller(TypeController::class)->group(function(){
        Route::get('/','getType');
        Route::post('/create-type','createType');
        Route::put('/update/{id}','updateType');
        Route::delete('/delete/{id}','deleteType');
    });
    Route::prefix('working-day')->controller(WorkingDayController::class)->group(function(){
        Route::get('/','getWorkingDay');
        Route::post('/create-working','createWorkingDay');
        Route::put('/update/{id}','updateWorkingDay');
        Route::delete('/delete/{id}','deleteWorkingDay');
    });
    Route::prefix('attendance')->controller(TimeEntryController::class)->group(function(){
        Route::get('/get-working','getWorkingDay');
        Route::post('/create-checkin','CreateCheckin');
        Route::post('/create-checkout','CreateCheckout');
        Route::get('/get-attendance','getAttendance');
        Route::post('/create-expalaination','createExpalaination');
        Route::get('/get-expalaination','getExpalaination');
        Route::post('/create-ot','createOt');

    });
    Route::prefix('expalaination')->controller(ExpalainationController::class)->group(function(){
        Route::get('/get-expalaination','getExpalaination');
        Route::get('/search-expalaination','searchExpalaination');
        Route::put('/update/{id}','updateExpalaination');
        Route::delete('/delete/{id}','deleteExpalaination');
        Route::get('/get-DetailExpalaination','getDetailExpalaination');
        Route::get('/search-DetailExpalaination','searchDetailExpalaination');
        Route::get('/get-user','getUser');
        Route::post('/reject-expalaination', 'rejectExpalaination');
        Route::post('/approve-expalaination', 'approveExpalaination');
    });
    Route::prefix('leave')->controller(LeaveRequestController::class)->group(function(){
        Route::get('/get-loai','getLoai');
        Route::post('/create-leave','createLeave');
        Route::get('/get-leave','getLeave');
        Route::get('/get-user','getUser');
        Route::post('/reject-leave', 'rejectLeave');
        Route::post('/approve-leave', 'approveLeave');
        Route::get('/get-leave-user','getLeaveUser');
        Route::put('/update/{id}','editLeave');
    });
    Route::prefix('ot')->controller(OtController::class)->group(function(){
        Route::get('/get-loai','getLoai');
        Route::get('/get-ot','getOt');
        Route::get('/get-user','getUser');
        Route::post('/reject-ot', 'rejectOt');
        Route::post('/approve-ot', 'approveOt');
        Route::get('/get-ot-user','getotUser');
        Route::put('/update/{id}','editOt');
    });
});

