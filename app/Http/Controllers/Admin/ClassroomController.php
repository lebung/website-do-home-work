<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Http\Requests\ClassroomRequest;
use App\Models\CourseCategory;
class ClassroomController extends Controller
{
    public function index(){
        $classroom=Classroom::select('*')
        ->with('author')
        ->with('courses')
        ->paginate(10);
        $user=User::select('*')->paginate(10);
        return view('screens.backend.classroom.classroom',[
            'classroom'=>$classroom,
            'user'=>$user
        ]);
    }
    public function create(){
        $course=Course::all();
        return view('screens.backend.classroom.create',compact('course'));
    }
    public function store_classroom(ClassroomRequest $request){
       $classroom=new Classroom();
       $classroom->fill($request->all());
       $classroom->user_id=Auth::id();
       if($request->hasFile('image')){
        $img=$request->image;
        $imgName=$img->hashName();
       $classroom->image=$img->storeAs('images/classroom',$imgName);
      }
       $classroom->save();
       $classroom->courses()->attach($request->checkbox);
       return redirect()->route('classroom.index')->with('alert','Thành công');
    }
    public function form_update(Classroom $classroom){
        $course= Course::all();
        return view('screens.backend.classroom.edit',[
          'classroom'=>$classroom,
          'course' =>$course
        ]);
    }
    public function update_classroom(Classroom $classroom, ClassroomRequest $request){
        $data=$request->all();
        if($request->hasFile('image')){
            $img=$data['image'];
            $imgName=$img->hashName();
           $data['image']=$img->storeAs('images/classroom',$imgName);
          }
        $classroom->update($data);
        $classroom->courses()->detach($classroom->courses);
        $classroom->courses()->attach($data['checkbox']);

        return redirect()->route('classroom.index')->with('alert','Thành công');
    }
    public function change_status(Request $request){
         $classroom = Classroom::where('id',$request->change_status)->first();
            if($classroom->status==1){
                $classroom->status=0;
            }else{
                $temp= $classroom->status=1;
            }
            $classroom->save();
        $output=view('layouts.blade_api.class',['classroom'=>Classroom::select('*')->with('author')->paginate(10)])->render();
        return Response()->json($output,200);
    }
    public function search(Request $request){

            $classroom = Classroom::where('name', 'LIKE', '%' . $request->search . '%')->with('author')->get();
            if ($classroom) {
                $output=view('layouts.blade_api.class',compact('classroom'))->render();
                }
            return Response()->json($output,200);
        
    }
    public function fillter(Request $request){

            $classroom=Classroom::where('user_id',$request->fillter)->get();
            if ($classroom) {
                $output=view('layouts.blade_api.class',compact('classroom'))->with('author')->render();
                }
                return Response()->json($output,200);

    }

}
