<?php
session_start();

include("./funciones.php");
conectar();
if(isset($_SESSION["admin"])&&$_SESSION["admin"]){
    $id_categoria= $_GET["id_categoria"];

$sql = "DELETE FROM entradas WHERE categoria_id=$id_categoria";

$conexion->query($sql);

volver("borrar_categoria.php?id_categoria=$id_categoria");

}else{
    volver("main.php");
}

?>