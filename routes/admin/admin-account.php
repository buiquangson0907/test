<?php
use App\Http\Controllers\Admin\Account\AccountController;
use App\Http\Controllers\Admin\Account\DBAccountController;

Route::group(['prefix' => 'account','middleware' => ['auth:admin']], function() {
    Route::get('/',[AccountController::class,'index'])->middleware('permission:super-index');
    Route::get('create',[AccountController::class,'create'])->middleware('permission:super-add');
    Route::post('store',[AccountController::class,'store'])->middleware('permission:super-add');
    Route::get('edit/{id}',[AccountController::class,'edit'])->middleware('permission:super-edit');
    Route::post('update/{id}',[AccountController::class,'update'])->middleware('permission:super-edit');
    Route::post('status',[AccountController::class,'status'])->middleware('permission:super-publish');
    Route::post('destroy',[AccountController::class,'destroy'])->middleware('permission:super-delete');

    Route::get('password',[AccountController::class,'getPassword']);
    Route::post('password',[accountController::class,'postPassword']);

    Route::get('dbaccount',[DBAccountController::class,'datatableAccount']);
});



