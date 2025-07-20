<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Method untuk mendaftarkan pengguna baru.
     */
    public function register(RegisterRequest $request)
    {
        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Beri response sukses
        return response()->json([
            'message' => 'Pendaftaran berhasil!',
            'user' => $user
        ], 201);
    }

    /**
     * Method untuk login pengguna dan mendapatkan token JWT.
     */
    public function login(LoginRequest $request)
    {
        // Dapatkan data yang sudah tervalidasi
        $credentials = $request->validated();

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Kredensial tidak valid'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Tidak dapat membuat token'], 500);
        }

        $user = auth()->user();
        ActivityLog::create([
            'user_id'   => $user->id,
            'aksi'      => 'user_login',
            'keterangan' => "Pengguna '{$user->name}' telah login."
        ]);

        return $this->respondWithToken($token);
    }

    /**
     * Method untuk mendapatkan data pengguna yang sedang login.
     */
    public function me()
    {
        // Kembalikan data user yang terautentikasi
        return response()->json(auth()->user());
    }

    /**
     * Method untuk logout (membatalkan token).
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Berhasil logout']);
    }

    /**
     * Helper method untuk menyusun format response token.
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // Gunakan JWTAuth untuk mendapatkan TTL (waktu kadaluarsa dalam menit, lalu kali 60 jadi detik)
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}
