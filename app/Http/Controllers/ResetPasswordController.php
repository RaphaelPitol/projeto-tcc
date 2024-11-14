<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function forgot()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
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
        $status = "Verifique o email e digite novamente!";
    }
    // if($status === "passwords.sent"){
    //     $status = "Tentativas excedidas!";
    // }

    // dd($status);

    return $status === Password::RESET_LINK_SENT
    ? back()->with(['status' => "Link Enviado, verifique sua caixa de entrada!" ])
    : back()->withErrors(['email' => __($status)]);
    }

    public function reset($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
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
    }
}
