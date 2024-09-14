<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\ImovelController;
use App\Http\Controllers\LocadorLocatarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VistoriaController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

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
    return view('auth.login');
})->name('login');

Route::get('/createuser', [UserController::class, 'create'])->name('create.user');
Route::post('/storeuser', [UserController::class, 'store'])->name('store.user');

Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('/forgot-password', [ResetPasswordController::class, 'forgot'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'reset'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest')->name('password.update');



Route::group(['middleware' => ['auth', 'no.cache']], function () {
    Route::get('/layouts/app', [DashbordController::class, 'index'])->name('layouts.app');

    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('edit.user');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('update.user');

    Route::get('/locloca/index', [LocadorLocatarioController::class, 'index'])->name('locloca.index');
    Route::get('/locloca', [LocadorLocatarioController::class, 'create'])->name('locloca.create');
    Route::post('/locloca/store', [LocadorLocatarioController::class, 'store'])->name('locloca.store');

    Route::get('/imovel', [ImovelController::class, 'create'])->name('imovel.create');
    Route::post('/imovel', [ImovelController::class, 'store'])->name('imovel.store');
});

Route::get('/form', function () {
    return view('quarto.form2');
})->name('quarto');

Route::post('/quarto', [VistoriaController::class, 'store'])->name('vistoria.store');
