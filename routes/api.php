<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RequisitionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'links'], function () {
    Route::get('/', [LinkController::class, 'index']);
    Route::post('/', [LinkController::class, 'store']);
    Route::get('/{id}', [LinkController::class, 'show']);
    Route::put('/{id}', [LinkController::class, 'update']);
    Route::delete('/{id}', [LinkController::class, 'destroy']);
});

Route::group(['prefix' => 'requisitions'], function () {
    Route::get('/', [RequisitionController::class, 'index']);
    Route::post('/', [RequisitionController::class, 'store']);
    Route::get('/{id}', [RequisitionController::class, 'show']);
    Route::put('/{id}', [RequisitionController::class, 'update']);
    Route::delete('/{id}', [RequisitionController::class, 'destroy']);
});
