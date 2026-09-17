<?php

namespace App\Http\Livewire\Encuesta;

use Livewire\Component;
use App\Models\Pregunta;
class Preguntas extends Component
{
    public $todaslaspreguntas = [];
    public $search = '';
    public $encuesta_preguntas_ids = [];
    protected $listeners = ['quitaritem' => 'quitaritem'];
    public function render()
    {
        if ($this->encuesta_preguntas_ids) {
            $this->todaslaspreguntas = Pregunta::orderBy('id', 'desc')->where('pregunta','LIKE', '%'. $this->search.'%')->where('user_id', auth()->user()->id)->whereNotIn('id', $this->encuesta_preguntas_ids)->get();
        } else {
            $this->todaslaspreguntas = Pregunta::orderBy('id', 'desc')->where('pregunta','LIKE', '%'. $this->search.'%')->where('user_id', auth()->user()->id)->get();        
        }
        $this->dispatchBrowserEvent('popoverremove'); 
        return view('livewire.encuesta.preguntas');
    }
    
    public function add($id) {
        $this->search = '';
        $this->encuesta_preguntas_ids[] = $id;
        $this->emit('add', $id);
    }

    public function quitaritem($id) {
        if (in_array($id, $this->encuesta_preguntas_ids)) {
            $this->encuesta_preguntas_ids = array_filter($this->encuesta_preguntas_ids, function ($value) use ($id) {
                return $value != $id;
            });
        }
    }
}
