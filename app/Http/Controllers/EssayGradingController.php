<?php

namespace App\Http\Controllers;

use App\Models\QuizResult;
use Illuminate\Http\Request;

class EssayGradingController extends Controller
{
    public function index($quiz_id){
        $a = QuizResult::where('quiz_id',$quiz_id)->get();
        dd($a);
        return view('screens.frontend.essaygrading.essaygrading');
    }
}
