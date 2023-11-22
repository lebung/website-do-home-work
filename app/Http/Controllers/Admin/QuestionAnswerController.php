<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionAnswerRequest;
use App\Http\Services\UploadService;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionAnswerController extends Controller
{
    public function index()
    {
        return view('screens.backend.questionquiz.list');
    }

    public function datalist(int $sort, $title)
    {
        $questions = Question::select('id', 'title', 'type', 'attachment', 'tag');
        if ($sort == 0) {
            $questions =  $questions->orderBy('id', 'DESC');
        } else {
            $questions =  $questions->orderBy('id', 'ASC');
        }
        if ($title != 0) {
            $questions =  $questions->where('title', 'LIKE', '%' . $title . '%');
        }
        $questions = $questions->paginate(6);
        $data = [
            'questions' =>  $questions
        ];
        $table = view('screens.backend.questionquiz.components.layout.table', $data)->render();
        return response()->json($table, 200);
    }

    public function create($type)
    {
        $data = [
            'type' => $type
        ];
        $data = view('screens.backend.questionquiz.components.forms.create', $data)->render();
        return response()->json($data, 200);
    }

    public function store(QuestionAnswerRequest $request)
    {
        try {
            $request_array = $request->all();
            if ($request->hasFile('attachment')) {
                $img = $request->attachment;
                $request_array['attachment'] =  UploadService::upload($img, 'question');
            }
            Question::create($request_array);
            $question_id = Question::select('id')->max('id');
            if (!$request->content) {
                $this->add_answer_essay($question_id);
                return response()->json('', 201);
            }
            $this->add_answers_check_radio($request, $question_id);
            return response()->json('', 201);
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

    public function update($id)
    {
        $question =  Question::select(
            'id',
            'title',
            'type',
            'attachment',
            'tag',
        )
            ->where('id', $id)->first();
        $data = [
            'question' => $question,
            'type' => $question->type
        ];
        $data = view('screens.backend.questionquiz.components.forms.update', $data)->render();
        return response()->json($data, 200);
    }

    public function edit(QuestionAnswerRequest $request)
    {
        try {
            $contentAnswers = '';
            $question_id = $request->id;
            $question = Question::find($question_id);
            $question->title = $request->title;
            $question->type = $request->type;
            $question->tag = $request->tag;
            if ($request->hasFile('attachment')) {
                $question->attachment = UploadService::upload($request->attachment, 'question');
            }
            $question->save();

            $contentAnswers = $request->content;
            $id_answers = $request->id_answer;
            if ($request->type == 0) {
                $this->put_answer($id_answers[0], $request);
                $data = [
                    'question' => $question,
                    'type' => $question->type
                ];
                $html = view('screens.backend.questionquiz.components.forms.update', $data)->render();
                return response()->json($html, 201);
            }
            if ($id_answers) {
                foreach ($id_answers as $key => $id) {
                    if ($contentAnswers[$key]) {
                        $PutAnswer = Answer::find($id);
                        $PutAnswer->content = $contentAnswers[$key];
                        unset($contentAnswers[$key]);
                        $PutAnswer->is_correct = $request->is_correct[$key];
                        $PutAnswer->save();
                    }
                }
            }
            if (!empty($contentAnswers)) {
                foreach ($contentAnswers as $key => $contentAnswer) {
                    $this->add_answer_queries($contentAnswer, $request->is_correct[$key], $question_id, $key);
                }
            }
            $data = [
                'question' => $question,
                'type' => $question->type
            ];
            $html = view('screens.backend.questionquiz.components.forms.update', $data)->render();
            return response()->json($html, 201);

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

    public function destroyAnswer($id)
    {
        Answer::destroy($id);
        return response()->json('', 205);
    }

    public function destroyQuestion($id)
    {
        $data = Question::select('title')->where('id', $id)->get();
        Question::destroy($id);
        return response()->json(['data' => $data], 205);
    }
    //-------------------------------------------------------------------
    public function add_answer_queries(string $val, int $is_correct, int $question_id): void
    {
        $answer = new Answer();
        $answer->content = $val;
        $answer->is_correct = $is_correct;
        $answer->question_id = $question_id;
        $answer->save();
    }
    public function add_answers_check_radio($request, $question_id)
    {
        foreach ($request->content as $key => $val) {
            $this->add_answer_queries($val, $request->is_correct[$key], $question_id);
        }
    }
    public function add_answer_essay($question_id)
    {
        $answer = new Answer();
        $answer->question_id = $question_id;
        $answer->save();
    }
    public function put_answer($id, $request)
    {
        $Answer = Answer::find($id);
        $Answer->is_correct = $request->is_correct[0];
        $Answer->save();
    }
}
