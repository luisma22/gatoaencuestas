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
    public function mount() {
    }
    public function render()
    {
        $this->encuestas = Encuesta::orderBy('id', 'desc')->get();
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
        //session()->flash('message','Profile successfully updated.');
    }

    public function eliminar(Encuesta $encuesta) {
        $encuesta->delete();
        $this->limpiar();
    }
    public function rules()
    { 
        return [
            'nombre' => 'required|min:12',
            'descripcion' => 'required|min:12'
        ];
    }
    
}
