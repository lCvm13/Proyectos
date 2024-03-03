<?php
/* POR SI TUVIESEMOS MAS DE 1 BASE DE DATOS
function conectar($host, $user, $pass, $bbdd){
    $conexion = new mysqli($host,$user,$pass,$bbdd);
}

*/

function conectar(){
    global $conexion;
    $conexion = new mysqli("localhost","root","","trabajo_blog");
    return $conexion;
}
function volver($url){
    header("Location: $url");
}

function consultar($conexion,$sql){
    $resultado = $conexion->query($sql);
    return ($resultado);
}

function alerta($msg) {
    echo "<script>alert('$msg');</script>";
}

function confirmar($msg,$id){
    echo "<script>
    var confirmar=window.confirm('$msg');
    if(confirmar){
        location.href='borrar_entradas_categoria.php?id_categoria=$id';
    }else{
        location.href='categorias.php';
    }
    </script>";
}
?>