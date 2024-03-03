<?php
session_start();

include("./funciones.php");
conectar();
if(isset($_SESSION["admin"])&&$_SESSION["admin"]){
$id_entrada= $_GET["id_entrada"];

$sql = "DELETE FROM entradas WHERE id=$id_entrada";

$sql_comentarios = "DELETE FROM comentarios WHERE id_entrada=$id_entrada";
$conexion->query($sql_comentarios);
$conexion->query($sql);

volver("main.php");
}else{
    volver("main.php");
}

?>