<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;
    protected $fillable=['name','slug'];

    /**defines la relacion que hay entre los "hijos" del teniente para que lo sepa buscar
     * convencion: el nombre del modelo pero en plural
     */
    public function patients():HasMany
    {
        return $this->hasMany(Patient::class);
    }

     public function owners():HasMany
     {
         return $this->hasMany(Owner::class);
     }

    public function veterinaries():HasMany
    {
        return $this->hasMany(Veterinary::class);
    }
    /**Ahora definimos la relacion que hay con el registro del equipo */
    public function members():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**creo el metodo de realcion con la galeria */
    public function galeries():HasMany
    {
        return $this->hasMany(Galery::class);
    
}

    /**creo el metodo de realcion con la galeria */
    public function galeriaMultiples():HasMany
    {
        return $this->hasMany(GaleriaMultiple::class);
    
}
}