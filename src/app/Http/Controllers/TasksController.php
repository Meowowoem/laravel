<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;

class TasksController extends Controller
{
    public function addTask(Request $request): Task
    {
        $validated = Validator::make($request->all(), [
            'name' => 'string|max:20'
        ]);

        if ($validated->fails()) {
            return 'Name length > 20';
        };

        $description = $request->input('description');

        $task = new Task;
        $task->name = $validated->getValue('name');
        $task->description = $validated->getValue('description');
        $task->status = 'active';

        $task->save();

        return $task;
    }

    public function getTasks(): array
    {
        return Task::paginate(20)->toArray();
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
