<?php
use App\Http\Controllers\Admin\DashboardController;

Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('/',[DashboardController::class, 'index']);
});
