<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta;
use PDF;

class Encuestapdf extends Component
{
    protected $queryString = ['id'];

    public function render()
    {
        return view('livewire.encuestapdf');
    }

    public function pdf($id) {
        $encuesta = Encuesta::find($id);
        $pdf = PDF::loadView('livewire.encuestapdf', ['encuesta' => $encuesta]);
        return $pdf->download('invoice.pdf');
    }
}
