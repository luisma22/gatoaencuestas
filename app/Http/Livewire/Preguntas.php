<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Pregunta;

class Preguntas extends Component
{
    public $preguntas = [];
    public $search = '';
    public $texto_modal = "Crear Pregunta";
    public $editar = false;
    public $pregunta = '';
    public $tipo = 1;
    public $preguntaEditable;
    public $vertodo = false;
    public $preguntas_opciones = ['', '',''];
    public $todaslaspreguntas = [];
    public $opciones_id = [];
    protected $listeners = ["quitar_vox" => "quitar_vox"];
    public $vozactivada = false;
    public $estilo_microfono = "-dark";
    public $seleccionado = "";
    
    public function render()
    {
        if($this->vertodo) {
            $this->preguntas = Pregunta::orderBy('id', 'desc')->where('pregunta','LIKE', '%'. $this->search.'%')->where('user_id', auth()->user()->id)->get();
        } else {
            $this->preguntas = Pregunta::orderBy('id', 'desc')->where('pregunta','LIKE', '%'. $this->search.'%')->where('habilitado', 1)->where('user_id', auth()->user()->id)->get();
        }
        $this->dispatchBrowserEvent('popoverremove'); 
        return view('livewire.preguntas');
    }

    public function crear() {
        $this->validate();
        if ($this->tipo == 1 || $this->tipo == 2) {
            $this->preguntas_opciones = [];
        }
        $pregunta = Pregunta::create([
            'pregunta' => $this->pregunta,
            'tipo' => $this->tipo,
            'habilitado' => 1,
            'opciones' => json_encode($this->preguntas_opciones),
            'user_id' => auth()->user()->id
        ]);
        $this->limpiar();
        $this->dispatchBrowserEvent('preguntas', 'creada'); 
    }

    public function limpiar() {
        $this->preguntas_opciones = ['', '',''];
        $this->opciones_id= [];
        $this->pregunta = '';
        $this->tipo = 1;
        $this->dispatchBrowserEvent('voz_disabled');
        $this->texto_modal = "Crear Pregunta";
        $this->estilo_microfono = "-dark";
        $this->vozactivada = false;
    }

    public function cancelar() {
        $this->limpiar();
        $this->editar = false;
    }

    public function editar(Pregunta $pregunta) {
        $this->texto_modal = "Actualizar Pregunta";
        $this->editar = true;
        $this->preguntaEditable = $pregunta;
        $this->pregunta = $pregunta->pregunta;
        $this->tipo = $pregunta->tipo;
        $this->preguntas_opciones = json_decode($pregunta->opciones);
        $this->opciones_id = [];
    }

    public function actualizar() {
        $this->validate();
        $this->preguntaEditable->pregunta = $this->pregunta;
        $this->preguntaEditable->tipo = $this->tipo;
        $this->preguntaEditable->opciones = json_encode($this->preguntas_opciones);
        $this->preguntaEditable->save();
        $this->cancelar();
        $this->limpiar();
        $this->dispatchBrowserEvent('preguntas', 'actualizada'); 
    }

    public function quitar($id) {
        $this->preguntas_opciones = array_filter($this->preguntas_opciones, function($valor) use ($id) {
            return $valor != $id;
        }, ARRAY_FILTER_USE_KEY);
    }

    public function updateTaskOrder($lists) {
        $auxiliar_collection = [];
        foreach($lists as $list) {
            $id = (int)$list["value"];
            foreach ($this->preguntas_opciones as $key => $pregunta) {
                if ($id == $key) {
                    $auxiliar_collection[] = $pregunta;
                    break;
                }
            }
        }
        $this->preguntas_opciones = $auxiliar_collection;
    }

    public function rules()
    { 
        return [
            'pregunta' => 'required|min:12'
        ];
    }

    public function add() {
        $this->preguntas_opciones[] = "";
    }

    public function eliminar(Pregunta $pregunta) {
        $pregunta->habilitado = 0;
        $pregunta->save();
        $this->dispatchBrowserEvent('eliminar', 'pregunta'); 
    }

    public function restaurar(Pregunta $pregunta) {
        $pregunta->habilitado = 1;
        $pregunta->save();
        $this->dispatchBrowserEvent('restaurar', 'pregunta'); 
    }

    public function ver() {
        $this->vertodo = !$this->vertodo;
    }

    public function voz() {
        if (!$this->vozactivada) {
            $this->estilo_microfono = "-danger";
            $this->dispatchBrowserEvent('voz');
            $this->vozactivada = true;
        }
    }

    public function quitar_vox($texto) {
        $this->estilo_microfono = "-dark";
        $this->vozactivada = false;
        if (strpos($this->seleccionado, '.') === false) {
            $variable = $this->seleccionado;
            $this->$variable = $texto;
        } else {
            $opciones = explode(".", $this->seleccionado);
            $variable = $opciones[0];
            $this->$variable[intval($opciones[1])] = $texto;
        }
    }

    public function seleccionar($seleccionado) {
        $this->seleccionado = $seleccionado;
    }
}
