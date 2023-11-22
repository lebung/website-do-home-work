<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        if ($this->search != '') {
            $questions = Question::select('id', 'title', 'tag')->where('tag', 'like', '%' . $this->search . '%')->get();
        }

        $questions = Question::where('tag', 'like', '%' . $this->search . '%')->get();
        return view('screens.backend.livewire.search', [
            'questions' => $questions,
        ]);
    }

}
