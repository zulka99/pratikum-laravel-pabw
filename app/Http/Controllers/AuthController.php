<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        if (User::where('email', $data['email'])->exists()) {
            return response()->json(['message' => 'Email sudah terdaftar'], 409);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // password di-hash
        ]);

        return response()->json([
            'message' => 'Register berhasil',
            'user'    => $user->only(['id', 'name', 'email']),
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        // Cek email dan password
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'message' => 'Login berhasil',
            'token_type' => 'Bearer',
            'access_token' => $token,
            'user' => $user->only(['id', 'name', 'email']),
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user()->only(['id', 'name', 'email']));
    }
    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout berhasil']);
    }
}
