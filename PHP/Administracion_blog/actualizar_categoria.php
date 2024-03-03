<?php
session_start();
include("./funciones.php");

if(isset($_SESSION["admin"]) && $_SESSION["admin"]){
       $nombre= $_POST["nombre"];
$id = $_POST["id"];
$url=$_GET["url"];
conectar();

$sql_comprob="SELECT * from categoria where nombre_categoria ='$nombre'";
$resultado_compr= $conexion->query($sql_comprob);
if($resultado_compr->num_rows==1){
       $_SESSION["error_categoria"]=true;
       $_SESSION["mensaje_error_categoria"] = "El nombre de la categoría ya existe.";
       volver($url);
}else{
$sql= "UPDATE categoria SET nombre_categoria='$nombre' WHERE id=".$id;
$resultado = $conexion->query($sql); 
volver("categorias.php");
}
}else{
       volver("main.php");
}


?>