<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <script type="text/javascript"
        src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../../css/productos.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link rel="stylesheet" href="../../js/animate.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <title>CRUD Productos</title>
</head>
<body>

    <?php 

        $conexion = new PDO("mysql:host=localhost;dbname=secondproject","root","");

        $sql = "SELECT * FROM categorias";
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $catego = $info2->fetchAll();

        
        $sql = "SELECT categoria FROM categorias WHERE id =" . $producto->id_categoria;
        $info2 = $conexion->prepare($sql); 
        $info2->execute();
        $nombrecate = $info2->fetch();

    ?>
    <script>
            $(document).ready(function(){
            $('select').formSelect();
        });
    </script>
    <style>
        header .nave{
            width: 100%;
            font-family: 'Indie Flower', cursive;
            background: cornflowerblue;
            font-size: 30px;
            color: #f2f2f2;
            display: inline-block;
            text-align: center;
        }
    </style>

    <!-- this is gonna call the header page and containing the divs of the page -->
    <header>   

        <div class="nave">
            <h1>Modificar Producto</h1>
        </div>
        <a href="/producto" style="border-radius: 25px;" class="btn"><i class="material-icons">arrow_back</i></a>
        <div id="crear" class="city wow slideInLeft">
            <h2>Modifica el Producto: {{ $producto->nombre }}</h2>

            <div class="row">
                <form class="col s12" method="POST" action="/producto/{{$producto->id}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row">

                    <div class="input-field col s3">
                    <i class="material-icons prefix">label</i>
                    <input id="icon_prefix" type="text" class="validate" name="sku" value="{{ $producto->id_producto }}" required>
                    <label for="icon_prefix">SKU</label>
                    </div>

                    <div class="input-field col s6">
                    <i class="material-icons prefix">dvr</i>
                    <input id="icon_prefix" type="text" class="validate" name="producto" value="{{ $producto->nombre }}" required>
                    <label for="icon_prefix">Nombre del Producto</label>
                    </div>
                    
                    <div class="input-field col s3">
                    <i class="material-icons prefix">attach_money</i>
                    <input id="icon_prefix" type="number" class="validate" name="precio" value="{{ $producto->precio }}" required>
                    <label for="icon_prefix">Precio</label>
                    </div>
                    <div class="input-field col s8">
                        <select name="categoria">
                        <option value="" disabled selected>Seleccione una Categoria</option>
                        <?php foreach($catego as $cate):?>
                            
                            <?php echo "<option value=" . $cate['id'] . ">" . $cate['categoria'] . "</option> ";?>

                        <?php endforeach;?>
                        </select>
                        <label>Categorias</label>
                    </div>
                    <div class="input-field col s4">
                        <input type="text" disabled value="<?php echo $nombrecate["categoria"]?>">
                        <input type="hidden" name="oldcate" value="{{$producto->id_categoria}}">
                    </div>
                    <div class="input-field col s9">
                    <i class="material-icons prefix">description</i>
                    <textarea id="textarea1" class="materialize-textarea" name="des" required>{{ $producto->descripcion }}</textarea>
                    <label for="textarea1">Descripcion del Producto</label>
                    </div>

                    <div class="input-field col s3">
                    <i class="material-icons prefix">exposure_plus_1</i>
                    <input id="icon_prefix" type="number" class="validate" name="stock" value="{{ $producto->stock }}" required>
                    <label for="icon_prefix">Stock</label>
                    </div>
                    <input type="hidden" name="oldimg" value="{{ $producto->img }}">
                    <div class="input-field col s12">
                    <i class="material-icons prefix">burst_mode</i>
                    <input id="icon_prefix" type="file" class="validate" name="img">
                    </div>
                </div>
                <div class="error" style="color: red; font-size: 20px;">

                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Modificar Producto
                    <i class="material-icons right">edit</i>
                </button>

                </form>
            </div>

        </div>

    </header>


    <!-- Compiled and minified JavaScript -->
    <script src="../../js/wow.min.js"></script>
    
    <!-- Activating the animations -->
    <script>
        new WOW().init();
    </script>
</body>
</html>