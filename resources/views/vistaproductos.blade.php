@extends("layouts.header")

@section("content")

    <?php     
    //Here we get the category's id    
    $idcate = $idcate;

    //this is gonna get the conexion from the database 
    $conexion = new PDO("mysql:host=localhost;dbname=secondproject","root",""); 

    //this is bringing the information from the products related to the category
    $sql = "SELECT * FROM productos WHERE id_categoria = :cate AND stock > 0;";
    $info2 = $conexion->prepare($sql); 
    $info2->execute(array(':cate' => $idcate));
    $info = $info2->fetchAll();
    ?>

    <!-- this is gonna contain the main from the page where you can see the products of each category -->
    <main style="text-align:center;">
        <h2>Productos</h2>
            <div class="row">
                <?php foreach($info as $producto):?>
                        <div class="col s12 m2">
                            <div class="card">
                            <div class="card-image">
                                <img src="../../img/<?php echo $producto['img']?>" height = "200">
                                <span class="card-title">Producto: <?php echo $producto['nombre'];?></span>
                                <a href="/productosingle/obtenerProductoId/<?php echo $producto["id_producto"];?>/<?php echo $producto["id_categoria"];?>" class="btn-floating halfway-fab waves-effect waves-light red" title = "Ver detalles"><i class="material-icons">add</i></a>
                            </div>
                            </div>
                        </div>
                <?php endforeach;?>
            </div>
        </main>

@endsection