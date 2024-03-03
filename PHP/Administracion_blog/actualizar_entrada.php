<?php
session_start();
include("./funciones.php");

if(isset($_SESSION["admin"])&& $_SESSION["admin"]){
    $titulo= $_POST["titulo"];
$contenido= $_POST["contenido"];
$id_entrada = $_POST["id_entrada"];
$categoria= $_POST["categoria_escogida"];
$url=$_GET["url"];
conectar();

$sql_compr= "SELECT * from entradas where titulo='$titulo'";
        $resultado_compr=$conexion->query($sql_compr);
        if($resultado_compr->num_rows==1){
            $_SESSION["error_entrada"]=true;
            $_SESSION["mensaje_error_entrada"] = "El nombre de la entrada ya existe.";
            volver($url);
        }else{
            $sql= "UPDATE entradas SET titulo='$titulo', contenido='$contenido' , categoria_id='$categoria' WHERE id=".$id_entrada;
            $resultado = $conexion->query($sql);
            volver("main.php");
        }
}else{
    volver("main.php");
}


?>