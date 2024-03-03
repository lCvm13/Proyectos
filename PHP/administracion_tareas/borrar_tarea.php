<?php
session_start();

include("./funciones.php");
conectar();

$id_tarea= $_GET["id_tarea"];

$sql = "DELETE FROM tareas WHERE id=$id_tarea";

$conexion->query($sql);

volver("loginexterno.php");
?>