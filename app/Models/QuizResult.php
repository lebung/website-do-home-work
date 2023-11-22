<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
        'start_time',
        'end_time',
        'user_id',
        'quiz_id'
    ];

    //1 kết quả quiz thuộc về 1 user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //1 kết quả thuộc về 1 quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    public function quiz_result_details()
    {
        return $this->hasMany(QuizResultDetail::class, 'quiz_result_id', 'id');
    }

    
}
