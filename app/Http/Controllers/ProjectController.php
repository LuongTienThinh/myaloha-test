<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use DB;

class ProjectController extends Controller
{
    use ApiResponseTrait;

    public function getAllProjects()
    {
        try {
            $projectList = Project::query()->with('tasks')->get();

            return $this->successResponse($projectList, 200, 'Get the project list successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('500', $e->getMessage());
        }
    }

    public function createProject(Request $request)
    {
        try {
            $requestValidated = $request->validate([
                'title' => 'required|string|max:255',
            ]);
            
            $project = Project::query()->create($requestValidated);

            return $this->successResponse($project, 200, 'Create project successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('500', $e->getMessage());
        }
    }

    public function updateProject(Request $request, int $id)
    {
        try {
            $project = Project::query()->findOrFail($id);

            if ($project instanceof Project) {
                $requestValidated = $request->validate([
                    'title' => 'required|string|max:255',
                ]);

                $project->update($requestValidated);
            }

            return $this->successResponse($project, 200, 'Update project successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('500', $e->getMessage());
        }
    }

    public function deleteProject(int $id)
    {
        try {
            $project = Project::query()->findOrFail($id);

            DB::transaction(function () use ($project) {
                $project->tasks()->delete();
                $project->delete();
            });

            return $this->successResponse($project, 200, 'Project and related tasks deleted successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('500', $e->getMessage());
        }
    }
}
