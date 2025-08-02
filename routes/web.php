<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/{cust}/login', [HomeController::class, 'login_get']);
Route::post('/{cust}/login', [HomeController::class, 'login_post']);
Route::middleware(UserMiddleware::class)->group(function() {
    Route::post('/{cust}/logout', [HomeController::class, 'logout_post']);
    Route::get('/{cust}/dashboards', [HomeController::class, 'dashboards']);
    Route::post('/{cust}/dashboards/upload-file', [HomeController::class, 'upload']);
    Route::get('/{cust}/dashboards/scan', [ScanController::class, 'index']);
    Route::get('/{cust}/dashboards/dn/{dn}', [HomeController::class, 'show_dn']);


    Route::get('/{cust}/dashboards/item', [ItemController::class, 'index']);
    Route::get('/{cust}/dashboards/item/new', [ItemController::class, 'create']);
    Route::post('/{cust}/dashboards/item/new', [ItemController::class, 'store']);
    Route::get('/{cust}/dashboards/item/{partno}', [ItemController::class, 'edit']);
    Route::post('/{cust}/dashboards/item/{partno}', [ItemController::class, 'update']);
    Route::post('/{cust}/dashboards/item/{partno}/delete', [ItemController::class, 'destroy']);
    Route::get('/{cust}/dashboards/log', [LogController::class, 'index']);
    // Route::get('/{cust}/dashboards/report', [ReportController::class, 'index']);
    
    Route::get('/{cust}/dashboards/users', [UserController::class, 'index']);
    Route::get('/{cust}/dashboards/users/new', [UserController::class, 'create']);
    Route::post('/{cust}/dashboards/users/new', [UserController::class, 'store']);
    Route::get('/{cust}/dashboards/users/{id}', [UserController::class, 'edit']);
    Route::post('/{cust}/dashboards/users/{id}', [UserController::class, 'update']);
    Route::post('/{cust}/dashboards/users/{id}/delete', [UserController::class, 'destroy']);
    
    

});

