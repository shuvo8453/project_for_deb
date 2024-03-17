<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Pending = 'pending';
    case Working = 'working';
    case Done = 'done';
}
