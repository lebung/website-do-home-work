<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $view = view('screens.backend.particials.section.create', ['course' => $request->course])->render();
        return response()->json([
            'html' => $view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        try{
            $course = $request->course;
            $section = new Section();
            $section->title = $request->title;
            $section->order = Section::where('course_id', $course)->max('order') ?? 0;
            $section->course_id = $course;
            $section->save();
            if($request->ajax()){
                session()->flash('success', 'Thêm chương học thành công');
                return response()->json(['success' => true], 201);
            }
            return redirect()
                        ->back()
                        ->with('success', 'Thêm chương học thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            if($request->ajax()){
                return response()->json(['success' => false], 406);
            }
            return redirect()
                        ->back()
                        ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section, Request $request)
    {
        $course = $request->course;
        $html = view('screens.backend.particials.section.edit', compact('course', 'section'))->render();
        return response()->json([
            'html' => $html
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $section->title = $request->title;
        $section->save();
        return redirect()
                ->back()
                ->with('success', 'Cập nhật chương học thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $result = $section->delete();
        if($result){
            return redirect()
                        ->back()
                        ->with('success', 'Xóa chương học thành công');
        }
        return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }

    public function sort(Course $course)
    {
        $course->load(['sections' => fn($q) => $q->orderBy('order')]);
        $html = view('screens.backend.particials.section.sort', compact('course'))->render();
        return response()->json([
            'html' => $html
        ]);
    }

    public function processSort(Request $request, Course $course)
    {
        try{
            foreach($request->sections as $order => $section){
                $section = Section::find($section);
                $section->order = $order;
                $section->save();
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

}
