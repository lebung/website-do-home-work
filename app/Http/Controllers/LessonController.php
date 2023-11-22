<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LessonHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LessonController extends Controller
{

    public function mark(Lesson $lesson, Request $request)
    {
        try{
            $mark = new LessonHistory();
            $mark->user_id = auth()->user()->id;
            $mark->lesson_id = $lesson->id;
            $mark->course_id = $request->course_id;
            $mark->save();
            return response()->json(['success' => true]);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['success' => false], 422);
        }
    }

}
