<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <form action="" method="POST" id="formulario" class="formulario">
    <h1>Añadir tarea</h1>
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre de la tarea</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="nombre_tarea" aria-describedby="emailHelp" placeholder="Nombre">
    </div>
    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Descripcion de la tarea</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="descripcion" placeholder="La tarea...">
  </div>
  <button type="submit" class="btn btn-primary">Añadir tarea</button>
  </form>

  <?php
  session_start();
  include("./funciones.php");
    if($_POST){
        conectar();
        $usuario_actual=$_SESSION["usuario"];
        $nombre_tarea=$_POST["nombre_tarea"];
        $descripcion_tarea=$_POST["descripcion"];
        $sql = "INSERT into tareas (nombre_tarea,descripcion,usuario_tarea) VALUES ('$nombre_tarea','$descripcion_tarea','$usuario_actual')";
        $resultado = $conexion->query($sql);
        volver("loginexterno.php");
    }

    ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>