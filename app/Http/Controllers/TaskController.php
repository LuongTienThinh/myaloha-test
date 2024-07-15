<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ApiResponseTrait;

    public function getAllTasks()
    {
        try {
            $taskList = Task::query()->get();

            return $this->successResponse($taskList, 200, 'Get the task list successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('500', $e->getMessage());
        }
    }

    public function createTask(Request $request)
    {
        try {
            $requestValidated = $request->validate([
                'project_id' => 'required|integer',
                'user_id' => 'nullable|integer',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'tags' => 'nullable|string',
                'date_start' => 'nullable|date_format:"Y-m-d\TH:i"',
                'date_end' => 'nullable|date_format:"Y-m-d\TH:i"',
            ]);
            
            if (!empty($requestValidated['date_start'])) {
                $requestValidated['date_start'] = Carbon::createFromFormat('Y-m-d\TH:i', $requestValidated['date_start'])->format('Y-m-d H:i:s');
            }
            
            if (!empty($requestValidated['date_end'])) {
                $requestValidated['date_end'] = Carbon::createFromFormat('Y-m-d\TH:i', $requestValidated['date_end'])->format('Y-m-d H:i:s');
            }

            $task = Task::query()->create($requestValidated);

            return $this->successResponse($task, 200, 'Create task successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('500', $e->getMessage());
        }
    }

    public function updateTask(Request $request, int $id)
    {
        try {
            $task = Task::query()->findOrFail($id);

            if ($task instanceof Task) {
                $requestValidated = $request->validate([
                    'project_id' => 'required|integer',
                    'user_id' => 'nullable|integer',
                    'title' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'tags' => 'nullable|string',
                    'date_start' => 'nullable|date_format:"Y-m-d\TH:i"',
                    'date_end' => 'nullable|date_format:"Y-m-d\TH:i"',
                ]);

                if (!empty($requestValidated['date_start'])) {
                    $requestValidated['date_start'] = Carbon::createFromFormat('Y-m-d\TH:i', $requestValidated['date_start'])->format('Y-m-d H:i:s');
                }
        
                if (!empty($requestValidated['date_end'])) {
                    $requestValidated['date_end'] = Carbon::createFromFormat('Y-m-d\TH:i', $requestValidated['date_end'])->format('Y-m-d H:i:s');
                }

                $task->update($requestValidated);
            }

            return $this->successResponse($task, 200, 'Update task successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('500', $e->getMessage());
        }
    }

    public function deleteTask(int $id)
    {
        try {
            $task = Task::query()->findOrFail($id)->delete();

            return $this->successResponse($task, 200, 'Delete task successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('500', $e->getMessage());
        }
    }

    public function clearAllTasksInProject(int $projectId)
    {
        try {
            $task = Task::query()->where('project_id', '=', $projectId)->delete();

            return $this->successResponse($task, 200, 'Delete tasks successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('500', $e->getMessage());
        }
    }
}
