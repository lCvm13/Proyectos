<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINCIPAL</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<?php

include("./funciones.php");
conectar();
if($_POST){
 $usuario= $_POST["usuario"];
 $password=$_POST["password"];
 $sql = "SELECT * FROM usuario WHERE nombre_usuario='$usuario' and password='$password'";
 $resultado = $conexion->query($sql);
 
    if($resultado->num_rows==1){
        $_SESSION["usuario"]= $usuario;
    }
}
if($_SESSION){
    $usuario=$_SESSION["usuario"];
?>  
<div id="principal">
    <?php

    $sql_tarea = "SELECT * FROM tareas
    WHERE usuario_tarea='$usuario'";

    $tarea = $conexion->query($sql_tarea);
    ?>

    <div>
        <h1>TAREAS de <?php echo $usuario?></h1>
    <table class="table table-striped" class="tablaTarea">
    <tr>
        <td>Nombre de la tarea</td>
        <td>Descripcion de la tarea</td>
        <td></td>
        <td></td>
    </tr>
    <?php
    while($row=$tarea->fetch_array()){
        echo "<tr>
                <td>".$row["nombre_tarea"]."</td>
                <td>".$row["descripcion"]."</td>
                <td>
                <a href='datos_tarea.php?id_tarea=".$row["id"]."'>
                <i class='bi bi-pencil-square'></i>
                </a>
                </td>
                <td>
                <a href='borrar_tarea.php?id_tarea=".$row["id"]."'>
                <i class='bi bi-trash3'></i>
                </a>
                </td>
              </tr>";
    };
    

    ?>
    </table>
    </div>
    <button class="btn btn-primary" id="botonTarea">
        <a id="linktarea" href="añadir_tarea.php">Añadir Tarea</a>
    </button>
    <button class="btn btn-primary">
        <a id="linktarea" href="cerrarSesion.php">Cerrar sesion</a>
    </button>
    </div>
<?php
            }else{
                echo "<div class='registro'>";
                echo "<h2>El usuario o contraseña no es correcto</h2>";
                echo "<button class='btn btn-primary' id='botonRegistro'><a href='htmllogin.php'>Volver</a></button>";
                echo "</div>";
            }

        

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>