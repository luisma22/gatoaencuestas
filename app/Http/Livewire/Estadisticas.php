<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;
use App\Models\Encuestados;
use PDF;

class Estadisticas extends Component
{
    protected $queryString = ['id'];
    public $encuesta_id;
    public $encuesta;
    public $respuestas_preguntas = [];
    public $todas_las_preguntas;
    public $nombre_pregunta = [];
    public $cantidad_preguntas = 0;
    public $todas_las_respuestas;
    public $encuestados = 0;
    public $is_pdf = false;
    public $valor_col_grid_pdf = 1;
    public $cantidad_reportes = 0;
    public function mount($id) {
        $this->iniciarDatos($id);
    }

    public function render()
    {
        return view('livewire.estadisticas');
    }

    function llenarEncuestaParametrosEstadistica() {
        foreach ($this->todas_las_preguntas as $pregunta) {
            $this->nombre_pregunta[$pregunta->id] = $pregunta->pregunta;
            if ($pregunta->tipo == 1) {
                $this->respuestas_preguntas[$pregunta->id]['Si'] = 0;
                $this->respuestas_preguntas[$pregunta->id]['No'] = 0;
                $this->respuestas_preguntas[$pregunta->id]['tipo'] = $pregunta->tipo;
            } elseif ($pregunta->tipo == 2) {
                $this->respuestas_preguntas[$pregunta->id]['vacio'] = 0;
                $this->respuestas_preguntas[$pregunta->id]['lleno'] = 0;
                $this->respuestas_preguntas[$pregunta->id]['tipo'] = $pregunta->tipo;
            } else {
                foreach (json_decode($pregunta->opciones) as $key => $valor) {
                    $this->respuestas_preguntas[$pregunta->id][$valor] = 0;
                }
                $this->respuestas_preguntas[$pregunta->id]['tipo'] = $pregunta->tipo;
            }
        }
    }

    private function llenarResultadosEncuesta() {
        foreach ($this->todas_las_respuestas as $respuesta) {
            foreach (json_decode($respuesta->respuestas) as $key => $resp) {
                $convertido=(array)$resp;
                if ($resp->tipo == "1") {
                    $this->respuestas_preguntas[$key][$convertido[0]]++; 
                } elseif ($resp->tipo == "2") {
                    if ($convertido[0] == "") {
                        $this->respuestas_preguntas[$key]['vacio']++; 
                    } else {
                        $this->respuestas_preguntas[$key]['lleno']++; 
                    }
                } else {
                    foreach($convertido as $key2 => $res) {
                        if ($res == false || $res == "" || $key2 == "tipo" || !array_key_exists($res, $this->respuestas_preguntas[$key])) {
                            continue;
                        } else {
                            $this->respuestas_preguntas[$key][$res]++;
                        }
                    }
                }
            }
        }
    }

    public function irAEncuestas() {
        return redirect()->route('encuestas');
    }

    public function iniciarDatos($id) {
        $this->encuesta_id = $id;
        $this->encuesta = Encuesta::find($this->encuesta_id);
        if ($this->encuesta != null) {
            $this->todas_las_preguntas = $this->encuesta->preguntas;
            $this->cantidad_preguntas = count($this->todas_las_preguntas);
            $this->llenarEncuestaParametrosEstadistica();
            $this->todas_las_respuestas = Encuestados::All()->where('encuesta_id', $this->encuesta_id);
            $this->encuestados = count($this->todas_las_respuestas);
            $this->llenarResultadosEncuesta();
            $this->cantidad_reportes = ceil($this->cantidad_preguntas/3);
        }
    }

    public function ver() {
        $this->is_pdf = (!$this->is_pdf) ? true: false;
        $this->dispatchBrowserEvent('para_pdf');
        $this->valor_col_grid_pdf = (!$this->is_pdf) ? 1: 2;
    }
    
}
