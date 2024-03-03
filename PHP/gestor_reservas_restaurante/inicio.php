<?php
include("./funciones.php");
conectar();

$sql_mesas = "SELECT id,numero_sillas FROM mesas";

$mesas = $conexion->query($sql_mesas);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <form action="realizar_reserva.php" class="formulario" method="POST">
        <h1>Reserva mesa</h1>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre cliente</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="cliente"
                placeholder="Tu nombre...">
            <div id="emailHelp" class="form-text">Ingrese su nombre para identificarle</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Selecciona tu mesa</label>
            <select name="mesas_disponibles">
                <?php
    while($row=$mesas->fetch_array()){
        echo "<option value=".$row["id"].">Mesa ".$row["id"]." con ".$row["numero_sillas"]." sillas</option>";
    };

    ?>
            </select>
        </div>
        <div class="mb-3 form-check">
            <label class="form-check-label" for="exampleCheck1">Fecha reserva</label>
            <input type="date" name="fecha_reserva">
        </div>
        <button type="submit" class="btn btn-primary" id="reservar">Reservar</button>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>