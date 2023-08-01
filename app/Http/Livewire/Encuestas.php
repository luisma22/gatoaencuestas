<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;

class Encuestas extends Component
{
    public $nombre;
    public $descripcion;
    public $editar = false;
    public $encuestaEditable;
    public $texto_modal = "Crear Encuesta";
    public $vertodo= false;
    public function mount() {
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
        Encuesta::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'habilitado' => 1
        ]);
        $this->limpiar();
        $this->dispatchBrowserEvent('encuestas'); 
    }

    public function limpiar() {
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
}
