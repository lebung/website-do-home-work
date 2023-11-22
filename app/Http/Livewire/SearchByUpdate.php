<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class SearchByUpdate extends Component
{
    use WithPagination;

    public $searchTitle = '';
    public $quiz = '';

    public function render()
    {
        if ($this->searchTitle != '') {
            $questions = Question::select('id', 'title', 'tag')->where('tag', 'like', '%' . $this->searchTitle . '%')->get();
        }else{
            $questions = Question::where('tag', 'like', '%' . $this->searchTitle . '%')->get();
        }

        return view('screens.backend.livewire.search-by-update', [
            'questions' => $questions,
            'quiz' => $this->quiz
        ]);
    }

    public function mount($quiz)
    {
        $this->quiz = $quiz;
    }

}
