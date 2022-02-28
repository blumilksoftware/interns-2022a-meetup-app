<?php

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\RegisterUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware(["auth"]);
    }

    public function create(RegisterUserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('AccessToken')->plainTextToken;
//        dd($token);

        return new JsonResponse("Success",201);
    }
    public function login(Request $request): JsonResponse
    {
        $user = User::login([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = $user->createToken('AccessToken')->plainTextToken;

        return new JsonResponse("Success",201);
    }

    public function logout(Request $request)
    {
        auth()->user()->token()->delete();

        return ("Logged Out");
    }



}

