<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use PDO;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view("categorias",compact("categorias"));
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

        $idcate = $request->input("cate");

        //this is bringing the stock from the product
        $sql = "SELECT categoria FROM categorias WHERE categoria = '$idcate';";
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $stock = $info2->fetch();

        if($stock["categoria"] !== false || $stock["categoria"]  !== null){
            $categoria = new Categoria();
            $categoria->categoria = $idcate;
            $categoria->descri = $request->input('des');
            $categoria->save();
            return redirect("categoria");
        }else{
            
        }
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
        $categorias = Categoria::find($id);
        return view("modifycategory",compact("categorias"));
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
        $categorias = Categoria::find($id);
        $categorias->fill($request->all());
        $categorias->save();

        return redirect("/categoria");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorias = Categoria::find($id);
        $categorias->delete();
        
        return redirect("/categoria");
    }
}
