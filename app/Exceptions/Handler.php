<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->renderable(function (Throwable $e, $request) {
            // Hanya jalankan ini jika request ditujukan ke API
            if ($request->is('api/*')) {

                // TAMBAHKAN BLOK INI UNTUK MENANGANI ERROR UTAMA
                if ($e instanceof AuthenticationException) {
                    return response()->json(['message' => 'Anda harus login untuk akses halaman ini.'], 401);
                }

                if ($e instanceof TokenInvalidException) {
                    return response()->json(['status' => 'Token tidak valid'], 401);
                }

                if ($e instanceof TokenExpiredException) {
                    return response()->json(['status' => 'Token sudah kedaluwarsa'], 401);
                }

                if ($e instanceof JWTException) {
                    return response()->json(['status' => 'Token tidak ada atau tidak bisa di-parse'], 401);
                }
            }
        });
    }
}
