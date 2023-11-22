<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Services\UploadService;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        $categories = CourseCategory::with('childs')->where('parent_id', '=', 0)->get();
        $courses = Course::with(['lessons', 'sections', 'users', 'classrooms', 'category'])
            ->findByName($request)
            ->findByCategory($request)
            ->findByStatus($request)
            ->paginate(6);
        return view('screens.backend.course.list', compact('courses', 'categories'));
    }

    public function create()
    {
        $categories = CourseCategory::with('childs')->where('parent_id', '=', 0)->get();
        return view('screens.backend.course.create', compact('categories'));
    }

    public function store(CourseRequest $request)
    {
//        try{
        $course = new Course();
        $course->fill($request->all());
        if ($request->hasFile('thumbnail')) {
            $fileName = UploadService::upload($request->thumbnail, 'course');
            $course->thumbnail = $fileName;
        } else {
            $course->thumbnail = 'default.jpg';
        }
        $course->save();
        return redirect()
            ->route('admin.course.list')
            ->with('success', 'Thêm khóa học thành công');
//        }catch(\Exception $e){
//            Log::error($e->getMessage());
//            return redirect()
//                    ->back()
//                    ->withInput()
//                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
//        }
    }

    public function edit(Course $course)
    {
        $categories = CourseCategory::with('childs')->where('parent_id', '=', 0)->get();
        $course->load(['sections' => fn($q) => $q->with(['lessons' => fn($q) => $q->with('quizs')->orderBy('order')])->orderBy('order')]);
        return view('screens.backend.course.edit', compact('course', 'categories'));
    }

    public function update(CourseRequest $request, Course $course)
    {
//        try{
        $course->fill($request->all());
        if ($request->hasFile('thumbnail')) {
            $fileName = UploadService::upload($request->thumbnail, 'course');
            $course->thumbnail = $fileName;
        }
        $course->save();
        return redirect()
            ->to(url()->previous() . '#info')
            ->with('success', 'Cập nhật khóa học thành công');
//        }catch(\Exception $e){
//            Log::error($e->getMessage());
//            return redirect()
//                    ->back()
//                    ->withInput()
//                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
//        }
    }

    public function changeStatus(Course $course)
    {
        if ($course->status == 1) {
            $course->status = 0;
        } else {
            $course->status = 1;
        }
        $course->save();
        return redirect()
            ->back()
            ->with('success', 'Cập nhật trạng thái khóa học thành công');
    }

    public function destroy(Course $course)
    {
        $result = $course->delete();
        if ($result) {
            return redirect()
                ->route('admin.course.list')
                ->with('success', 'Xóa khóa học thành công');
        }
//        return redirect()
//            ->route('admin.course.list')
//            ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }

}
