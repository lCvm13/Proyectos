<?php
session_start();
include("./funciones.php");
conectar();
if(isset($_SESSION["logado"])&& $_SESSION["logado"]){
$url = $_GET["url"];
if($_POST){
    $contenido=$_POST["contenido"];
    $id_usuario = $_SESSION["id_usuario"];
    $id_entrada= $_POST["id_entrada"];
    $sql = "INSERT into comentarios (contenido,id_usuario,id_entrada) VALUES ('$contenido',$id_usuario,$id_entrada)";
    $resultado = $conexion->query($sql);
    volver($url);
}
}else{
    volver("main.php");
}
?>