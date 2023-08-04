<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;
use App\Models\Pregunta;
use Illuminate\Support\Collection;

class Encuestas extends Component
{
    public $nombre;
    public $descripcion;
    public $editar = false;
    public $encuestaEditable;
    public $texto_modal = "Crear Encuesta";
    public $vertodo = false;
    public $preguntas_encuesta = [];
    public $todaslaspreguntas = [];
    public $preguntas_id = [];
    public $tipos = [1 => "Si/No", 2 => "Multiple Seleccion", 3 => "Completado"];
    public $encuesta_ver;
    protected $listeners = ["add" => "add"];
    public function mount() {
        $this->preguntas_encuesta = new \Illuminate\Database\Eloquent\Collection;
    }
    public function render()
    {
        if($this->vertodo) {
            $this->encuestas = Encuesta::orderBy('id', 'desc')->get();
        } else {
            $this->encuestas = Encuesta::orderBy('id', 'desc')->where('habilitado', 1)->get();
        }

        return view('livewire.encuestas');
    }

    public function crear() {
        $this->validate();
        $encuesta = Encuesta::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'habilitado' => 1
        ]);
        if (count($this->preguntas_id) > 0) {
            $encuesta->preguntas()->attach(
                $this->preguntas_id
            );
        }
        $this->preguntas_encuesta = new \Illuminate\Database\Eloquent\Collection;
        $this->limpiar();
        $this->dispatchBrowserEvent('encuestas'); 
    }

    public function limpiar() {
        $this->preguntas_encuesta = new \Illuminate\Database\Eloquent\Collection;
        $this->preguntas_id= [];
        $this->nombre = '';
        $this->descripcion = '';
        $this->texto_modal = "Crear Encuesta";
    }

    public function cancelar() {
        $this->limpiar();
        $this->editar = false;
    }

    public function editar(Encuesta $encuesta) {
        $this->texto_modal = "Actualizar Encuesta";
        $this->editar = true;
        $this->emit('preguntas', $encuesta->id);
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
        $auxiliar_collection = new \Illuminate\Database\Eloquent\Collection;
        foreach($lists as $list) {
            $id = (int)$list["value"];
            $this->preguntas_id[] = $id;
            if (!$this->editar) {
                foreach ($this->preguntas_encuesta as $pregunta) {
                    if ($id == $pregunta->id) {
                        $auxiliar_collection->add($pregunta);
                        break;
                    }
                }
            }
        }
        if ($this->editar) {
            $this->encuestaEditable->preguntas()->detach();
            $this->encuestaEditable->preguntas()->attach(
                $this->preguntas_id
            );
            $this->preguntas_encuesta = Encuesta::find($this->encuestaEditable->id)->preguntas;
        } else {
            $this->preguntas_encuesta = $auxiliar_collection;
        }
    }

    public function add($id) {
        if ($this->editar) {
            $this->encuestaEditable->preguntas()->attach(
                [$id]
            );
            $this->preguntas_encuesta = Encuesta::find($this->encuestaEditable->id)->preguntas;
        } else {
            $this->preguntas_encuesta->add(Pregunta::find($id));
            $this->preguntas_id[] = $id;
        }
    }

    public function activar() {
        $this->dispatchBrowserEvent('popover-activar');
    }

    public function quitar($id) {
        if ($this->editar) {
            $this->encuestaEditable->preguntas()->detach(
                [$id]
            );
            $this->preguntas_encuesta = Encuesta::find($this->encuestaEditable->id)->preguntas;
        } else {
            $indice = -1;
            foreach ($this->preguntas_encuesta as $key => $pregunta) {
                if ($id == $pregunta->id) {
                    $indice = $key;
                    break;
                }
            }
            if ($indice > -1) {
                $this->preguntas_encuesta->pull($indice);
                $this->preguntas_id = array_filter($this->preguntas_id, function($valor) use ($id) {
                    return $valor != $id;
                });
            }
        }
    }

    public function verEncuesta(Encuesta $encuesta) {
        $this->texto_modal = "Ver Encuesta";
        $this->encuesta_ver = $encuesta;
    }
}
