<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;
use App\Models\Pregunta;

class Encuestas extends Component
{
    public $nombre;
    public $descripcion;
    public $editar = false;
    public $encuestaEditable;
    public $texto_modal = "Crear Encuesta";
    public $vertodo= false;
    public $preguntas_encuesta = [];
    public $todaslaspreguntas = [];
    public $preguntas_id = [];
    public $tipos = [1 => "Si/No", 2 => "Multiple Seleccion", 3 => "Completado"];
    public function mount() {
    }
    public function render()
    {
        if($this->vertodo) {
            $this->encuestas = Encuesta::orderBy('id', 'desc')->get();
        } else {
            $this->encuestas = Encuesta::orderBy('id', 'desc')->where('habilitado', 1)->get();
        }
        $this->todaslaspreguntas = Pregunta::orderBy('id', 'desc')->get();
        return view('livewire.encuestas');
    }

    public function crear() {
        $this->validate();
        Encuesta::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'habilitado' => 1
        ]);
        $this->preguntas_encuesta = [];
        $this->limpiar();
        $this->dispatchBrowserEvent('encuestas'); 
    }

    public function limpiar() {
        $this->preguntas_encuesta = [];
        $this->preguntas_id= [];
        $this->nombre = '';
        $this->descripcion = '';
    }

    public function cancelar() {
        $this->limpiar();
        $this->editar = false;
    }

    public function editar(Encuesta $encuesta) {
        $this->texto_modal = "Actualizar Encuesta";
        $this->editar = true;
        $this->encuestaEditable = $encuesta;
        $this->nombre = $encuesta->nombre;
        $this->descripcion = $encuesta->descripcion;
        $this->preguntas_encuesta = $encuesta->preguntas;
        $this->preguntas_id = [];
    }

    public function actualizar() {
        $this->validate();
        $this->encuestaEditable->nombre = $this->nombre;
        $this->encuestaEditable->descripcion = $this->descripcion;
        $this->encuestaEditable->save();
        $this->cancelar();
        $this->limpiar();
        $this->dispatchBrowserEvent('encuestas'); 
    }

    public function eliminar(Encuesta $encuesta) {
        $encuesta->habilitado = 0;
        $encuesta->save();
    }
    public function rules()
    { 
        return [
            'nombre' => 'required|min:12',
            'descripcion' => 'required|min:12'
        ];
    }

    public function ver() {
        $this->vertodo = !$this->vertodo;
    }

    public function restaurar(Encuesta $encuesta) {
        $encuesta->habilitado = 1;
        $encuesta->save();
    }

    public function updateTaskOrder($lists) {
        $this->preguntas_id= [];
        $auxiliar = [];
        foreach($lists as $list) {
            $id = (int)$list["value"];
            $this->preguntas_id[] = $id;
            /*foreach ($this->preguntas_encuesta as $pregunta) {
                if ($id == $pregunta->id) {
                    $auxiliar[] = $pregunta;
                    break;
                }
            }*/
        }
        $this->encuestaEditable->preguntas()->detach();
        $this->encuestaEditable->preguntas()->attach(
            $this->preguntas_id
        );
        $this->preguntas_encuesta = Encuesta::find($this->encuestaEditable->id)->preguntas;
    }

    public function activar() {
        $this->dispatchBrowserEvent('popover-activar');
    }
}
