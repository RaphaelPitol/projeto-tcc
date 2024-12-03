<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
{
    if ($exception instanceof AuthorizationException) {

        return redirect()->back()->with('error', 'Você não está autorizado a acessar esta página.');
    }

    if ($exception instanceof ThrottleRequestsException) {
        return redirect()->route('login')->withErrors([
            'error' => 'Você tentou muitas vezes. Tente novamente em 10 minutos.',
        ]);
    }

    return parent::render($request, $exception);
}
}
