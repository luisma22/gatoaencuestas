<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;
use App\Models\Pregunta;
use Illuminate\Support\Collection;

class Encuestas extends Component
{
    public $nombre = '';
    public $descripcion = '';
    public $editar = false;
    public $encuestaEditable;
    public $texto_modal = "Crear Encuesta";
    public $vertodo = false;
    public $preguntas_encuesta = [];
    public $todaslaspreguntas = [];
    public $preguntas_id = [];
    public $tipos = [1 => "Si/No", 2 => "Multiple Seleccion", 3 => "Completado"];
    public $encuesta_ver;
    protected $listeners = ["add" => "add", "quitar_vox" => "quitar_vox", "confirmar_eliminacion" => "confirmar_eliminacion"];
    public $vozactivada = false;
    public $estilo_microfono = "-dark";
    public $seleccionado = "";
    public $canvasoff = false;
    public $texto_modal_off = "Modo Desplegable";
    public $encuesta_a_eliminar;
    public $colores_seleccionados = [0 => "#4b77a9", 1 => "#5f255f", 2 => "#5cd55f", 3 => "#5ab55f", 4 => "#2F8C00", 5 => "#2B39D9", 6 => "#D94100", 7 => "#8C2F07", 8 => "#7F7FDB", 9 => "#8F593D", 10 => "#368E8F", 11=> "#DBC653"];
    public $forma = "pie";
    public function mount() {
        $this->preguntas_encuesta = new \Illuminate\Database\Eloquent\Collection;
    }
    public function render()
    {
        if($this->vertodo) {
            $this->encuestas = Encuesta::orderBy('id', 'desc')->where('user_id', auth()->user()->id)->get();
        } else {
            $this->encuestas = Encuesta::orderBy('id', 'desc')->where('habilitado', 1)->where('user_id', auth()->user()->id)->get();
        }

        return view('livewire.encuestas');
    }

    public function crear() {
        $this->validate();
        $encuesta = Encuesta::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'habilitado' => 1,
            'user_id' => auth()->user()->id,
            'opciones' => json_encode($this->colores_seleccionados),
            'forma' => $this->forma,
            'habilitar' => false
        ]);
        if (count($this->preguntas_id) > 0) {
            $encuesta->preguntas()->attach(
                $this->preguntas_id
            );
        }
        $this->preguntas_encuesta = new \Illuminate\Database\Eloquent\Collection;
        $this->limpiar();
        $this->dispatchBrowserEvent('encuestas', 'creada'); 
    }

    public function limpiar() {
        $this->preguntas_encuesta = new \Illuminate\Database\Eloquent\Collection;
        $this->preguntas_id= [];
        $this->nombre = '';
        $this->descripcion = '';
        $this->texto_modal = "Crear Encuesta";
        $this->dispatchBrowserEvent('voz_disabled');
        $this->estilo_microfono = "-dark";
        $this->vozactivada = false;
        $this->forma = 'pie';
        $this->colores_seleccionados = [0 => "#4b77a9", 1 => "#5f255f", 2 => "#5cd55f", 3 => "#5ab55f", 4 => "#2F8C00", 5 => "#2B39D9", 6 => "#D94100", 7 => "#8C2F07", 8 => "#7F7FDB", 9 => "#8F593D", 10 => "#368E8F", 11=> "#DBC653"];
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
        $this->forma = $encuesta->forma;
        $this->colores_seleccionados = [0 => "#4b77a9", 1 => "#5f255f", 2 => "#5cd55f", 3 => "#5ab55f", 4 => "#2F8C00", 5 => "#2B39D9", 6 => "#D94100", 7 => "#8C2F07", 8 => "#7F7FDB", 9 => "#8F593D", 10 => "#368E8F", 11=> "#DBC653"];
        if ($encuesta->opciones) {
            $this->colores_seleccionados = json_decode($encuesta->opciones);
        }
    }

    public function actualizar() {
        $this->validate();
        $this->encuestaEditable->nombre = $this->nombre;
        $this->encuestaEditable->descripcion = $this->descripcion;
        $this->encuestaEditable->opciones = json_encode($this->colores_seleccionados);
        $this->encuestaEditable->forma = $this->forma;
        $this->encuestaEditable->save();
        $this->emit('guardar_colores');
        $this->cancelar();
        $this->limpiar();
        $this->dispatchBrowserEvent('encuestas', 'actualizada'); 
    }

    public function eliminar(Encuesta $encuesta) {
        $encuesta->habilitado = 0;
        $encuesta->save();
        $this->dispatchBrowserEvent('eliminar', 'encuesta'); 
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
        $this->dispatchBrowserEvent('restaurar', 'encuesta'); 
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
        $this->texto_modal = "Diseño de la Encuesta";
        $this->encuesta_ver = $encuesta;
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

    public function iniciarEncuesta(Encuesta $encuesta) {
        return redirect()->route('encuestar', [$encuesta]);
    }

    public function estadisticas(Encuesta $encuesta) {
        return redirect()->route('estadisticas', [$encuesta]);
    }

    public function offormodal() {
        $this->canvasoff = !$this->canvasoff;
        if ($this->canvasoff) {
            $this->texto_modal_off = "Modo Modal";
        } else {
            $this->texto_modal_off = "Modo Desplegable";
        }
    }

    public function eliminarEncuestados(Encuesta $encuesta) {
        $this->encuesta_a_eliminar = $encuesta;
        $this->dispatchBrowserEvent('eliminar_encuestados'); 
    }

    public function confirmar_eliminacion() {
        $this->encuesta_a_eliminar->encuestados()->delete();
    }

    public function cambiarforma() {
        if ($this->forma == 'pie') {
            $this->forma = 'polarArea';
        } else {
            $this->forma = 'pie';
        }
    }

    public function habilitar(Encuesta $encuesta) {
        $encuesta->habilitar = !$encuesta->habilitar;
        $encuesta->save();
    }
}
