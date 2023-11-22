<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use App\Http\Requests\CourseCategoryRequest;
class CourseCategoryController extends Controller
{
    public function index(){
        $course_category=CourseCategory::where('parent_id', 0)->with('childs')->paginate(9);
        return view('screens.backend.course_category.course_category',compact('course_category'));
    }

    public function store(CourseCategoryRequest $request){

        $course_category=new CourseCategory();
        $course_category->fill($request->all());
        if($request->hasFile('thumbnail')){
            $img=$request->thumbnail;
            $imgName=$img->hashName();
            $course_category->thumbnail=$img->storeAs('images/course_category',$imgName);
        }
      $course_category->slug=str_replace(' ','-',$request->name);
        $course_category->save();
            $output=view('layouts.blade_api.courseCategory',[
                'course_category'=>CourseCategory::all(),
            ])->render();
        return Response()->json($output,200);

    }

    public function update(CourseCategoryRequest $request){
        $data=$request->all();
        $CourseCategory=CourseCategory::where('id',$data['id'])->first();
        if($request->hasFile('thumbnail')){
            $img=$data['thumbnail'];
            $imgName=$img->hashName();
            $data['thumbnail']= $img->storeAs('images/course_category',$imgName);
        }
        $CourseCategory->slug=str_replace(' ','-',$request->name);
        $CourseCategory->update($data);
        $output=view('layouts.blade_api.courseCategory',[
            'course_category'=>CourseCategory::all(),
        ])->render();
    return Response()->json($output,200);
    }

    public function destroy(CourseCategory $CourseCategory){
           $CourseCategory->delete();
           return redirect()->back()->with('alert','Thành công');
    }

    public function search(Request $request){

            $course_category = CourseCategory::with('childs')->where('name', 'LIKE', '%' . $request->search . '%')->paginate(9);
            // dd($course_category);
            if ($course_category) {
                $output=view('layouts.blade_api.courseCategory',[
                    'course_category'=>$course_category,
                ])->render();
                }
            return Response()->json($output,200);

    }
   


}
