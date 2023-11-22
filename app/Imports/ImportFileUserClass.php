<?php

namespace App\Imports;

use App\Models\Classroom;
use App\Models\User;
use App\Notifications\MailAddStudentClass;
use Pusher\Pusher;
use App\Models\UserClassroom;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportFileUserClass implements ToCollection,WithHeadingRow
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
    
    public function collection(Collection $rows)
    {   
        Validator::make($rows->toArray(), [
            '*.user_id' => 'required',

        ])->validate();

        $userListID = $rows->pluck('user_id')->all();
        $userListID = array_filter($userListID, fn($val) => $val != null);
        // $validator = Validator::make(['user_id' => $userListID], [
        //     'user_id' => 'required|array',

        // ]);

        // if($validator->fails()){
        //     throw new Exception('Vui lòng chọn tệp người dùng chính xác');
        // }

        

        $usersClass = Classroom::find($this->id)->users->pluck('id')->toArray();
        $class = Classroom::find($this->id);
    
        foreach ($rows as $row) {
            if (!in_array($row['user_id'], $usersClass)) {
                $class->users()->attach($row['user_id']);


                $user = User::find($row['user_id']);

                // add khoá học
                $courseClass = $class->courses->pluck('id')->toArray();
                $courseUser = $user->courses->pluck('id')->toArray();
                foreach ($courseClass as $key => $courseItem) {
                    if(!in_array($courseItem,$courseUser)){
                        $user->courses()->attach($courseItem);
                    }
                    
                }
                
                

                //gửi mail;
                $user->notify(new MailAddStudentClass($this->id));

                // thông báo tham gia lớp học
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
            }
            
            
        }
        


        // $users = UserClassroom::where('classroom_id', '=', $this->id)
        //                     ->pluck('user_id')->all();
        // foreach ($rows as $row) {
        //     if (!in_array($row['user_id'], $usersClass)) {
        //         $user = User::find($row['user_id']);
        //         $user->classrooms()->attach($usersClass);
        //         UserClassroom::create([
        //             'user_id' => $row['user_id'],
        //             'classroom_id' => $this->id, 
        //         ]);
        //     }
        // }
    }
}
