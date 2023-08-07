<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuestados extends Model
{
    use HasFactory;
    protected $fillable = ['respuestas', 'encuesta_id'];
    public function encuesta() {
        return $this->belongsTo(Encuesta::class);
    }
}
