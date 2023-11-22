<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClassroom extends Model
{
    use HasFactory;
    protected $table = "user_classroom";
    protected $fillable = [
        'user_id',
        'classroom_id'
    ];
}
