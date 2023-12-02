<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(url('login'));
});
Route::get('login', [AuthController::class, 'login']);
Route::post('login/auth', [AuthController::class, 'login_auth']);
Route::get('logout', [AuthController::class, 'logout']);

Route::prefix('admin')->group(function () {
    Route::resource('dashboard', DashboardController::class)->middleware('authlogin');
    Route::resource('company', CompanyController::class)->middleware('authlogin');
    Route::resource('employees', EmployeesController::class)->middleware('authlogin');
});
