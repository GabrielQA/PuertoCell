<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoSingleController extends Controller
{
    public function obtenerProductoId($idpro,$idcate){
        $idpro = $idpro;
        $idcate = $idcate;
        return view("productosingle")->with('idpro',$idpro)->with('idcate',$idcate);
    }
}
