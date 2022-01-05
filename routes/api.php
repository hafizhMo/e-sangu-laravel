<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetingController;
use App\Http\Controllers\TransactionController;

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

// category
Route::get('category', [CategoryController::class, 'index']);
Route::get('category/{id}', [CategoryController::class, 'show']);

// auth
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('user/{id}', [UserController::class, 'show']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    // category 
    Route::post('category', [CategoryController::class, 'store']);
    Route::put('category', [CategoryController::class, 'update']);
    Route::delete('category/{id}', [CategoryController::class, 'destroy']);
});

// budgeting 
Route::get('budgeting', [BudgetingController::class, 'index']);
Route::get('budgeting/{id}', [BudgetingController::class, 'show']);
Route::post('budgeting', [BudgetingController::class, 'store']);
Route::put('budgeting', [BudgetingController::class, 'update']);
Route::delete('budgeting/{id}', [BudgetingController::class, 'destroy']);
// specific user 
Route::get('budgeting/user/{id}', [BudgetingController::class, 'index_user_id']);
Route::get('budgeting/user/{id}/latest', [BudgetingController::class, 'show_user_id']);

// relation
Route::get('relation', [RelationController::class, 'index']);
Route::get('relation/wali/{id}', [RelationController::class, 'index_by_wali']);
Route::get('relation/beban/{id}', [RelationController::class, 'index_by_beban']);
Route::post('relation/wali/create', [RelationController::class, 'store_by_wali']);
Route::post('relation/beban/create', [RelationController::class, 'store_by_beban']);
Route::put('relation/update', [RelationController::class, 'update']);
Route::post('relation/delete', [RelationController::class, 'destroy']);

// transaction
Route::get('transaction', [TransactionController::class, 'index']);
Route::get('transaction/{id}', [TransactionController::class, 'index_by_user']); //get all data by user_id
Route::post('transaction', [TransactionController::class, 'store']);
Route::put('transaction', [TransactionController::class, 'update']);
Route::delete('transaction/{id}', [TransactionController::class, 'destroy']);