<?php
include("./funciones.php");
$nombre= $_POST["nombre_tarea"];
$descripcion= $_POST["descripcion"];
$id_tarea = $_POST["id_tarea"];
conectar();


$sql= "UPDATE tareas SET nombre_tarea='$nombre', descripcion='$descripcion' WHERE id=".$id_tarea;

$resultado = $conexion->query($sql);

volver("loginexterno.php");
?>