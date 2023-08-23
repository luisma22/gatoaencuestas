<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\Relations\hasMany;
class Encuesta extends Model
{
    use HasFactory;

    public function preguntas() {
        return $this->belongsToMany(Pregunta::class)->orderByPivot('id');
    }

    public function encuestados() {
        return $this->hasMany(Encuestados::class);
    }
    protected $fillable = ['nombre', 'descripcion','habilitado', 'user_id', 'opciones', 'forma', 'habilitar'];
}
