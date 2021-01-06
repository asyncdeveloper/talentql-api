<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller
{

    public function index(Request $request) {
        $userTodos = $request->user()->todos()->paginate();

        return (TodoResource::collection($userTodos))->additional([
            'message' => 'Todos fetched successfully',
        ]);
    }

    public function store(TodoRequest $request)
    {
        $todo = Todo::create($request->validated());

        return (new TodoResource($todo))->additional([
            'message' => 'Todo created successfully',
        ])->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Todo $todo, TodoRequest $request) {
        return (new TodoResource($todo))->additional([
            'message' => 'Todo fetched successfully',
        ]);
    }

    public function update(Todo $todo, TodoRequest $request) {
        $todo->update($request->validated());

        return (new TodoResource($todo))->additional([
            'message' => 'Todo updated successfully',
        ]);
    }

    public function destroy(Todo $todo, TodoRequest $request) {
        $todo->delete();

        return response()->noContent();
    }

}
