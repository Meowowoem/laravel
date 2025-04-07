<?php

namespace App\Http\Controllers;

enum TaskStatus: string
{
    case pending = 'pending';
    case active = 'active';
    case done = 'done';
}
