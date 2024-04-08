<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Treatment extends Model
{
    use HasFactory;

    protected $casts=[
        'price'=> MoneyCast::class,
    ];
//definir las relaciones entre modelos
//un tto pertenece a un paciente
    public function patient():BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
