<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends Controller
{
    public function register(AuthRequest $request) {
        $user = User::create($request->validated());

        return (new UserResource($user))->additional([
            'message' => 'User created successfully',
        ])->response()
        ->setStatusCode(201);
    }
}
