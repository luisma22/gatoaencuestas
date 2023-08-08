<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Models\Encuestados;
class Encuestar extends Component
{
    protected $queryString = ['id'];
    public $encuesta_id;
    public $encuesta;
    public $encuesta_completa = [];
    public $todas_las_preguntas;
    public $vozactivada = false;
    public $estilo_microfono = "-dark";
    public $id_opcion = '';
    public $cantidad_preguntas = 0;
    public function mount($id) {
       $this->encuesta_id = $id;
       $this->encuesta = Encuesta::find($this->encuesta_id);
       $this->todas_las_preguntas = $this->encuesta->preguntas;
       $this->cantidad_preguntas = count($this->todas_las_preguntas);
       $this->llenarEncuestaParametros();
    }
    public function render()
    {
        return view('livewire.encuestar');
    }

    function llenarEncuestaParametros() {
        foreach ($this->todas_las_preguntas as $pregunta) {
            if ($pregunta->tipo == 1) {
                $this->encuesta_completa[$pregunta->id] = ["No", "tipo" => $pregunta->tipo];
            } elseif ($pregunta->tipo == 2) {
                $this->encuesta_completa[$pregunta->id] = ['', "tipo" => $pregunta->tipo];
            } else {
                $this->encuesta_completa[$pregunta->id] = [];
                foreach (json_decode($pregunta->opciones) as $key => $valor) {
                    $this->encuesta_completa[$pregunta->id][] = '';
                }
                $this->encuesta_completa[$pregunta->id]['tipo'] = $pregunta->tipo;
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

    public function finalizarEncuesta() {
        Encuestados::create([
            'respuestas' => json_encode($this->encuesta_completa),
            'encuesta_id' => $this->encuesta_id
        ]);
        $this->dispatchBrowserEvent('finalizar_encuesta');
        $this->llenarEncuestaParametros();
    }

    public function irAEncuestas() {
        return redirect()->route('encuestas');
    }

}
