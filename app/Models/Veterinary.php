<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Veterinary extends Model
{
    use HasFactory;

     /**Definimos la relacion que tiene este modelo con el equipo/tenant */
     public function team():BelongsTo{
        return $this->belongsTo(Team::class);
    }
}
