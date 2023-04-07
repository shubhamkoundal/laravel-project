<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersExport;
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
    return view('welcome');
});
Route::group(['middleware'=>'guest'],function(){
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register_view'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AuthController::class ,'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/register', [App\Http\Controllers\AuthController::class, 'register_view'])->name('admin.register');

});
Route::post('/users/{user}/make-admin', [AuthController::class, 'makeAdmin'])->name('make-admin');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [AuthController::class, 'home'])->name('home');
});
Route::get('/download', [AuthController::class,'download'])->name('download');
// Route::get('/download', [AuthController::class,'download'])->name('download');
Route::get('/admin/export-pdf', [AuthController::class, 'exportPdf'])->name('admin.export-pdf');
// Route::delete('/admin/users/{id}', 'AuthController@deleteUser')->name('admin.users.delete');
Route::delete('/users/{id}', [AuthController::class ,'deleteUser'])->name('delete-user');
// Route::put('/users/{user}', [AuthController::class,'update'])->name('update-user');
// Route::put('/users/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.users.update');
Route::put('/users/{id}', [UserController::class, 'update'])->name('update-user');









Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{otp}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
