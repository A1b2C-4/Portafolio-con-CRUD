<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>
<?php
if($_POST){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['Descripción']; 
    $nombreArchivoOriginal = $_FILES['archivo']['name'];
    $fecha = new DateTime();

    // Genera un nombre único para la imagen usando el timestamp y el nombre original
    $imagen = $fecha->getTimestamp() . "_" . $nombreArchivoOriginal;
    $imagen_temporal = $_FILES['archivo']['tmp_name'];

    // Mueve el archivo a la carpeta 'imagenes' con el nombre generado
    move_uploaded_file($imagen_temporal, "imagenes/" . $imagen);

    $objConexion = new conexion();
    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `Descripción`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
    $objConexion->ejecutar($sql);
    header("location:galeria.php");
    exit;
}

if($_GET){
    $id = $_GET['borrar'];
    $objConexion = new conexion();

    $imagen = $objConexion->consultar("SELECT imagen FROM proyectos WHERE id=" . $id);
    $ruta = "imagenes/" . $imagen[0]['imagen'];
    if(file_exists($ruta) && !empty($imagen[0]['imagen'])){
        unlink($ruta);
    }

    $sql = "DELETE FROM proyectos WHERE `proyectos`.`id` =" . $id;
    $objConexion->ejecutar($sql);
    header("location:galeria.php");
    exit;
}

$objConexion = new conexion();
$proyectos = $objConexion->consultar("SELECT * FROM proyectos");
?>

<br/>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Datos del proyecto</div>
                <div class="card-body">
                    <form action="galeria.php" method="post" enctype="multipart/form-data">
                        Nombre del proyecto:
                        <input required class="form-control" type="text" name="nombre" id="">
                        <br/>
                        Imagen del proyecto:
                        <input required class="form-control" type="file" name="archivo" id="">
                        <br/>
                        Descripción:
                        <textarea required class="form-control" name="Descripción" id="" rows="3"></textarea>
                        <br/>
                        <input class="btn btn-success" type="submit" value="Enviar proyecto">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($proyectos as $proyecto) { ?>
                    <tr>
                        <td><?php echo $proyecto['id'];?></td>
                        <td><?php echo $proyecto['nombre'];?></td>

                        <td>
                            <img width="100" src="imagenes/<?php echo $proyecto['imagen'];?>"
                            alt="" 
                            class="img-thumbnail" 
                            style="width: 100px; height: 100px; object-fit: cover;">
                        </td>
                        <td><?php echo $proyecto['Descripción'];?></td>
                        <td>
                            <a class="btn btn-danger" href="?borrar=<?php echo $proyecto['id']; ?>" >Eliminar</a>
                        </td>       
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("pie.php"); ?>
