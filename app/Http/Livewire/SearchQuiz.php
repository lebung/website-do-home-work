<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\WithPagination;

class SearchQuiz extends Component
{
    use WithPagination;

    public $searchQuiz;

    public function render()
    {
        if ($this->searchQuiz != '') {
            $quizs = Quiz::select('id', 'title', 'duration', 'limit')->where('title', 'like', '%' . $this->searchQuiz . '%')->paginate(5);
        }
        $quizs = Quiz::where('title', 'like', '%' . $this->searchQuiz . '%')->paginate(5);
        return view('screens.backend.livewire.search-quiz', ['quizs' => $quizs]);
    }
}
