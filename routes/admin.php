<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\Auth\AuthAdminController;
Route::get('login',[AuthAdminController::class, 'getLogin'])->name('adminLogin');
Route::post('login',[AuthAdminController::class, 'postLogin']);
Route::get('logout',[AuthAdminController::class, 'getLogout']);

foreach (File::allFiles(__DIR__ . DIRECTORY_SEPARATOR . "admin") as $partial)
{
	require_once $partial->getPathname();
}
