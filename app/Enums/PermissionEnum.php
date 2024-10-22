<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case MANAGE_STUDENTS = 'manage students';
    case MANAGE_INSTRUCTORS = 'manage instructors';
    case CREATE_CONTENT = 'create content';
}
