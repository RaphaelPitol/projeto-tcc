<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\LocadorLocatarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('edit.user')->middleware('auth');
Route::put('/update/{id}', [UserController::class, 'update'])->name('update.user')->middleware('auth');

Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('/layouts/app', [DashbordController::class, 'index'])->name('layouts.app')->middleware('auth');

Route::get('/locloca/index', [LocadorLocatarioController::class, 'index'])->name('locloca.index');
Route::get('/locloca', [LocadorLocatarioController::class, 'create'])->name('locloca.create');
Route::post('/locloca/store', [LocadorLocatarioController::class, 'store'])->name('locloca.store');


Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');


Route::post('/forgot-password', function (Request $request) {

    // dd($request);
    $request->validate(['email' => ['required','email']],
    [
        'email.required' => "Preencha o campo email!",
        'email.email' => "O email deve ser valido"
    ]
);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    // dd($status);
    if($status === "passwords.user"){
        $status = "Verifique o email! Email não encontrado!";
    }
    // if($status === "passwords.sent"){
    //     $status = "Tentativas excedidas!";
    // }

    // dd($status);

    return $status === Password::RESET_LINK_SENT
    ? back()->with(['status' => "Link Enviado, verifique sua caixa de entrada!" ])
    : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->password = Hash::make($password);
            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');