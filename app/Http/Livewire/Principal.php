<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;

class Principal extends Component
{
    public $eid = 0;
    public function render()
    {
        $encuesta = Encuesta::orderBy('id', 'desc')->where('user_id', auth()->user()->id)->get();
        $this->eid = $encuesta[0]->id;
        return view('livewire.principal');
    }
}
