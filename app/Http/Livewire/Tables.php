<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;
use App\Models\User;

class Tables extends Component
{
    public $encuestas;
    public $users;

    public function mount() {
        $this->users = User::All();
    }
    public function render()
    {
        $this->encuestas = Encuesta::All();
        //dd($this->encuestas->preguntas()->get()[0]->pregunta);
        return view('livewire.tables');
    }
}
