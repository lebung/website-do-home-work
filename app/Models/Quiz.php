<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quizs';

    protected $fillable = [
        'title',
        'duration',
        'limit',
    ];

    //Quiz thuộc lesson
    public function lessons(){
        return $this->belongsToMany(
            Lesson::class,
            'lesson_quiz',
            'quiz_id',
            'lesson_id'
        );
    }

    //1 bài quiz có nhiều câu hỏi
    public function questions(){
        return $this->belongsToMany(
            Question::class,
            'question_quiz',
            'quiz_id',
            'question_id'
        );
    }

    //Kết quả của quiz do học sinh làm
    public function quiz_results(){
        return $this->hasMany(QuizResult::class,'quiz_id','id');
    }

    public function users(){
        return $this->belongsToMany(
            User::class,
            'user_quiz',
            'quiz_id',
            'user_id'
        );
    }

    public function classrooms(){
        return $this->belongsToMany(
            Classroom::class,
            'class_quiz',
            'quiz_id',
            'class_id'
        );
    }
}
