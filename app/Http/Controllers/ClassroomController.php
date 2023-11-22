<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    
    public function show(Classroom $classroom)
    {
        $classroom->load(['courses' => fn($q) => $q->where('status', 1)]);
        return view('screens.frontend.classroom-detail', compact('classroom'));
    }

}
