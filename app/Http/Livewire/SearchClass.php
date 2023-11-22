<?php

namespace App\Http\Livewire;

use App\Models\Classroom;
use Livewire\Component;

class SearchClass extends Component
{
    public $searchClass = '';
    public function render()
    {
        $classrooms = Classroom::where('name','like', '%'. $this->searchClass .'%')->get();
        return view('screens.backend.livewire.search-class', ['classrooms' => $classrooms]);
    }
}
