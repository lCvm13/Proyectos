<?php
session_start();

include("./funciones.php");
conectar();
if(isset($_SESSION["admin"])&&$_SESSION["admin"]){
$id_categoria= $_GET["id_categoria"];

$sql_comprobar_cat = "SELECT entradas.titulo,categoria.nombre_categoria, categoria_id FROM entradas,categoria
WHERE entradas.categoria_id = categoria.id
AND entradas.categoria_id = ".$id_categoria."";

$comprobar_cat =$conexion-> query($sql_comprobar_cat);

if($comprobar_cat->num_rows>=1){
confirmar("La categoria ya tiene entradas, ¿Quieres borrar todas las entradas que tengan dicha categoria para borrar la categoria?",$id_categoria);
}else{
    $sql = "DELETE FROM categoria WHERE id=$id_categoria";
    $conexion->query($sql);
    volver("categorias.php");
}
}else{
    volver("main.php");
}
?>