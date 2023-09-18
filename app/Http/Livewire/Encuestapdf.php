<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;
use App\Models\Encuestados;
use PDF;

class Encuestapdf extends Component
{
    protected $queryString = ['id'];

    public function render()
    {
        return view('livewire.encuestapdf');
    }

    public function pdf($id, $id2, $position = 0, $indice = 0) {
        $encuesta = Encuesta::find($id);
        $preguntas = $encuesta->preguntas;
        $encuestados = count($encuesta->encuestados);
        if ($position) {
            $encuestados = $position;
        }
        $html = '';
        if ($id2 == 0) {
            if ($indice) {
                $encuetados_parte = Encuestados::orderBy('id', 'asc')->where('encuesta_id', $id)->limit(30)->offset(($indice - 1)*30)->get(); 
                $encuestados = 'todas_parte_'.$indice;
                foreach ($encuetados_parte as $encuestado) {
                    $view = view('livewire.encuestapdf', ['preguntas' => $preguntas, 'respuestas' => json_decode($encuestado->respuestas, true), 'encuesta' => $encuesta]);
                    $html .= $view->render()."<div class='page-break'></div>";
                }
                $pdf = PDF::loadHTML($html);
            }
        } else {
            $respuestas = json_decode(Encuestados::find($id2)->respuestas, true);
            $pdf = PDF::loadView('livewire.encuestapdf', ['preguntas' => $preguntas, 'respuestas' => $respuestas, 'encuesta' => $encuesta]) ;
        }
        return $pdf->download($encuesta->nombre.'_encuesta_'.$encuestados.'.pdf');
        
    }
}
