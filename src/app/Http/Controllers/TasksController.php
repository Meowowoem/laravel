<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    public function addTask(Request $request): string
    {
        $validatedName = Validator::make($request->all(), [
            'name' => 'string|max:20'
        ]);

        if ($validatedName->fails()) {
            return 'Name length > 20';
        };

        $description = $request->input('description');

        DB::table('tasks')->insert([
            'name' => $validatedName->getValue('name'),
            'description' => $description
        ]);

        return 'Created';
    }
}
