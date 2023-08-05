<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
class Encuesta extends Model
{
    use HasFactory;

    public function preguntas() {
        return $this->belongsToMany(Pregunta::class)->orderByPivot('id');
    }
    protected $fillable = ['nombre', 'descripcion','habilitado', 'user_id'];
}
