<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResultDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'answer_id',
        'quiz_result_id'
    ];

    //1 chi tiết kết quả quiz có nhiều câu hỏi
    public function question(){
        return $this->belongsTo(Question::class,'question_id','id');
    }

    //1 chi tiết kết quả có nhiều câu trả lời
    public function answer(){
        return $this->belongsTo(Answer::class,'answer_id','id');
    }

    //1 chi tiết kết quả thuộc 1 quiz
    public function quiz_result()
    {
        return $this->belongsTo(QuizResult::class,'quiz_result_id','id');
    }
}
