<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $fillable = [
        'id','id_cliente', 'id_producto','cantidad','precio',
    ];
}
