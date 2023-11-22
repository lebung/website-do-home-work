<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonHistory extends Model
{
    use HasFactory;

    protected $table = 'lesson_history';

    protected $fillable = [
        'lesson_id',
        'course_id',
        'statys'
    ];

    public function lesson(){
        return $this->belongsToMany(Lesson::class, 'lessons', 'lesson_id','id' );
    }

    public function course(){
        return $this->belongsToMany(Course::class,'courses','course_id','id');
    }
}
