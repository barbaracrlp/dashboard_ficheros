<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class MoneyCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key,$value, array $attributes): float
    {

        //transformo el int de la DB en un float

        return round(floatval($value)/100,precision:2);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key,$value, array $attributes): float
    {
        //transformo el float a un integer para poder guardarlo en la DB
        return round(floatval($value)*100);
    }
}
