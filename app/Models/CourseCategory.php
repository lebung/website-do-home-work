<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'thumbnail',
    ];

    // 1 danh mục khóa học có nhiều khóa học
    public function courses()
    {
        return $this->hasMany(Course::class,'category_id','id');
    }

    // child
    public function childs()
    {
        return $this->hasMany(CourseCategory::class, 'parent_id', 'id');
    }
}
