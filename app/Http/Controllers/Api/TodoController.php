<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{

    public function store(TodoRequest $request)
    {
        $todo = Todo::create($request->validated());

        return (new TodoResource($todo))->additional([
            'message' => 'Todo created successfully',
        ])->response()
        ->setStatusCode(201);
    }

}
