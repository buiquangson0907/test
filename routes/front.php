<?php


use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\GenerateController;
use App\Http\Controllers\Front\ServiceController;

Route::get('/',[HomeController::class,'home']);
Route::get('buildpc',[HomeController::class,'buildPC']);
Route::get('ajaxTooltip/{id}',[ServiceController::class,'ajaxTooltip']);

Route::get('dang-ky', [GenerateController::class,'getSignup']);




Route::get('{slug}', [HomeController::class, 'showBySlug']);


