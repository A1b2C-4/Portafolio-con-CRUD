<?php include ("cabecera.php"); ?>
<?php include("conexion.php"); ?>
<?php

if (!esAdmin()){
header("location:index.php");
exit;

}
//Procesar el formulario para agregar usuarios
if ($_POST && isset ($_POST['agregar'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['rol'];

    $objConexion = new conexion();
    $sql = "INSERT INTO usuarios (usuario, contraseña, rol) VALUES ('$usuario', '$contraseña', '$rol')";
    $objConexion->ejecutar($sql);
    header("location:index.php");
    exit;
}
//obtención lista de usuarsios
$objConexion = new conexion();
$usuarios = $objConexion->consultar("SELECT * FROM usuarios");
?>
<br/>
<div class="container">
    <div class="row">
        <?php if (esAdmin()) { ?><!-- Si es admin, muestra el formulario para agregar usuarios -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Agregar Usuario</div>
                <div class="card-body">
                    <form action="usuarios.php" method="post">
                        Usuario:
                        <input required class="form-control" type="text" name="usuario" id="">
                        <br/>
                        Contraseña:
                        <input required class="form-control" type="password" name="contraseña" id="">
                        <br/>
                        Rol:
                        <select required class="form-control" name="rol" id="">
                            <option value="">Seleccione un rol</option>
                            <option value="admin">Administrador</option>
                            <option value="usuario">Usuario</option>
                        </select>
                        <br/>
                        <button type="submit" name="agregar" class="btn btn-primary">Agregar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?> 

        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <?php if (esAdmin()) { ?>
                        <th>Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario) { ?>
                    <tr>
                        <td><?php echo $usuario['usuario']; ?></td>
                        <td><?php echo $usuario['rol']; ?></td>
                        <?php if (esAdmin()) { ?>
                        <td><a href="?borrar=<?php echo $usuario['id']; ?>" class="btn btn-danger">Eliminar</a></td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>