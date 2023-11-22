<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\QuizResultDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoQuizController extends Controller
{
    public function index($id = 1)
    {
        $quiz = Quiz::find($id);
        $data = [
            'quiz' => $quiz
        ];
        return view('screens.frontend.coursedetail.course-detail', $data);
    }

    public function doquiz(Request $request)
    {
        try {

            $user_id = auth()->id();
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $endTime =  substr_replace(date("Y-m-d h:i:sa"), '', -2);
            $startTime =  substr_replace(date("Y-m-d h:i:sa", strtotime("-10 minutes", strtotime($endTime))), '', -2);
            $score = 0;
            $index_essay = 0;

            if (!$request->answer_id) {
                QuizResult::create([
                    'score' => 0,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'user_id' => $user_id,
                    'quiz_id' => $request->quiz_id
                ]);
                return response()->json($request->quiz_id, 200);
            }

            $answers =  $request->input('answer_id');
            foreach ($answers as $qid => $answer) {
                $question_answers = Answer::where('question_id', $qid)->get();
                $question = Question::where('id', $qid)->first();
                if (is_array($answer)) {
                    if ($question->type == 2) {
                        foreach ($answer as $answer_id) {
                            $answer_true = Answer::select('is_correct')->where('id', $answer_id)->first();
                            if ($answer_true->is_correct == 1) {
                                $answers_check[$qid][] = $answer_true->is_correct;
                            } else {
                                $answers_check[$qid] = 0;
                                break;
                            }
                        }
                        foreach ($question_answers as $question_answer) {
                            if ($question_answer->is_correct == 1) {
                                $answers_db_true[$qid][] = $question_answer->is_correct;
                            }
                        }
                    } elseif ($question->type == 3) {
                        foreach ($question_answers as $question_answer) {
                            $answer_update = Answer::find($question_answer->id);
                            $answer_update->content = $request->content_answer_essay[$index_essay];
                            $index_essay++;
                        }
                    } else {
                        foreach ($answer as $answer_id) {
                            $answer_true = Answer::select('is_correct')->where('id', $answer_id)->first();
                            if ($answer_true->is_correct == 1) {
                                $score++;
                            }
                        }
                    }
                }
            }
            foreach ($answers_db_true as $key => $answer_db_true) {
                if ($answer_db_true == $answers_check[$key]) { //check 2 array bang nhau thi score++
                    $score++;
                }
            }
            $score = $score / count($request->question_id) * 10;
            QuizResult::create([
                'score' => $score,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'user_id' => $user_id,
                'quiz_id' => $request->quiz_id
            ]);
            $QuizResultId = QuizResult::select('id')->max('id');
            foreach ($answers as $question_id => $answer) {
                foreach ($answer as $ans_id) {
                    QuizResultDetail::create([
                        'question_id' => $question_id,
                        'answer_id' => $ans_id,
                        'quiz_result_id' =>  $QuizResultId
                    ]);
                }
            }
            return response()->json($request->quiz_id, 200);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            if ($request->ajax()) {
                session()->flash('success', 'Có lỗi xảy ra, vui lòng thử lại');
                return response()->json(['success' => false], 406);
            }
            return redirect()
                ->back()
                ->with('success', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }
}
