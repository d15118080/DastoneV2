<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\User;
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


Route::get('/', [UserController::class, 'Index'])->middleware('Token_Check');

Route::get('/login', function () {
    return view('login');
});

Route::get('/history', [UserController::class,'transaction_history'])->middleware('Token_Check');
Route::get('/remittance',[UserController::class,'remittance']);
Route::get('/charge', [UserController::class,'charge']);

Route::get('/management', [TransactionController::class,'management_list']); //출금 신청 충전 신청 리스트

Route::get('/branchs', [UserController::class,'branchs'])->middleware('Token_Check');
Route::get('/franchisees', [UserController::class,'franchisees']);

Route::get('/franchisees_add', function () {
    return view('franchisees_or_branch_add', ['mode' => 0]);
});

Route::get('/branch_add', function () {
    return view('franchisees_or_branch_add', ['mode' => 1]);
});

Route::get('/state_change',[TransactionController::class,'state_change'])->middleware('Token_Check');


Route::get('/logout', function () {
    setcookie("X-Token");
    setcookie("H-Token");
    return redirect('/');
});


Route::get('/bank_edit',[UserController::class,'Bank_edit'])->middleware('Token_Check');
