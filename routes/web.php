<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;

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

Route::get('/', [UserController::class, 'index'])->name('welcome');
Route::post('/daftar', [UserController::class, 'addParticipant'])->name('addParticipant');
Route::get('/login', [UserController::class, 'loginPage'])->name('login');
Route::post('/login-post', [UserController::class, 'loginAction'])->name('login.action');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::group(['middleware' => ['auth', 'CheckRole:1']], function(){
    Route::get('/dashboard-admin', [UserController::class, 'dashboard'])->name('dashboard.admin');
});