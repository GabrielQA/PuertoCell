<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina Administrador</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script type="text/javascript"
        src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../css/cliente.css">    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../js/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">

    <?php
        //this is gonna get the conexion from the database 
        $conexion = new PDO("mysql:host=localhost;dbname=secondproject","root","");

        //this is gonna bring the count of users registered
        $sql = "SELECT count(*) AS cuenta FROM users;";
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $info = $info2->fetch();
        $usuarios = $info["cuenta"];

        //this is gonna bring the count of sales registered
        $sql = "SELECT count(*) AS cuenta FROM compras;";
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $info = $info2->fetch();
        $ventas = $info["cuenta"];

        //this is gonna bring the sum of sales registered
        $sql = "SELECT SUM(total) AS total FROM compras AS v INNER JOIN productos AS p ON p.id_producto = v.id_producto;";
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $info = $info2->fetch();
        $total = $info["total"];

        $dataPoints = array(
            array("label"=> "Cantidad de Clientes Registrados: " . $usuarios, "y"=> $usuarios),
            array("label"=> "Cantidad de Productos Vendidos: " . $ventas, "y"=> $ventas),
            array("label"=> "Monto total de Ventas: $" . $total, "y"=> $total),
        );
        
    ?>
    <script>
        //this is gonna fill the chart with information
        window.onload = function () {
        
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            title:{
                text: "Estadisticas del Administrador"
            },
            subtitles: [{
                text: "Usuarios de la tienda en ONlINE"
            }],
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "฿#,##0",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    
        }
    </script>

</head>
<body>

    <header>
        <nav>
            <div class="nav-wrapper">
            <a href="#" class="brand-logo">Pagina Administrador</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/producto">Productos</a></li>
                <li><a href="/categoria">Categorias</a></li>
                <li><a href="cerrar">Cerrar Sesión</a></li>
            </ul>
            </div>
        </nav>
    </header>

    <div class="container">
        <div id="chartContainer" style="height: 450px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </div>

</body>
</html>