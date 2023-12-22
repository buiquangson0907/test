<?php
use App\Http\Controllers\Admin\Permission\PermissionController;
use App\Http\Controllers\Admin\Permission\RolePermissionController;
use App\Http\Controllers\Admin\Permission\DBPermissionController;

Route::group(['middleware' => ['auth:admin','role:super']], function() {
    Route::group(['prefix' => 'permission'],function(){
        Route::get('/',[PermissionController::class,'index']);
        Route::post('storeRole',[PermissionController::class,'storeRole']);
        Route::post('updateRole/{role_id}',[PermissionController::class,'updateRole']);
        Route::post('destroy',[PermissionController::class,'destroy']);
        Route::get('ajax-role-account/{id}',[PermissionController::class,'ajaxRoleAccount']);
        Route::get('ajax-role/{role_id}',[PermissionController::class,'ajaxRole']);
        Route::get('db_role',[DBPermissionController::class,'dbRole']);


        Route::group(['prefix' => 'role'],function(){
            Route::get('/',[RolePermissionController::class,'getRole']);
            Route::post('/',[RolePermissionController::class,'postRole']);
        });

        Route::group(['prefix' => 'model'],function(){
            Route::get('/',[RolePermissionController::class,'getModel']);
            Route::post('/',[RolePermissionController::class,'postModel']);
        });

        Route::group(['prefix' => 'group'],function(){

            // Route::get('getGroupPermission',[RolePermissionController::class,'getGroupPermission']);
            Route::post('storeGroupPermission',[RolePermissionController::class,'storeGroupPermission']);
            Route::get('ajaxGroupPermission/{group_id}',[RolePermissionController::class,'ajaxGroupPermission']);
            Route::post('updateGroupPermission/{group_id}',[RolePermissionController::class,'updateGroupPermission']);
            Route::get('getGroupPermission/{id}',[RolePermissionController::class,'getGroupPermission']);
            Route::get('removeGroupPermission/{id}',[RolePermissionController::class,'removeGroupPermission']);
            Route::post('postGroupPermission/{id}',[RolePermissionController::class,'postGroupPermission']);
        });
    });
});
