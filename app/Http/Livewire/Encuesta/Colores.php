<?php

namespace App\Http\Livewire\Encuesta;

use Livewire\Component;
use App\Models\Encuesta;

class Colores extends Component
{
    public $colores = ["#4b77a9", "#5f255f", "#5cd55f", "#5ab55f"];
    public $encuesta; 
    protected $listeners = ["color" => "setColores"];
    public function render()
    {
        return view('livewire.encuesta.colores');
    }

    public function setColores($colores) {
        if ($colores) {
            $this->colores = json_decode($colores); 
        }
    }

    public function guardar_colores() {
        $this->emit('colores', $this->colores);
        $this->colores = ["#4b77a9", "#5f255f", "#5cd55f", "#5ab55f"];
    }
}
