<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Encuesta;
use App\Models\Encuestados;
use Illuminate\Support\Facades\DB;

class EncuestadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preguntas = Encuesta::find(2)->preguntas;
        
        for ($i=1; $i <= 100; $i++) { 
            $encuesta_completa = $this->llenarEncuestaParametros($preguntas);
            $id = Encuestados::create([
                'respuestas' => json_encode($encuesta_completa),
                'encuesta_id' => 2
            ]);
        }
    }

    function llenarEncuestaParametros($preguntas) {
        $encuesta_completa = [];
        $sino = ['Si', 'No'];
        $preg = [4,5,10];
        foreach ($preguntas as $pregunta) {
            if ($pregunta->tipo == 1) {
                if ($pregunta->id == 12 || $pregunta->id == 14 || $pregunta->id == 16) {
                    $encuesta_completa[$pregunta->id] = ["Si", "tipo" => $pregunta->tipo];
                } else {
                    $encuesta_completa[$pregunta->id] = [$sino[rand(0,1)], "tipo" => $pregunta->tipo];
                }
            } else {
                $encuesta_completa[$pregunta->id] = [];
                $random = 1;
                $seleccion = 0;
                $pregunta_decode = json_decode($pregunta->opciones);
                $cantidad = count($pregunta_decode) - 1;
                foreach ($pregunta_decode as $key => $valor) {
                    $encuesta_completa[$pregunta->id][] = '';
                }
                if (in_array($pregunta->id, $preg)) {
                    $seleccion = rand(0,$cantidad);
                    $encuesta_completa[$pregunta->id][$seleccion] = $pregunta_decode[$seleccion];
                } else {
                    $existe = [];
                    $seleccion = 0;
                    $repeticiones = rand(7,$cantidad);
                    for ($i=1; $i <= $repeticiones; $i++) { 
                        $seleccion = rand(0, $cantidad);
                        if (!in_array($seleccion, $existe)) {
                            $encuesta_completa[$pregunta->id][$seleccion] = $pregunta_decode[$seleccion];
                        } else {
                            $i--;
                        }
                    }
                }
                $encuesta_completa[$pregunta->id]['tipo'] = $pregunta->tipo;
            }
        }
        return $encuesta_completa;
    }
}
