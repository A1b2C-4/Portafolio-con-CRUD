<?php
session_start();


if($_POST) {
 include ("conexion.php");// incluye el archivo de conexion a la base de datos
 $objConexion = new conexion();// crea un objeto de conexion para hacer las consultas

 //Captura datos del formulario y los guarda en variables 
 $usuario = $_POST['usuario'];
 $contraseña = $_POST['contraseña'];

 //Consulta en la base de adatos si el usuario y contraseña existen y coincidan
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contraseña='$contraseña'";
   
    $resultado = $objConexion->consultar($sql);// ejecuta la consulta y guarda el resultado en la variable $resultado

if(count ($resultado) > 0){ // Si el resultado de la consulta es mayor a 0, significa que el usuario y contraseña son correctos
    $_SESSION['usuario'] = $resultado[0]['usuario'];// Guarda el usuario en la sesión
    $_SESSION['rol'] = $resultado[0]['rol'];// Guarda el rol del usuario en la sesión
    header("location:index.php");//redirige a la pagina

}else{
    echo "<script> alert ('Usuario o contraseña incorrecta'); </script>";
    
}

}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport"content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />


        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <div class="container">

    <div class="row">
        <div class="col-md-4">
     
        </div>
        <div class="col-md-4">
            <br/>
        <div class="card">
            <div class="card-header">Iniciar sesión</div>

<div class="card-body">                     
<form action="login.php" method="post">

    Usuario: <input class="form-control" type="text" name="usuario" id="">
</br>
    Contraseña: <input class="form-control"type="password" name="contraseña" id="">
</br>
    <button class="btn btn-success" type="submit">Entrar a galeria</button>
        </form>

            </div>
            <div class="card-footer text-muted">
            
            </div>
        </div>
        </div>
        <div class="col-md-4">

       </div>
    </div>
    
        
        
    </body>
</html>
