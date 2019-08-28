<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VistaProductoController extends Controller
{
    public function obtenerCategoriaId($idcate){
        $idcate = $idcate;
        return view("vistaproductos",compact("idcate"));
    }
}
