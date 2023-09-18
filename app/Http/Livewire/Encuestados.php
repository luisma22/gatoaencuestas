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
    public $partes;
    public $cantidad;
    public $final = 0;
    public function mount($id) {
       $this->encuesta_id = $id;
       $this->cantidad = 30;
       $this->encuesta = Encuesta::orderBy('id', 'desc')->find($this->encuesta_id);
       if ($this->encuesta != null) {
           $this->encuestados = $this->encuesta->encuestados;
           $this->partes = floor(count($this->encuestados)/$this->cantidad);
           if((count($this->encuestados)/$this->cantidad) > $this->partes) {
                $this->partes++;
                $this->final = count($this->encuestados)%$this->cantidad;
           } 
       }
    }
    public function render()
    {
        return view('livewire.encuestados');
    }

    public function generarPDF($encuestado, $posicion) {
        return redirect()->route('encuestapdf.pdf', [$this->encuesta, $encuestado, $posicion, 0]);
    }

    public function irAEncuestas() {
        return redirect()->route('encuestas');
    }

    public function descargartodo($indice) {
        $this->dispatchBrowserEvent('tomara_tiempo'); 
        return redirect()->route('encuestapdf.pdf', [$this->encuesta, 0, 0, $indice]);
    }
}
