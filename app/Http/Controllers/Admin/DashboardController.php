<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\User;
class DashboardController extends Controller
{
    
    public function index()
    {
        $classCount = Classroom::where('status', 1)->count();
        $courseCount = Course::where('status', 1)->count();
        $lessonCount = Lesson::count();
        $studentCount = User::role('student')->count();
        $teacherCount = User::role('teacher')->count();
        $categoryCount = CourseCategory::count();
        $quizCount = Quiz::count();
        return view('screens.backend.dashboard', compact('classCount', 'courseCount', 'lessonCount', 'studentCount', 'categoryCount', 'quizCount', 'teacherCount'));
    }

}
