@extends("layouts.header")

@section("content")

    <title>Cliente</title>

    <!--- here we are getting the data --->
    <?php
        //this is gonna get the conexion from the database 
        $conexion = new PDO("mysql:host=localhost;dbname=secondproject","root",""); 

        //this is gonna bring all the products
        $sql = "SELECT id_producto,id_categoria,img FROM productos LIMIT 5";
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $prod = $info2->fetchAll();


        //this is for the pagination
        $pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;
        $inicio = ($pagina > 1) ? ($pagina * 4 - 4) :  0;

        //this gonna bring all the categories
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM categorias LIMIT $inicio, 4";
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $cate = $info2->fetchAll(); 
        
        if(!$cate){
            header("Location: cliente.php");
        }

        //this is bringing the total of categories
        $totalcate = $conexion->query("SELECT FOUND_ROWS() AS total");
        $totalcate = $totalcate->fetch()["total"];
        $numeropaginas = ceil($totalcate / 4);

        //this is bringing the information from the user
        $sql = "SELECT nombre,id FROM users WHERE email = :cliente;";
        $info2 = $conexion->prepare($sql); 
        $info2->execute(array(':cliente' => session()->get('clientesession')));
        $id = $info2->fetch();


        //ID'S USER
        $iduser = $id["id"];

        //this is bringing the information from the user
        $sql = "SELECT COUNT(v.id_cliente) AS cantidad, SUM(p.precio) AS total FROM productos AS p INNER JOIN compras AS v ON v.id_producto =p.id_producto WHERE v.id_cliente = '$iduser'";
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $info = $info2->fetch();    

        //this is establishing the points on the chart
        $dataPoints = array(
            array("label"=> "Cantidad de Compras: " . $info["cantidad"], "y"=> $info["cantidad"]),
            array("label"=> "Monto Total de Compras: " . $info["total"], "y"=> $info["total"]),
        );
            
    ?>

    <!--- here we are creating and filling up the data to the chart --->
    <script>
        $(window).on('load',function(){
            $('.modal').modal(); 
            $('#modal1').modal('open');
            if(!localStorage.getItem("#modal1")){    
                $('.modal').modal(); 
                $('#modal1').modal("open");
                localStorage.setItem("#modal1","true");
            }
            var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Compras de <?php echo $id["nombre"];?>"
            },
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "฿#,##0",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>,
            }]
        });
        chart.render();
        
        });

    </script>
</head>

<body>

    <!-- this is gonna create the animations -->  
    <style>

        .container main .most .dere{
            animation: go 3s linear 2s infinite alternate;
        }
        .container main .most .izqui{
            animation: go 3s linear 2s infinite alternate;
        }

    </style>
    
    <!-- this is gonna contain the information of the page -->
    <div class="container">
        <main>
            <div class="titulo">
                <h3>Algunos Productos</h3>
            </div>
            <!-- Traer las imagenes mas vendidas de la base de datos -->
            <div class="most">
            <h5><i class="material-icons dere">arrow_forward</i> Desliza <i class="material-icons izqui">arrow_back</i></h5>

                <div class="carousel">
                    
                    <?php foreach($prod as $productos):?>
                        <a class="carousel-item" href="/productosingle/obtenerProductoId/<?php echo $productos["id_producto"];?>/<?php echo $productos["id_categoria"];?>"><img src="../../img/<?php echo $productos['img'];?>"></a>
                    <?php endforeach;?>
                </div>
            </div>
        </main>

        <section>
            <div class="titulo_cate">
                <h4>Categorias</h4>
            </div>
            
            <div class="categorias">

                <div class="row">

                    <?php foreach($cate as $categoria):?>
                        <div class="col s3 m3">
                            <div class="card blue-grey darken-1">
                                <a href="/vistaproductos/obtenerCategoriaId/<?php echo $categoria["id"];?>" class="btn-floating btn-large halfway-fab waves-effect waves-light red"><i class="material-icons">more_vert</i></a>
                                <div class="card-content white-text">
                                <h2 class="card-title">Categoria: <?php echo $categoria["categoria"];?></h2>
                                <p><?php echo $categoria["descri"];?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>

                </div>

            </div>

            <ul class="pagination">
        
                <?php if($pagina == 1): ?>
                    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                <?php else: ?>
                    <li><a href="?pagina=<?php echo $pagina - 1;?>"><i class="material-icons">chevron_left</i></a></li>
                <?php endif;?>

                <?php 
                
                    for($i = 1; $i <= $numeropaginas; $i++){
                        if($pagina == $i){    
                            echo "<li class='active'><a href='?pagina=$i'>$i</a></li>";
                        }else{
                            echo "<li class='waves-effect'><a href='?pagina=$i'>$i</a></li>";
                        }
                    }
                
                ?>

                <?php if($pagina == $numeropaginas):?>
                    <li class="disabled"><a href="#"><i class="material-icons">chevron_right</i></a></li>
                <?php else:?>
                    <li><a href="?pagina=<?php echo $pagina + 1;?>"><i class="material-icons">chevron_right</i></a></li>
                <?php endif;?>

            </ul>
            <br>
            <br>
            
        </section>
    </div>

    <!-- this is gonna contain the footer of the page-->
    <footer class="page-footer teal lighten-2">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Información de la Tienda</h5>
                    <p class="grey-text text-lighten-4">PuertoCell  <br> Tel: Numero Puerto Cell <br> Email: PuertoCell@gmail.com</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Visita Nuestras Redes sociales</h5>
                    <ul>
                    <li><a class="grey-text text-lighten-3" href="https://www.facebook.com/PuertoCel/">Facebook <i class="fab fa-facebook-square"></i></a> </li>
                    <li><a class="grey-text text-lighten-3" href="#!">Instagram <i class="fab fa-instagram"></i></a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Twitter <i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                © 2018 Copyright Kevin Shop
            </div>
        </div>
    </footer>

      <!-- Modal Structure -->
    <div id="modal1" class="modal show">
        <div class="modal-content">
        <h4>Datos de <?php echo $id["nombre"];?></h4>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
        <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Deacuerdo</a>
        </div>
    </div>
    <!-- this is gonna calling the principals functions of the chart -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


@endsection