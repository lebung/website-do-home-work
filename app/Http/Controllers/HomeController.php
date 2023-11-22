<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{

    public function index()
    {
        $classCount = Classroom::where('status', 1)->count();
        $courseCount = Course::where('status', 1)->count();
        $lessonCount = Lesson::count();
        $studentCount = User::role('student')->count();
        $user = auth()->user()->load(['courses' => fn($q) => $q->with('lessons')->where('status', 1), 'classrooms' => fn($q) => $q->with(['author', 'users' => fn($q) => $q->where('user_id', '!=', auth()->user()->id)])]);
        return view('screens.frontend.index', compact('user', 'classCount', 'courseCount', 'lessonCount', 'studentCount'));
    }
}
