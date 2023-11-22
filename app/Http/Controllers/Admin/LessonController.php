<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Http\Services\UploadService;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LessonController extends Controller
{
    public function selectType(Request $request, Course $course, $type = null)
    {
        $html = view('screens.backend.particials.lesson.type', compact('course', 'type'))->render();
        return response()->json([
            'html' => $html
        ]);
    }

    public function create(Request $request, Course $course, $type)
    {
        $sections = Section::where('course_id', $course->id)->orderBy('order')->get();
        $html = view('screens.backend.particials.lesson.create', compact('type', 'sections', 'course'))->render();
        return response()->json([
            'html' => $html
        ]);
    }

    public function store(LessonRequest $request, Course $course)
    {
        // dd($request->all());
        DB::beginTransaction();
        try{
            $lesson = new Lesson();
            $lesson->title = $request->title;
            $lesson->section_id = $request->section_id;
            $lesson->course_id = $course->id;
            if($request->lesson_type == 'youtube'){
                $lesson->video_path = $request->video_url;
                $lesson->video_type = 'youtube';
                $lesson->lesson_type = 'video';
            } else if($request->lesson_type == 'video'){
                $lesson->video_path = UploadService::upload($request->video_file, 'lesson', 'documents/video');
                $lesson->video_type = 'system';
                $lesson->lesson_type = 'video';
            } else if($request->lesson_type == 'document'){
                $lesson->lesson_type = 'document';
                $extension = $request->doc_file->extension();
                $lesson->doc_file = UploadService::upload($request->doc_file, 'lesson', 'documents/'.$extension);
            } else {
                $lesson->lesson_type = 'text';
            }
            $lesson->content = $request->text_content;
            $attachments = [];
            if($request->hasFile('attachment')){
                foreach($request->attachment as $file){
                    $extension = $file->extension();
                    $fileName = UploadService::upload($file, 'file', 'documents/'.$extension);
                    $attachments[] = $fileName;
                }
            }
            $lesson->attachment = json_encode($attachments);
            $lesson->order = Lesson::where('course_id', $course->id)
                                    ->where('section_id', $request->section_id)
                                    ->max('order')+1 ?? 0;
            $lesson->save();
            DB::commit();
            if($request->ajax()){
                session()->flash('success', 'Thêm bài học thành công');
                return response()->json(['success' => true], 201);
            }
            return redirect()
                    ->back()
                    ->with('success', 'Thêm bài học thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            DB::rollBack();
            if($request->ajax()){
                session()->flash('success', 'Có lỗi xảy ra, vui lòng thử lại');
                return response()->json(['success' => false], 406);
            }
            return redirect()
                    ->back()
                    ->with('success', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function edit(Lesson $lesson)
    {
        $sections = Section::where('course_id', $lesson->course->id)->orderBy('order')->get();
        $html = view('screens.backend.particials.lesson.edit', compact('sections', 'lesson'))->render();
        return response()->json([
            'html' => $html
        ]);
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        DB::beginTransaction();
        try{
            $lesson->title = $request->title;
            $lesson->section_id = $request->section_id;
            if($request->lesson_type == 'youtube'){
                $lesson->video_path = $request->video_url;
            } else if($request->lesson_type == 'video'){
                if($request->hasFile('video_file')){
                    $lesson->video_path = UploadService::upload($request->video_file, 'lesson', 'documents/video');
                }
            } else if($request->lesson_type == 'document'){
                $lesson->lesson_type = 'document';
                if($request->hasFile('doc_file')){
                    $extension = $request->doc_file->extension();
                    $lesson->doc_file = UploadService::upload($request->doc_file, 'lesson', 'documents/'.$extension);
                }
            } else {
                $lesson->lesson_type = 'text';
            }
            $lesson->content = $request->text_content;
            if($request->hasFile('attachment')){
                $attachments = [];
                foreach($request->attachment as $file){
                    $extension = $file->extension();
                    $fileName = UploadService::upload($file, 'file', 'documents/'.$extension);
                    $attachments[] = $fileName;
                }
                $lesson->attachment = json_encode($attachments);
            }
            $lesson->save();
            DB::commit();
            if($request->ajax()){
                session()->flash('success', 'Thêm bài học thành công');
                return response()->json(['success' => true], 201);
            }
            return redirect()
                    ->back()
                    ->with('success', 'Thêm bài học thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            DB::rollBack();
            if($request->ajax()){
                session()->flash('success', 'Có lỗi xảy ra, vui lòng thử lại');
                return response()->json(['success' => false], 406);
            }
            return redirect()
                    ->back()
                    ->with('success', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function destroy(Lesson $lesson)
    {
        $result = $lesson->delete();
        if($result){
            return redirect()
                        ->back()
                        ->with('success', 'Xóa bài học thành công');
        }
        return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }

    public function sort(Section $section)
    {
        $section->load(['lessons' => fn($q) => $q->orderBy('order')]);
        $html = view('screens.backend.particials.lesson.sort', compact('section'))->render();
        return response()->json([
            'html' => $html
        ]);
    }

    public function processSort(Request $request, Section $section)
    {
        try{
            foreach($request->lessons as $order => $lesson){
                $lesson = Lesson::find($lesson);
                $lesson->order = $order;
                $lesson->save();
            }
            return redirect()
                    ->back()
                    ->with('success', 'Cập nhật thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function quiz(Lesson $lesson)
    {   
        $quizs = Quiz::all();
        $lesson->load('quizs');
        $html = view('screens.backend.particials.lesson.quiz', compact('quizs', 'lesson'))->render();
        return response()->json(['html' => $html]);
    }

    public function addQuiz(Request $request, Lesson $lesson)
    {   
        try{
            if(!$request->has('quizs')){
                return response()->json([
                    'errors' => [
                        'quizs' => ['Vui lòng chọn quiz']
                    ]
                    ], 422);
            }
            $lesson->quizs()->sync($request->quizs);
            session()->flash('success', 'Thêm quiz cho bài học thành công');
            return response()->json(['success' => true]);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại');
            return response()->json(['success' => false], 406);
        }
    }

}
