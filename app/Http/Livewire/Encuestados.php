<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;

class Encuestados extends Component
{
    protected $queryString = ['id'];
    public $encuesta_id;
    public $encuesta;
    public $encuestados;
    public function mount($id) {
       $this->encuesta_id = $id;
       $this->encuesta = Encuesta::orderBy('id', 'desc')->find($this->encuesta_id);
       if ($this->encuesta != null) {
            $this->encuestados = $this->encuesta->encuestados;
       }
    }
    public function render()
    {
        return view('livewire.encuestados');
    }

    public function generarPDF($encuestado, $posicion) {
        return redirect()->route('encuestapdf.pdf', [$this->encuesta, $encuestado, $posicion]);
    }

    public function irAEncuestas() {
        return redirect()->route('encuestas');
    }
}
