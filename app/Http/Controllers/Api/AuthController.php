<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Laravel\Fortify\Actions\Logout;
use App\Http\Controllers\Controller;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = app(\Laravel\Fortify\Contracts\CreatesNewUsers::class)->create($request->all());

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Используем Fortify actions для аутентификации
        $attempt = app(AttemptToAuthenticate::class)->handle($request, function ($request) {
            $user = $request->user();
            
            // Генерация токена для API (если используете Sanctum)
            $token = $user->createToken('api-token')->plainTextToken;
            
            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        });

        return $attempt;
    }

    public function logout(Request $request)
    {
        // Удаление всех токенов пользователя
        $request->user()->tokens()->delete();
        
        // Использование Fortify logout
        app(Logout::class)($request);
        
        return response()->json(['message' => 'Logged out successfully']);
    }
}