<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Owner extends Model
{
    use HasFactory;

    public function patients():HasMany
    {
        return $this->hasMany(Patient::class);
    }

    /**Tienes que definir la relacion del team en todos los modelos  */
    public function team():BelongsTo{
        return $this->belongsTo(Team::class);
    }
}
