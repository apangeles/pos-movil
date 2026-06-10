<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AfectacionTipo extends Model
{
    /*
        Solo se agrega
            $table,
            $primaryKey,
            $incrementing,
            $keyType
        cuando el nobre de la clase no coincida con el nombre de la tabla
    */
    protected $table = 'afectacion_tipos';
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $keyType = 'string';

    //public $timestamp = false; // Solo en caso de que nos se use el campo timestamp

    public function productos()
    {
        return $this->hasMany(Producto::class, 'afectacion_tipo_codigo', 'codigo');
    }
}
