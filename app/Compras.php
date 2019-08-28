<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $fillable = [
        'id','id_producto', 'id_cliente','fecha','total','cantidad',
    ];
}
