<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $userProjects = QueryBuilder::for($request->user()->projects())
            ->with('creator')
            ->allowedSorts('name')
            ->allowedFilters(['name', 'description'])
            ->paginate()
            ->appends(request()->query());

        return (ProjectResource::collection($userProjects))->additional([
            'message' => 'Projects fetched successfully',
        ]);
    }

    public function store(ProjectRequest $request)
    {
        $project  = Project::create($request->validated());

        return (new ProjectResource($project->load('creator')))->additional([
            'message' => 'Project created successfully',
        ])->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Project $project, ProjectRequest $request)
    {
        return (new ProjectResource($project->load('creator')))->additional([
            'message' => 'Project fetched successfully',
        ]);
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return (new ProjectResource($project->load('creator')))->additional([
            'message' => 'Project updated successfully',
        ]);
    }

    public function destroy(Project $project, ProjectRequest $request)
    {
        $project->delete();

        return response()->noContent();
    }
}
