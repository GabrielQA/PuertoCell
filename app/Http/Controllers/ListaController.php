<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lista;
use PDO;

class ListaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //this is gonna get the conexion from the database 
        $conexion = new PDO("mysql:host=localhost;dbname=secondproject","root","");

        $lista = new Lista();
        $idpro = $request->input("idproducto");
        $cantidad = $request->input("cantidad");

        //this is bringing the stock from the product
        $sql = "SELECT stock FROM productos WHERE id_producto = '$idpro';";
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $stock = $info2->fetch();
        
        //this is getting the total of the rest
        $total = $stock["stock"] - $cantidad;

        //this is gonna update the quantity of products
        $sql = "UPDATE productos SET stock = '$total' WHERE id_producto = '$idpro';";
        $conexion->query($sql);     

        $lista->id_cliente = $request->input("iduser");
        $lista->id_producto = $idpro;
        $lista->cantidad = $cantidad;
        $lista->precio = $request->input("preciototal");
        $lista->save();
        return redirect("cliente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //this is gonna get the conexion from the database 
        $conexion = new PDO("mysql:host=localhost;dbname=secondproject","root","");

        //this is bringing the stock from the product
        $sql = "SELECT id_producto,cantidad FROM listas WHERE id = '$id';";
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $stock = $info2->fetch();

        $idpro = $stock["id_producto"];

        //this is gonna bring the quantity of products
        $sql = "SELECT stock FROM productos WHERE id_producto = '$idpro';";
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $stockproducto = $info2->fetch();

        //this is getting the total of the rest
        $total = $stock["cantidad"] + $stockproducto["stock"];

        //this is gonna update the quantity of products
        $sql = "UPDATE productos SET stock = '$total' WHERE id_producto = '$idpro';";
        $conexion->query($sql); 

        $lista = Lista::find($id);
        $lista->delete();
        
        return redirect("cliente");
    }
}
