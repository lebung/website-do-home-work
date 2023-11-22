<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'question_id',
        'is_correct'
    ];

    //1 câu trả lời thuộc về 1 câu hỏi
    public function question(){
        return $this->belongsTo(Question::class,'question_id','id');
    }
}
