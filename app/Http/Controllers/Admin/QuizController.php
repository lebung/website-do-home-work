<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizRequest;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizs = Quiz::select('id', 'title', 'duration', 'limit')->paginate(5);

        return view('screens.backend.quizs.list', ['quizs' => $quizs]);
    }

    public function create()
    {
        $questions = Question::select('id', 'title', 'tag')->get();
        return view('screens.backend.quizs.add', ['questions' => $questions]);
    }

    public function store(QuizRequest $request)
    {

        $quiz = new Quiz();
        $quiz->fill($request->except("_token"));
        $quiz->save();

        $quiz->questions()->attach($request->checkbox);
        return response()->json(['success' => true, 'msg' => 'Quiz updated success'], 200);
    }

    public function edit(Quiz $quiz)
    {
        $arrayQues = [];
        foreach ($quiz->questions as $question) {
            $arrayQues[] = $question->id;
        }
        $array = implode(',', $arrayQues);
        $data = ['quiz' => $quiz, 'arrayQues' => $array];

        return response()->json(view('screens.backend.quizs.update', $data)->render(), 200);
    }

    public function update(QuizRequest $request, Quiz $quiz)
    {
        $quiz->fill($request->except('_token'));
        $quiz->save();

        $array = array_map(
            function ($value) {
                return (int)$value;
            }, explode(",", $request->questions));
        $arrayQues = [];
        foreach ($quiz->questions as $question) {
            $arrayQues[] = $question->id;
        }
        $quiz->questions()->detach($arrayQues);
        $quiz->questions()->attach($request->checkbox);

        return response()->json(['success' => true, 'msg' => 'Quiz updated success']);
    }

    public function destroy(Quiz $quiz)
    {
        $arrayScore = [];
        $arrayQues = [];
        $arrayClass = [];
        $arrayUser = [];
        foreach ($quiz->classrooms as $classroom) {
            $arrayClass[] = $classroom->id;
        }
        foreach ($quiz->questions as $question) {
            $arrayQues[] = $question->id;
        }
        foreach ($quiz->users as $user) {
            $arrayUser[] = $user->id;
        }
        foreach ($quiz->quiz_results as $result) {
            $arrayScore[] = $result->score;
        }

        if ($arrayScore == null) {
            $quiz->questions()->detach($arrayQues);
            $quiz->classrooms()->detach($arrayClass);
            $quiz->delete();
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => false], 406);
        }
    }

    public function insertUser(Quiz $quiz, Request $request)
    {
        $quiz->users()->attach($request->checkbox);

        return response()->json(['success' => true],200);
    }

    public function insertClass(Quiz $quiz, Request $request)
    {
        $quiz->classrooms()->attach($request->checkbox);

        return response()->json(['success' => true],200);
    }

}
