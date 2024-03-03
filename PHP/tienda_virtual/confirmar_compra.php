<?php
session_start();
?>

<?php
include("./funciones.php");

$id_producto=(int)$_GET["id"];
$id_carro=(int)$_SESSION["id_carro"];
conectar();
$sql = "INSERT into compras (id_carro_compra,id_producto) VALUES ($id_carro,$id_producto)";
$resultado = $conexion->query($sql); 

volver("inicio.php");
?>