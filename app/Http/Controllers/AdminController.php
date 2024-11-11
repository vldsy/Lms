<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    private Course $courseModel;
    private Task $taskModel;
    private User $userModel;

    public function __construct()
    {
        $this->courseModel = new Course();
        $this->taskModel = new Task();
        $this->userModel = new User();
    }

    public function showAllCourses(Request $request): Response
    {
        // TODO add authorisation check here
        return Inertia::render('Admin/AdminCourses', [
            'courses' => $this->courseModel->searchCourses(request()->search),
            'search' => $request->search ?? '',
        ]);
    }

    public function showAllUsers(Request $request): Response
    {
        // TODO add authorisation check here
        return Inertia::render('Admin/AdminUsers', [
            'users' => $this->userModel->searchUsers(request()->search),
            'search' => $request->search ?? '',
        ]);
    }

    public function showAllTasks(Request $request): Response
    {
        // TODO add authorisation check here
        return Inertia::render('Admin/AdminTasks', [
            'tasks' => $this->taskModel->searchTasks(request()->search),
            'search' => $request->search ?? '',
        ]);
    }
}
