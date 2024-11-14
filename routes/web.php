<?php

use App\Http\Controllers\AmbienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\DescricaoPisoController;
use App\Http\Controllers\LocadorLocatarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParedeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VistoriaController;
use App\Models\Ambiente;
use App\Models\DescricaoPiso;
use App\Models\User;
use App\Models\Vistoria;
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

Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('/forgot-password', [ResetPasswordController::class, 'forgot'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'reset'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest')->name('password.update');


Route::group(['middleware' => ['auth', 'no.cache']], function () {
    Route::get('/layouts/app', [DashbordController::class, 'index'])->name('layouts.app');



    Route::get('/createuser', [UserController::class, 'create'])->name('create.user');
    Route::post('/storeuser', [UserController::class, 'store'])->name('store.user');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('edit.user');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('update.user');

    Route::get('vistoria/detalhes/{id}', [VistoriaController::class, 'show'])->name('show.vistoria');

    //Rotas Gerenciadas apenas pela imobiliaria
    Route::middleware(['can:imobiliaria'])->group(function () {
        Route::get('/home/imobiliaria', function () {
            return view('home.imobiliaria');
        })->name('imobiliaria.home');
        Route::get('/locloca/index', [LocadorLocatarioController::class, 'index'])->name('locloca.index');
        Route::get('/locloca', [LocadorLocatarioController::class, 'create'])->name('locloca.create');
        Route::post('/locloca/store', [LocadorLocatarioController::class, 'store'])->name('locloca.store');
        Route::get('/locloca/edit/{id}', [LocadorLocatarioController::class, 'edit'])->name('locloca.edit');
        Route::put('/locloca/edit/{id}', [LocadorLocatarioController::class, 'update'])->name('locloca.update');
        Route::delete('/locloca/delete/{id}', [LocadorLocatarioController::class, 'destroy'])->name('locloca.destroy');


        Route::get('/vistoriadores', [UserController::class, 'listvistoriador'])->name('vistoriadores.list');
        Route::delete('/vistoriador/{id}', [UserController::class, 'destroy'])->name('destroy.vistoriador');

        Route::get('/vistoria', [VistoriaController::class, 'create'])->name('vistoria.create');
        Route::get('/vistoria/edit/{id}', [VistoriaController::class, 'edit'])->name('vistoria.edit');
        Route::post('/vistoria', [VistoriaController::class, 'store'])->name('vistoria.store');
        Route::put('/vistoria/{id}', [VistoriaController::class, "update"])->name('vistoria.update');
        Route::delete('/vistoria/{id}', [VistoriaController::class, "destroy"])->name('vistoria.destroy');



        Route::get('/uservistoriador', function () {
            return view('user.userVistoriador');
        })->name('vistoriador');

        Route::put('/ativo/{id}', [UserController::class, 'ativoInativo'])->name('vistoriador.ativo');
    });

    //Rotas Gerenciadas apenas pelo Admin
    Route::middleware(['can:admin'])->group(function () {
        Route::get('/imobiliaria', function () {
            return view('user.userImobiliaria');
        })->name('imobiliaria');


        Route::get('/home/admin', function () {
            return view('home.admin');
        })->name('admin.home');


        Route::get('/piso', [PisoController::class, 'index'])->name('piso.index');
        Route::post('/piso', [PisoController::class, 'store'])->name('piso.store');
        Route::delete('/piso/{id}', [PisoController::class, 'destroy'])->name('piso.destroy');
        Route::get('/piso/edit/{id}', [PisoController::class, 'edit'])->name('piso.edit');
        Route::put('/pisos/{piso}', [PisoController::class, 'update'])->name('piso.update');

        Route::get('/descricaoPiso', [DescricaoPisoController::class, 'index'])->name('descricaoPiso.index');
        Route::post('/descricaoPiso', [DescricaoPisoController::class, 'store'])->name('descricaoPiso.store');
        Route::delete('/descricaoPiso/{id}', [DescricaoPisoController::class, 'destroy'])->name('descricaoPiso.destroy');
        Route::get('/descricaoPiso/edit/{id}', [DescricaoPisoController::class, 'edit'])->name('descricaoPiso.edit');
        Route::put('/descricaoPiso/{descricao}', [DescricaoPisoController::class, 'update'])->name('descricaoPiso.update');

        Route::get('/parede', [ParedeController::class, 'index'])->name('parede.index');
        Route::post('/parede', [ParedeController::class, 'store'])->name('parede.store');
        Route::delete('/parede/{id}', [ParedeController::class, 'destroy'])->name('parede.destroy');
        Route::get('/parede/edit/{id}', [ParedeController::class, 'edit'])->name('parede.edit');
        Route::put('/parede/{parede}', [ParedeController::class, 'update'])->name('parede.update');
    });

     //Rotas Gerenciadas apenas pelo Vistoriador
     Route::middleware(['can:vistoriador'])->group(function () {
        Route::get('/home/vistoriador', function () {
            return view('home.vistoriador');
        })->name('vistoriador.home');

    });

    Route::put('/vistoria/status/{id}', [VistoriaController::class, "status"])->name('vistoria.status');

    Route::get('/pdf/{id}', [PDFController::class, 'geraPDF'])->name('pdf.geraPDF');

    Route::get('/form/{id}', [VistoriaController::class, 'show'])->name('vistoria.show');

    Route::get('/ambiente/index/{id}', [AmbienteController::class, 'index'])->name('ambiente.index');
    Route::post('/ambiente', [AmbienteController::class, 'store'])->name('ambiente.store');

    Route::get('/ambiente/edit/{id}', [AmbienteController::class, 'edit'])->name('ambiente.edit');
    Route::put('/ambiente/{id}', [AmbienteController::class, "update"])->name('ambiente.update');
    Route::get('/ambiente/{id}', [AmbienteController::class, 'create'])->name('ambiente.create');
    Route::delete('/ambiente/{id}', [AmbienteController::class, "destroy"])->name('ambiente.destroy');
});
