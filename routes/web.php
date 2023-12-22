<?php

use Illuminate\Support\Facades\Route;

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return back();
});

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return back();
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['prefix' => 'filemanager-product', 'middleware' => ['auth:admin','permission:product-edit']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

