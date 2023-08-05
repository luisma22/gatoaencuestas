<?php

namespace App\Http\Livewire\Encuesta;

use Livewire\Component;
use App\Models\Pregunta;
class Preguntas extends Component
{
    public $todaslaspreguntas = [];
    public $search = '';
    public function render()
    {
        $this->todaslaspreguntas = Pregunta::orderBy('id', 'desc')->where('pregunta','LIKE', '%'. $this->search.'%')->get();
        $this->dispatchBrowserEvent('popoverremove'); 
        return view('livewire.encuesta.preguntas');
    }

    public function add($id) {
        $this->search = '';
        $this->emit('add', $id);
    }
}
