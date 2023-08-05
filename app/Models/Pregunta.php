<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
class Pregunta extends Model
{
    use HasFactory;

    public function encuestas() {
        return $this->belongsToMany(Encuesta::class);
    }
    protected $fillable = ['id', 'pregunta','tipo', 'opciones', 'habilitado', 'user_id'];
}
