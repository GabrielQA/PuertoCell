<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <script type="text/javascript"
        src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../js/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <title>Login</title>
</head>
<body>

    <style>
        *{
        padding: 0px;
        margin: 0px;
        font-family: 'Indie Flower', cursive;
        }

        body{
            background-image: url("../../img/back.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .container{
            width: 100%;
        }
        .container .info{
            margin: auto;
            background: rgba(215,207,207, 0.9);
            border-radius: 20px;
            width: 80%;
            padding: 20px;
            margin-top: 13%;
        }
        .container .info form{
            text-align: center;
        }
        .container .info form h2{
            color:forestgreen;
            font-size: 70px;
            transition: all .4s ease;
            display: inline-block;
        }
        .container .info form button{
            width: 100%;
            margin-top: 15px;
        }
        .container .info .link{
            margin: 10px;
            font-size: 30px;
            display: inline-block;
            padding-bottom: 5px;
            border-bottom: 1px solid transparent;
            transition: all .4s ease;
        }
        .container .info .link:hover{
            padding-bottom: 5px;
            border-bottom: 1px solid #f2f2f2;
        }
        .container .info form h2:hover{
            padding-bottom: 20px;
            border-bottom: 1px solid forestgreen;
        }
        .container .info form .error{
            color: red;
            list-style: disc;
            font-size: 20px;
            text-decoration: underline;
        }

    </style>

    <!-- This is the principal container -->
    <div class="container">
        
    <!-- this is containing the inputs to get the information -->
        <div class="info wow slideInLeft">
            <div class="row">
            
            <!-- this form will call the php file to interact -->
            <form class="col s12" method="POST" action="/login">
                @csrf
                <h2>Log In</h2>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">mail</i>
                        <input id="icon_prefix" type="email" class="validate" name="email" required>
                        <label for="icon_prefix">Email</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="icon_telephone" type="password" class="validate" name="password" required>
                        <label for="icon_telephone">Password</label>
                    </div>
                    <input type="hidden" name="tipo" value="0">
                </div>
                {!! $errors->first("password" , '<span style="color:red; font-size:25px;">:message</span>') !!}
                <button class="btn waves-effect waves-light" type="submit" name="action">Log In
                    <i class="material-icons right">send</i>
                </button>
            </form>
            <a href="/viewregister" class="link">Not Registerd Yet? Click Here!</a>
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