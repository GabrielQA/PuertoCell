@extends("layouts.header")

@section("content")
    <?php
        //this is gonna get the conexion from the database 
        $conexion = new PDO("mysql:host=localhost;dbname=secondproject","root",""); 

        //this is bringing the information from the user
        $sql = "SELECT id FROM users WHERE email = :correo;";
        $info2 = $conexion->prepare($sql); 
        $info2->execute(array(':correo' => session()->get('clientesession')));
        $id = $info2->fetch();

        //this is bringing the information from the user
        $sql = "SELECT * FROM compras WHERE id_cliente = :id ORDER BY id DESC;";
        $info2 = $conexion->prepare($sql); 
        $info2->execute(array(':id' => $id["id"]));
        $cliente = $info2->fetchAll();
    
    ?>

    <title>Informe de Compras - KevinShop</title>
    <!-- this is gonna contain the information from the database about sales -->
    <div class="container">

        <main>
            <table>
                <thead>
                    <tr>
                        <th>Fecha de Compra</th>
                        <th>Total de la Orden</th>
                        <th>Items</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($cliente as $ventas):?>
                        <tr>
                            <td><?php echo $ventas["fecha"];?></td>
                            <td>$ <?php echo $ventas["cantidad"];?></td>
                            <td><a href="items/obteneridVenta/<?php echo $ventas["id"];?>">Ver Más<i class="material-icons left">more_vert</i></a></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </main>
    
    </div>

@endsection