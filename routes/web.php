<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin-login', [AdminController::class, 'showLogin'])->name('admin/login')->middleware('LoginTrue');
Route::post('admin-login-process', [AdminController::class, 'Login'])->name('admin/login/process');
Route::get('admin-logout', function(){
    Session::flush();
    return redirect('admin-login');
  })->name('admin/logout');
Route::get('/admin/dashboard', [AdminController::class, 'showHome'])->name('admin/home')->middleware('AdminCheck');
Route::get('/admin/dashboard/register-admin', [AdminController::class, 'showRegister'])->name('admin/register')->middleware('AdminCheck');
Route::post('/admin/dashboard/register-admin-process', [AdminController::class, 'Register'])->name('admin/register/process')->middleware('AdminCheck');