<?php
use App\Http\Controllers\Admin\Products\ProductController;
use App\Http\Controllers\Admin\Products\GroupProductController;
use App\Http\Controllers\Admin\Products\GroupTagController;
use App\Http\Controllers\Admin\Products\GroupProductTagController;
use App\Http\Controllers\Admin\Products\ServiceProduct;
Route::group(['prefix' => 'product','middleware' => ['auth:admin']], function() {
    Route::get('/',[ProductController::class,'index']);
    Route::get('create',[ProductController::class,'create']);
    Route::post('store',[ProductController::class,'store']);
    Route::get('edit/{id}',[ProductController::class,'edit']);
    Route::post('update/{id}',[ProductController::class,'update']);
    Route::post('status',[ProductController::class,'status']);
    Route::post('destroy',[ProductController::class,'destroy']);

    Route::post('ajaxValidate',[ServiceProduct::class,'ajaxValidate']);
    Route::post('ajaxGetTag',[ServiceProduct::class,'ajaxGetTag']);

    Route::post('removeSingleFile',[ServiceProduct::class,'ajaxRemoveSingleFile']);
    Route::post('removeSubFile',[ServiceProduct::class,'ajaxRemoveGalleryFile']);
    Route::get('dataTableProduct',[ServiceProduct::class,'dataTableProduct']);
});


Route::group(['prefix' => 'group-product','middleware' => ['auth:admin']], function() {
    Route::get('/',[GroupProductController::class,'index']);
    Route::post('saveData',[GroupProductController::class,'saveData']);
    Route::post('status',[GroupProductController::class,'status']);
    Route::post('destroy',[GroupProductController::class,'destroy']);
    Route::post('ajaxList',[GroupProductController::class,'ajaxList']);
    Route::post('ajaxMove',[GroupProductController::class,'ajaxMove']);

    Route::group(['prefix' => 'tag','middleware' => ['auth:admin']], function() {
        Route::get('{id}',[GroupProductTagController::class,'index']);
        Route::post('saveData',[GroupProductTagController::class,'saveData']);
    });
});

Route::group(['prefix' => 'group-tag','middleware' => ['auth:admin']], function() {
    Route::get('/',[GroupTagController::class,'index']);
    Route::post('saveData',[GroupTagController::class,'saveData']);
    Route::post('status',[GroupTagController::class,'status']);
    Route::post('destroy',[GroupTagController::class,'destroy']);
    Route::post('ajaxList',[GroupTagController::class,'ajaxList']);
    Route::post('ajaxMove',[GroupTagController::class,'ajaxMove']);
});


