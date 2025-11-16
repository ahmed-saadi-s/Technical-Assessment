<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\User\UserResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || ! Hash::check($request->password, $user->password)) {
            return $this->fail('Invalid credentials.', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'user' =>
            new UserResource($user),
            'token' => $token
        ], 'Logged in successfully');
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->success(null, "Loggut out successfully");
    }
}
