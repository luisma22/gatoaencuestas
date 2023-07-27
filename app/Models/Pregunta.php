<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
class Pregunta extends Model
{
    use HasFactory;

    public function encuesta() {
        return $this->belongsTo(Encuesta::class);
    }
}
