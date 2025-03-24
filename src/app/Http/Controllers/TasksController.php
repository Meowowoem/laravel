<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;

class TasksController extends Controller
{
    public function addTask(Request $request): string
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
        dd($task);

        return 'Created';
    }
}
