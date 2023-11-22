<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'video_path',
        'video_type',
        'attachment',
        'order',
        'course_id',
        'section_id'
    ];

    //Các bài học thuộc 1 khóa học
    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }

    //Các bài học thuộc 1 phần nào đó của khóa học
    public function section(){
        return $this->belongsTo(Section::class,'section_id','id');
    }

    //Quiz trong các bài học
    public function quizs(){

        return $this->belongsToMany(Quiz::class, 'lesson_quiz', 'lesson_id', 'quiz_id');
    }

    public function lesson_histories(){
        return $this->hasMany(LessonHistory::class, 'lesson_id','id');
    }
}
