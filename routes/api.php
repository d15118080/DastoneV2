<?php

use App\Http\Controllers\TelegramController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::prefix('/v1')->group(function () {
    Route::post('/telegram/hooks',[TelegramController::class,'Telegram']);
    Route::post('/payment_noti_v1', [TransactionController::class, 'Payment_noti']);


    //사용자 Prefix
    Route::prefix('/user')->group(function () {
        Route::post('/auth_check', [UserController::class, 'Auth_Check']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/token_check', function () {return true;}); //토큰 유효여부 체크
            Route::post('/charge_send', [TransactionController::class, 'Charge_Request']); //충전신청
            Route::post('/remittance_send', [TransactionController::class, 'Remittance_Request']); //출금 신청
            Route::post('/bank_check', [TransactionController::class, 'Bank_Check']); //계좌 소유자 확인
            Route::post('/franchisees_add', [UserController::class, 'franchisees_add_req']); //가맹점 추가
            Route::post('/branchs_add', [UserController::class, 'branchs_add_req']); //가맹점 추가

        });

    });
});
