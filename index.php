<?php include("cabecera.php"); ?>
<?php
if (esAdmin()) {
  $mensajeBienvenida = "Bienvenido, administrador";
  $descripcion="Tienes acceso completo:agregar, editar y eliminar proyectos";
} else {
  $mensajeBienvenida = "Bienvenido, usuario";
  $descripcion="Tienes acceso limitado: solo puedes ver los proyectos";
}
?>
<?php include("conexion.php"); ?>
<?php
$objConexion = new conexion();
$proyectos = $objConexion->consultar("SELECT * FROM proyectos");
?>
    <div class="p-5 bg-light">
    <div class="container">  
     <h1 class="display-3"><?php echo $mensajeBienvenida; ?> </h1>
     <p class="lead"><?php echo $descripcion; ?></p>
     <hr class="my-2">
     <p>Mas información</p>

    </div>
</div>
    

    <div class="row row-cols-1 row-cols-md-3 g-4">
<?php foreach($proyectos as $proyecto) { ?>
  <div class="col">
    <div class="card">
      <img src="imagenes/<?php echo $proyecto['imagen'];?>" class="card-img-top" alt="" 
      style="height: 180px; object-fit: cover; width: 100%;">
      
      <div class="card-body">
        <h5 class="card-title"><?php echo $proyecto['nombre'];?></h5>
        <p class="card-text"><?php echo $proyecto['Descripción'];?></p>
      </div>
    </div>
  </div>
<?php } ?>
</div>  

    <?php include("pie.php"); ?>

