<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compras;
use Carbon\Carbon;
use PDO;

class CompraController extends Controller
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

        //this is gonna bring all the categories from the database
        $idlista = $request->input('idlista');
        $sql = "DELETE FROM listas WHERE id = '$idlista';";
        $conexion->query($sql);

        //this is gonna have the id product
        $idpro = $request->input("idpro");
        
        //this is gonna have the quantity of the product sold
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

        //this is gonna get the date
        $mytime = Carbon::now();
        $compra = new Compras();
       
        //this is gonna save the information
        $compra->id_producto = $idpro;
        $compra->id_cliente = $request->input("iduser");
        $compra->fecha = $mytime;
        $compra->total = $request->input("preciototal");
        $compra->cantidad = $cantidad;
        $compra->save();
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
        //
    }
}
