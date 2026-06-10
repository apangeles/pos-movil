<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    /*
        Solo se agrega
            $table,
            $primaryKey,
            $incrementing,
            $keyType
        cuando el nobre de la clase no coincida con el nombre de la tabla
    */
    protected $table = 'unidades';
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $filable = [
        'codigo',
        'descripcion',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'unidad_codigo', 'codigo');
    }
}
