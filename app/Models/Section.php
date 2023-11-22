<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'order',
        'course_id'
    ];

    //1 section thuộc 1 khóa học
    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }

    //1 section có nhiều bài học
    public function lessons(){
        return $this->hasMany(Lesson::class,'section_id','id');
    }
}
