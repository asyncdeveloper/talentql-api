<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(AuthRequest $request) {
        $user = User::create($request->validated());

        return (new UserResource($user))->additional([
            'message' => 'User created successfully',
        ])->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }

    public function login(AuthRequest $request) {
        $token = Auth::attempt($request->validated());

        if (! $token) {
            return response()->json([ 'errors' => 'Invalid login credentials' ], Response::HTTP_UNAUTHORIZED);
        }

        return (new UserResource(Auth::user()))->additional([
            'message' => 'Login successful',
            'access_token' => $token,
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
