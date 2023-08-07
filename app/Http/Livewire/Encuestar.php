<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;
use App\Models\Pregunta;

class Encuestar extends Component
{
    protected $queryString = ['id'];
    public $encuesta_id;
    public $encuesta;
    public $encuesta_completa = [];
    public $todas_las_preguntas;
    protected $listeners = ["quitar_vox" => "quitar_vox", "setear" => "setear"];
    public $vozactivada = false;
    public $estilo_microfono = "-dark";
    public $id_opcion = '';
    public function mount($id) {
       $this->encuesta_id = $id;
       $this->encuesta = Encuesta::find($this->encuesta_id);
       $this->todas_las_preguntas = $this->encuesta->preguntas;
       $this->llenarEncuestaParametros();
    }
    public function render()
    {
        return view('livewire.encuestar');
    }

    function llenarEncuestaParametros() {
        foreach ($this->todas_las_preguntas as $pregunta) {
            if ($pregunta->tipo == 1) {
                $this->encuesta_completa[$pregunta->id] = ["false"];
            } elseif ($pregunta->tipo == 2) {
                $this->encuesta_completa[$pregunta->id] = [''];
            } else {
                $this->encuesta_completa[$pregunta->id] = [];
                foreach (json_decode($pregunta->opciones) as $key => $valor) {
                    $this->encuesta_completa[$pregunta->id][] = '';
                }
            }
        }
    }

    public function ver() {
        dd($this->encuesta_completa);
    }

    public function voz($id_opcion) {
        $this->id_opcion = $id_opcion;
        if (!$this->vozactivada) {
            $this->estilo_microfono = "-danger";
            $this->dispatchBrowserEvent('voz');
            $this->vozactivada = true;
        }
    }

    public function quitar_vox($texto) {
        $this->estilo_microfono = "-dark";
        $this->vozactivada = false;
        $this->encuesta_completa[intval($this->id_opcion)][0] = $texto;
    }

}
