<?php
session_start();
//verificamos que el usuario este logueado
//si no lo esta, lo redirigimos al login
if ( !isset($_SESSION['usuario'])) {
    header("location:login.php");
    exit;
}
//Verificamos que el usuario tenga el rol de administrador
function esAdmin(){
    return isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin';
}
//Verificamos que es un usuario normal
function esUsuario(){
    return isset ($_SESSION ['rol'] )&& $_SESSION['rol'] =='usuario';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">

<!--Navegacion paginan principal--->
<a href="index.php">Inicio</a> |
<?php if (esAdmin()) { ?>
<a href="Galeria.php">Galeria</a> |
<a href="usuarios.php">Usuarios</a> |
<?php } else{ ?>  <!-- Si no es admin, solo muestra galería -->

<span style= "color: gray;"> Galeria </span> |
<?php } ?>

<a href="cerrar.php"> Cerrar </a> 
</br>


