<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'status',
        'user_id',
        'image'
    ];

    //1 lớp học có 1 tác giả
    public function author(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    //1 lớp học có nhiều học sinh
    public function users(){
        return $this->belongsToMany(
            User::class,
            'user_classroom',
            'classroom_id',
            'user_id'
        )->withTimestamps();
    }

    // 1 lớp học có nhiều khóa học
    public function courses(){
        return $this->belongsToMany(
            Course::class,
            'class_course',
            'class_id',
            'course_id'
        )->withTimestamps();
    }

    public function quizs(){
        return $this->belongsToMany(
            Quiz::class,
            'class_quiz',
            'class_id',
            'quiz_id'
        );
    }
}
