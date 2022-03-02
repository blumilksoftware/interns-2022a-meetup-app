<?php

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\LoginUserRequest;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();
        if (!$user || !Hash::check($validated['password'],$user['password'])){
            return response( 'Bad credential',404);
        }


        $token = $user->createToken('AccessToken')->plainTextToken;
        $response = [
            'user' => $user['email'],
            'auth_token' => $token
        ];

        return response($response,201);
    }

    public function logout(Request $request)
    {
        $user = $request;
        $request->user()->currentAccessToken()->delete();

        return response("Logged Out");
    }
}

