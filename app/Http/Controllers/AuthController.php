<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método para iniciar sesión y generar el token
    public function login(Request $request)
    {
        $credentials = $request->only('identifiers', 'password');

        // Intenta autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Si el usuario es autenticado, genera el token
            $user = Auth::user();
            $token = JWTAuth::fromUser($user);

            return response()->json(['token' => $token], 200);
        }

        // Si no se puede autenticar, devuelve error
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Método para obtener los datos del usuario autenticado
    public function me()
    {
        return response()->json(Auth::user());
    }

    // Método para cerrar sesión
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }
}
