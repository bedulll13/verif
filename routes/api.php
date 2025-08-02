<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard/item/{partno}',[ItemController::class,'show_part']);
Route::get('/dashboard/item/adm/{partno}/{sequence}',[ItemController::class,'adm_show_part']);
Route::get('{cust}/dashboard/item/{partid}/{itemid}/{fullpartid}/{fullitemid}', [ItemController::class, 'check']);
Route::get('/dashboard/item/{partid}/{itemid}/{fullpartid}', [ItemController::class, 'check_yimm']);
Route::post('/dashboard/item/fail', [LogController::class, 'store']);