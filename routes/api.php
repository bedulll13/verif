<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard/item/{partno}',[ItemController::class,'show_part']);
Route::get('/dashboard/item/{partid}/{itemid}', [ItemController::class, 'check']);
Route::post('/dashboard/item/fail', [LogController::class, 'store']);