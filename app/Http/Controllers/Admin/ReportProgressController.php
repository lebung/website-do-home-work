<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\LessonHistory;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;
class ReportProgressController extends Controller
{

   public function report_course(Course $course){
    $lesson=Lesson::where('course_id',$course->id)
    ->count();
    $lesson_history=LessonHistory::select(
        DB::raw('user_id, count(*) as count')
    )
    ->where('course_id',$course->id)
    ->groupBy('user_id')
    ->get();
    $user=User::all();
    // dd($course->users);
    return view('screens.backend.report.report_course',[
        'user'=>$user,
        'course'=>$course,
        'lesson'=>$lesson,
        'lesson_history'=>$lesson_history,


    ]);
   }
}
