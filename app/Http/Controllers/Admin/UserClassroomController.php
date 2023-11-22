<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ImportFileUserClass;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\User;
use App\Models\UserClassroom;
use App\Notifications\MailAddStudentClass;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Pusher\Pusher;
use Illuminate\Http\Request;

class UserClassroomController extends Controller
{
    public function index($id){
        
        $class = Classroom::find($id);
        return view('screens.backend.user-class.list',['class'=>$class]);
    }

    public function formImport($id){
        return view('screens.backend.user-class.import-excel');
    }

    public function importExUserClass($id , Request $request){
        // dd($request->id);
        if(!$request->has('file')){
            return redirect()
                    ->back()
                    ->with('error-validation', 'Vui lòng chọn tệp');
        }
        try{
            Excel::import(new ImportFileUserClass($request->id), $request->file);
        }catch(\Exception $e){
            return redirect()
                    ->back()
                    ->with('error-validation', $e->getMessage());
        }
        return back()->with('success', 'Thêm thành công');
    }

    public function addStudent($id){
        $users = User::select('*')->role('student')->get();
        // dd($users);
        return view('screens.backend.user-class.add-student',['users'=>$users]);
    }

    public function postAddStudent($id,Request $request){
        // dd($request->all());
        $rule = [
            'addstudent' => 'required',
            
        ];
        $messages = [
            'required' => 'Vui lòng chọn sinh viên',
            
        ];
        $request->validate($rule,$messages);
        // dd($id);
        // dd($request->addstudent);
        $userclass = Classroom::find($id)->users;
        foreach ($request->addstudent as $key => $studentId) {
            if (!$userclass->contains($studentId)){
                $user =  User::where('id','=',$studentId)->first();

                $classroom = Classroom::find($id);
                $classroom->users()->attach($studentId);

                
                // $courses = Classroom::find($id)->courses;
                // //   dd($courses->pluck('id')->toArray());
                // $user->courses()->attach($courses->pluck('id')->toArray());


                // add khoá học kiểm tra vòng lặp
                $class = $classroom->courses->pluck('id')->toArray();
                // $courseClass = $class->courses->pluck('id')->toArray();
                $courseUser = $user->courses->pluck('id')->toArray();
                foreach ($class as $key => $courseItem) {
                    if(!in_array($courseItem,$courseUser)){
                        $user->courses()->attach($courseItem);
                    }
                    
                }
                // gửi mail tham gia lớp học
                $emailUser = User::where('id','=',$studentId)->first();
                $emailUser->notify(new MailAddStudentClass($id));

                // thông báo tham gia lớp học
                $class = Classroom::find($id);
                $data['title'] = "Chào mừng bạn đã tham gia lớp học  ";
                $data['class'] = $class->name;

                $options = array(
                    'cluster' => 'ap1',
                    'useTLS' => true
                );
                $pusher = new Pusher(
                    'c99225feca5b539fb20f',
                    '06f640a63b9f8a4397db',
                    '1472142',
                    $options
                );

                $pusher->trigger('AddStudentClassNotify', 'send-student-class', $data);

                Session::get('success');
                $sessions = session()->flash('success', 'Thêm sinh viên mới thành công');
                $request->$sessions;
            }
            else{
                Session::get('warning');
                $sessions = session()->flash('warning', 'Một số email bạn chọn đã tồn tại trong lớp');
                $request->$sessions;
                
            }
            
            
        }
        
        return back();
    }

    public function removeUserClass($classId, Request $request){
        // dd($request->userId);
        $class = Classroom::find($classId);
        $class->users()->detach($request->userId);
        // $user = User::find($request->userId);
        // $user->classrooms()->detach($classId);
    }

}
