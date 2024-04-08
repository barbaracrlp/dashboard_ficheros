<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GaleriaMultiple extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'files'];

    /**Hay qie agregar el cast definiendo que los 'files' son un array
     * para que cambie a json y lo guarde como toca en la base de datos
     * con los casts se puede transformar lo que se sube con el formulario a difrerentes
     * tipos
     */

    protected $casts=[
        'files'=>'array',
    ];




    /**agregue la funcio teams per a poder fer un recurs en el panel 2, sense necesitat de
     * gastar el admin per a tot
     */
    public function team(): BelongsTo
    {

        return $this->belongsTo(Team::class);
    }
}
