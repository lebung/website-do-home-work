<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\User;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index($quiz_id, $check_essay = false)
    {

        $user_id = auth()->id();
        $quizResult = QuizResult::where([
            ['user_id', '=', $user_id],
            ['quiz_id', '=', $quiz_id],
        ])->orderBy('id', 'DESC')->first();
        $user = User::select('name', 'avatar')->where('id', $quizResult->user_id)->first();
        $quiz = Quiz::select('title')->where('id', $quizResult->quiz_id)->first();
        $data = [
            'quizResult' => $quizResult,
            'quiz' => $quiz,
            'check_essay' => $check_essay
        ];
        return view('screens.frontend.result.result', $data);
    }
}
