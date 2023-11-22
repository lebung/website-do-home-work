<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'thumbnail',
        'status',
        'config',
        'category_id'
    ];

    public function users(){
        return $this->belongsToMany(
            User::class,
            'user_course',
            'course_id',
            'user_id'
        );
    }

    public function category(){
        return $this->belongsTo(CourseCategory::class,'category_id','id');
    }

    public function classrooms(){
        return $this->belongsToMany(
            Classroom::class,
            'class_course',
            'course_id',
            'class_id'
        );
    }

    //1 khóa học có nhiều phần
    public function sections(){
        return $this->hasMany(Section::class,'course_id','id');
    }

    //1 khóa học có nhiều bài học
    public function lessons(){
        return $this->hasMany(Lesson::class,'course_id','id');
    }

    public function getProgress()
    {
        if(!auth()->user()->courses->contains($this->id)) return null;
        $totalLesson = $this->lessons()->count();
        $totalHistory = LessonHistory::where('course_id', $this->id)
                                    ->where('user_id', auth()->user()->id)
                                    ->count();
        $progress = ($totalLesson > 0) ? ($totalHistory/$totalLesson)*100 : 0;
        return round($progress, 2, PHP_ROUND_HALF_DOWN);
    }

    public function scopeFindByName($query, $request){
        if($request->q){
            $query->where('title', 'like', '%'.$request->q.'%');
        }
    }

    public function scopeFindByCategory($query, $request){
        if($request->category){
            $query->whereHas('category', function($q) use ($request){
                return $q->where('slug', $request->category);
            });
        }
    }

    public function scopeFindByStatus($query, $request){
        if($request->status != null){
            $query->where('status', $request->status);
        }
    }

}
