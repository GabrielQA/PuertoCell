<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'id','id_producto', 'nombre','descripcion','img','id_categoria','stock','precio',
    ];

}
