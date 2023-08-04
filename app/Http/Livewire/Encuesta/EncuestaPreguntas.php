<?php

namespace App\Http\Livewire\Encuesta;

use Livewire\Component;
use App\Models\Encuesta;
class EncuestaPreguntas extends Component
{
    public $encuesta_id = 0;
    public $preguntas_encuesta = [];
    protected $listeners = ['preguntas' => 'setId'];
    public function render()
    {
        if ($this->encuesta_id) {
            $this->preguntas_encuesta = Encuesta::find($this->encuesta_id)->preguntas; 
        }
        return view('livewire.encuesta.encuesta-preguntas');
    }
    public function setId($id) {
        $this->encuesta_id = $id; 
    }
}
