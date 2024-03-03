<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <h1>Datos de la tarea</h1>
    <?php
    include("./funciones.php");
    conectar();

    $id_tarea = $_GET["id_tarea"];

    $sql_tarea = "SELECT * FROM tareas WHERE id=".$id_tarea;

    $tarea = $conexion->query($sql_tarea);

    ?>

    <form method="POST" action="actualizar_tarea.php" >
    <input type="hidden" name="id_tarea" value="<?php echo $id_tarea;?>">
    <?php
    while($row=$tarea->fetch_array()){
        echo "<label class='form-label'>Nombre </label>
        <input class='form-control' type='text' name='nombre_tarea'>
      

        <label class='form-label'>Descripcion </label>
        <input class='form-control' type='text' name='descripcion''>";

    
        
        echo "<br>";
        echo "<input type='submit' value='Editar'>";
    };

    ?>
    </form>
</body>
</html>