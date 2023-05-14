<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\projectController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
//Users route
Route::view('signup', 'signup');
Route::post('signup', [AuthController::class, 'index']);
Route::view('login', 'login');
Route::post('login',[AuthController::class, 'login']);
// Route::view('dashboard', 'dashboard');
Route::get('dash',[AuthController::class, 'dash']);
Route::get("detail/{id}",[AuthController::class, 'detail']);
Route::get("search",[AuthController::class,'search']);


//Admin route
Route::post('adminSignup', [AdminAuthController::class, 'adminSignup'])->name('adminSignup');
Route::post('adminLogin', [AdminAuthController::class, 'login'])->name('adminLogin');
// Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('adminDashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');
Route::view('adminSignup', 'adminSignup');
Route::view('adminLogin', 'adminLogin');
// Route::view('adminDashboard', 'adminDashboard');
