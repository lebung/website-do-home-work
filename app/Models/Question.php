<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'attachment',
        'tag',
    ];

    //Các câu hỏi thuộc 1 bài quiz
    public function quizs()
    {
        return $this->belongsToMany(
            Quiz::class,
            'question_quiz',
            'question_id',
            'quiz_id'
        );
    }

    //Danh sách câu trả lời thuộc 1 câu hỏi
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id','id');
    }
}
