<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galery extends Model
{
    use HasFactory;

    protected $fillable=['name','description','file_path'];

/**creo la funcion de relacion con el team */

public function team():BelongsTo
{

    return $this->belongsTo(Team::class);
}

    
}
