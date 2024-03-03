<?php

include("./funciones.php");
conectar();

$cliente=$_POST["cliente"];
$mesa=$_POST["mesas_disponibles"];
$fecha=$_POST["fecha_reserva"];

$sql_reserva = "SELECT mesas.id , fechas.fecha_reserva FROM mesas , fechas
WHERE mesas.id = fechas.id_mesa
AND fechas.fecha_reserva='$fecha'";

    $reservar = $conexion->query($sql_reserva);

    if($reservar->num_rows==1){
        echo "<span>La mesa seleccionada no esta disponible para la fecha introducida, selecciona otra mesa</span>";
        echo "<a href='inicio.php'>Volver</a>";
    }else{
        $insertar_fecha= "INSERT into fechas (fecha_reserva , id_mesa , nombre_cliente) VALUES ('$fecha','$mesa','$cliente')";
        $insertar = $conexion->query($insertar_fecha);
        
        echo "<span> Se ha realizado la reserva correctamente </span>";
        echo "<a href='inicio.php'>Volver</a>";
    }
    

?>