<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;

class Questions extends Component
{
    public $active;

    protected $listeners = ['questionSelected'];

    public function questionSelected($questionId)
    {
        $this->active = $questionId;
    }

    public function render()
    {
        return view('livewire.questions', [
            'questions' => Question::all(),
        ]);
    }
}
