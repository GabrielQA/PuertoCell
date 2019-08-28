@extends("layouts.header")

@section("content")

    @php
    
    //this is gonna get the conexion from the database 
    $conexion = new PDO("mysql:host=localhost;dbname=secondproject","root",""); 
        
    //this is gonna get the id's sales
    $idventa = $idventa;

    //this is bringing the information from the sales
    $sql = "SELECT * FROM compras WHERE id = :id;";
    $info2 = $conexion->prepare($sql); 
    $info2->execute(array(':id' => $idventa));
    $venta = $info2->fetch();
        
    //this is bringing the information from the product
    $sql = "SELECT * FROM productos WHERE id_producto = :id;";
    $info = $conexion->prepare($sql); 
    $info->execute(array(':id' => $venta["id_producto"]));
    $producto = $info->fetch();

    //this is gonna get the description of the product
    $sql = "SELECT descripcion FROM productos WHERE id_producto = :id;";
    $info = $conexion->prepare($sql); 
    $info->execute(array(':id' => $venta["id_producto"]));
    $descri = $info->fetch();
    @endphp

    <!-- this is gonna take the page back -->
    <section>
        <a href="/vercompras" style="border-radius: 25px; margin-top:10px;" class="btn"><i class="material-icons">arrow_back</i></a>
    </section>

    <!-- this is gonna contain the sales of the customer -->
    <div class="container">

        <main>
            <table>
                <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><?php echo $venta["total"];?></td>
                        <td><?php echo $descri["descripcion"];?></td>
                        <td><?php echo $producto["precio"];?></td>
                    </tr>
                </tbody>
            </table>
        </main>

    </div>

@endsection