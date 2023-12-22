<?php

use App\Http\Controllers\Admin\Setups\SetupHomeController;

Route::group(['prefix' => 'set_home','middleware' => ['auth:admin']], function() {
    Route::get('/',[SetupHomeController::class,'index']);
    Route::post('ajaxMove',[SetupHomeController::class,'ajaxMove']);
    Route::post('status',[SetupHomeController::class,'status']);
    Route::post('destroy',[SetupHomeController::class,'destroy']);
});




