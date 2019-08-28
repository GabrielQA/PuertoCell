<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/register2.css">
        <!-- Compiled and minified CSS -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../js/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <title>Register User</title>
</head>
<body>
    <!-- This is the principal container -->
    <div class="container">
        <!-- this is containing the image -->
        <div class="thumb wow fadeInRightBig">
            <img src="img/user.png" alt="" title="Add New User">
        </div>
        <!-- this is containing the inputs to get the information -->
        <div class="info wow bounceIn">
            <!-- this is coming back to the beginning -->
            <a href="/" style="border-radius: 25px; width:5%; margin-top:10px;" title="Regresar" class="btn"><i class="material-icons">arrow_back</i></a>

            <h2>Sing Up</h2>
            <div class="row">
                <!-- this form will call the php file to interact -->
                <form class="col s12" method="POST" action="/register">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="icon_prefix" type="text" name="nombre" class="validate" required>
                        <label for="icon_prefix">Name</label>
                        </div>
                        <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="lastname" type="text" name="apellido" class="validate" required>
                        <label for="lastname">Las Name</label>
                        </div>
                        </div>
                        <div class="input-field col s6">
                        <i class="material-icons prefix">mail</i>
                        <input id="correo" type="email" name="correo" class="validate" required>
                        <label for="correo">Email</label>
                        </div>
                        <div class="input-field col s6">
                        <i class="material-icons prefix">location_on</i>
                        <input id="dire" type="text" name="dire" class="validate" required>
                        <label for="dire">Address</label>
                        </div>
                        <div class="input-field col s6 offset-s3">
                        <i class="material-icons prefix">lock</i>
                        <input id="pass" type="password" name="contra" class="validate" required>
                        <label for="pass">Password</label>
                        </div>
                        <input type="hidden" name="tipo" value="0">
                    </div>
                    <button class="btn waves-effect waves-light" type="submit" name="action">Register new User
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>

    </div>

    <!-- Compiled and minified JavaScript -->
    <script src="../../js/wow.min.js"></script>
    <!-- Activating the animations -->
    <script>
        new WOW().init();
    </script>
</body>
</html>