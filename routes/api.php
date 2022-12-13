<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\PasswordController;

use App\Http\Controllers\Api\Profile\NameController;
use App\Http\Controllers\Api\Profile\EmailController;
use App\Http\Controllers\Api\Profile\PhoneController;
use App\Http\Controllers\Api\Profile\LogoutController;
use App\Http\Controllers\Api\Profile\PasswordController as ChangePassword;
use App\Http\Controllers\Api\Profile\InfoController;

use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\UserController;

/*
 *  Start Auth
 */
Route::post('login', [LoginController::class, 'login']);
Route::post('register/sendCode', [RegisterController::class, 'sendCode']);
Route::post('register/checkCode', [RegisterController::class, 'checkVerificationCode']);
Route::post('register', [RegisterController::class, 'register']);
Route::post('resetPassword/sendCode', [PasswordController::class, 'sendCode']);
Route::post('resetPassword/checkCode', [PasswordController::class, 'checkVerificationCode']);
Route::post('resetPassword', [PasswordController::class, 'resetPassword']);
/*
 *  end Auth
 */


/*
 *  Start Profile
 */
Route::middleware('auth:api',)->group(function (){
    Route::post('me', [InfoController::class, 'me']);
    Route::post('changeName', [NameController::class, 'change']);
    Route::post('changeEmail', [EmailController::class, 'change']);
    Route::post('changePhone', [PhoneController::class, 'change']);
    Route::post('changePassword', [ChangePassword::class, 'change']);
    Route::post('logout', [LogoutController::class, 'logout']);
    Route::post('refresh', [LogoutController::class, 'refresh']);
});
/*
 *  end Profile
 */


/*
 *  Start invoice
 */

Route::prefix('invoice')->middleware('is_admin')->group(function (){

    Route::post('create', [InvoiceController::class, 'create']);

});

/*
 *  Start user
 */

Route::prefix('user')->middleware('is_admin')->group(function (){

    Route::post('create', [UserController::class, 'create']);

});

/*
 *  end user
 */
