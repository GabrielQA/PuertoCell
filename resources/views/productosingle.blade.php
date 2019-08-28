@extends("layouts.header")

@section("content")

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- this is gonna call the page's css -->
    <link rel="stylesheet" href="../../../css/cliente.css">    
    <link rel="stylesheet" href="../../../css/productosingle.css">

    <title>Detalles - Producto</title>
</head>
    <?php 
        //this is gonna get the conexion from the database 
        $conexion = new PDO("mysql:host=localhost;dbname=secondproject","root",""); 

        //this is bringing the information from the user
        $sql = "SELECT nombre,id FROM users WHERE email = :cliente;";
        $info2 = $conexion->prepare($sql); 
        $info2->execute(array(':cliente' => session()->get('clientesession')));
        $id = $info2->fetch();

        //here we are getting the idproduct
        $idpro = $idpro;
        //here we get the category's ID
        $idcate = $idcate;
        //here we are getting the specific product
        $sql = "SELECT * FROM productos WHERE id_producto = :pro;";
        $info2 = $conexion->prepare($sql);
        $info2->execute(array(':pro' => $idpro));
        $info = $info2->fetch();

    ?>
    <script>
    //this is gonna establish the price according to the quantity
        function myFunction() {
            document.getElementById("preciototal").value = document.getElementById("total").value * <?php echo $info["precio"];?>;
        }
    </script>

    <script>
        $(document).ready(function(){
            $('.materialboxed').materialbox();
        });
    </script>

<body>  



    <a href="/vistaproductos/obtenerCategoriaId/<?php echo $idcate;?>" style="border-radius: 25px; width:5%; margin-top:10px;" title="Regresar" class="btn"><i class="material-icons">arrow_back</i></a>
    

    <main style ="text-align:center; width=100%;">
        <div class="container"> 
            <form action="/lista" method="POST">
                @csrf
                <h2>Producto - <?php echo $info["nombre"];?></h2>

                <div class="img" style="text-align:center;">
                    <img src="../../../img/<?php echo $info["img"];?>" class="materialboxed" style="width:50%; margin:auto; border-radius:30px;" title="<?php echo $info["nombre"];?>">
                </div>

                <?php 
                    //this is gonna bring the category name
                    $sql = "SELECT categoria FROM categorias WHERE id = :cate;";
                    $info2 = $conexion->prepare($sql); 
                    $info2->execute(array(':cate' => $info["id_categoria"]));
                    $nombrecate = $info2->fetch();

                ?>

                <div class="descate">
                    <div class="descri">
                        <h4>Categoria</h4>
                        <p><?php echo $nombrecate["categoria"];?></p>
                    </div>

                    <div class="descri">
                        <h4>En Stock</h4>
                        <p><?php echo $info["stock"];?></p>
                    </div>

                    <div class="descri">
                        <h4>Descripcion</h4>
                        <p><?php echo $info["descripcion"];?></p>
                    </div>
                </div>

                <div class="stock">
                    <div class="descri">
                    <script>    
                         $(document).ready(function (){
                            $("input").keydown(function() {
                                return false
                            });
                        });
                    </script>
                        <h4>Cantidad</h4>
                        <input type="number" id = "total" oninput="myFunction()" name="cantidad" min="0" max="<?php echo $info["stock"];?>" placeholder="Cantidad">
                    </div>

                    <div class="descri">
                        <h4>Precio Producto</h4>
                        <p>$<?php echo $info["precio"];?></p>
                    </div>

                    <div class="descri">
                        <h4>Precio Total</h4>
                        <input type="number" placeholder = "Precio Total" name="preciototal" readOnly id="preciototal" >
                    </div>
                </div>
                <input type="hidden" name="idproducto" value = "<?php echo $info["id_producto"];?>">
                <input type="hidden" name="iduser" value = "<?php echo $id["id"];?>">
                <button type="submit" class = "btn" style="margin-bottom:15px;">Agregar Al carrito<i class = "material-icons">add_shopping_cart</i></button>
            </form>
        </div>
    </main>


</body>
</html>
@endsection