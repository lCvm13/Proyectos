<?php
/* POR SI TUVIESEMOS MAS DE 1 BASE DE DATOS
function conectar($host, $user, $pass, $bbdd){
    $conexion = new mysqli($host,$user,$pass,$bbdd);
}

*/

function conectar(){
    global $conexion;
    $conexion = new mysqli("localhost","root","","8noviembre");
    return $conexion;
}
function volver($url){
    header("Location: $url");
}

function consultar($conexion,$sql){
    $resultado = $conexion->query($sql);
    return ($resultado);
}


?>