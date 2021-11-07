<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('bearer')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email|max:255',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response(['message' => 'Your credentials are incorrect.'], 401);
        }

        $token = $user->createToken('bearer' )->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response(['message' => 'Logged out successfully'], 200);
    }
}
