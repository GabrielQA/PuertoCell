<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../../css/categorias.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link rel="stylesheet" href="../../js/animate.css">
    <script type="text/javascript"
        src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <title>CRUD Categorias</title>
</head>
    <body>
        <header>
            <div class="nave" style="text-align: center;">
                <h1>Modificar Categoria</h1>
            </div>
            <a href="/categoria" style="border-radius: 25px;" class="btn"><i class="material-icons">arrow_back</i></a>
            <div id="crear" class="city wow slideInLeft">
                <div class="row" style="text-align: center;">
                    <form class="col s12" action="/categoria/{{$categorias->id}}" method="POST">
                        @method("PUT")
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                            <i class="material-icons prefix">dvr</i>
                            <input id="icon_prefix" type="text" class="validate" name="categoria" value="{{$categorias->categoria}}" required>
                            <label for="icon_prefix">Nombre de Categoria</label>
                            </div>
                            <div class="input-field col s12">
                            <i class="material-icons prefix">description</i>
                            <textarea id="textarea1" class="materialize-textarea" name="descri" required>{{$categorias->descri}}</textarea>
                            <label for="textarea1">Descripcion de la Categoria</label>
                            </div>
                        </div>
                        <button class="btn waves-effect waves-light" type="submit">Modificar Categoria
                            <i class="material-icons right">edit</i>
                        </button>

                    </form>
                </div>                   
            </div>
        </header>
    </body>
</html>