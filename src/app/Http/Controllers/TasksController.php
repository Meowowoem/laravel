<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use Illuminate\Validation\Rule;

class TasksController extends Controller
{
    public function addTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'status' => [Rule::enum(TaskStatus::class)]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' =>  $validator->errors()

            ], 422);
        };

        $description = $request->input('description');

        $task = new Task;
        $task->name = $validator->getValue('name');
        $task->description = $validator->getValue('description');
        $task->status = $validator->getValue('status') ?? TaskStatus::active;
        $task->user_id = $request->user()->id;

        $task->save();

        return $task->toJson();
    }

    public function getTasks(Request $request): array
    {
        return $request->user()->getUserTasks()->paginate(20)->toArray();
    }

    public function getTask($id): array
    {
        return Task::all()->find($id)->toArray();
    }

    public function deleteTask($id)
    {
        return Task::all()->find($id)->delete();
    }

    public function closeTask($id)
    {
        $task = Task::all()->find($id);
        $task->status = 'done';
        $task->save();
    }
}
