<?php
 session_start();
 include("./funciones.php");
 if(isset($_SESSION["logado"]) && $_SESSION["logado"]){
    volver("main.php");
 }else{
    conectar();
if($_POST){
 $usuario= $_POST["usuarioRegistro"];
 $password = $_POST["password"];
 if(isset($_GET["url"])){
    $url=$_GET["url"];
 }else{
    $url="html_login";
 }
if(trim($usuario)=="" && trim($password)==""){
    $_SESSION["error_registro"]=true;
    $_SESSION["mensaje_error_registro"] = "Rellena todos los campos.";
    volver("registro.php");
}else{
    $sql = "SELECT * FROM usuario WHERE nombre_usuario='$usuario' AND password='$password'";
 $resultado = $conexion->query($sql);
    if($resultado->num_rows==1){
        $_SESSION["error_registro"]=true;
        $_SESSION["mensaje_error_registro"] = "El usuario ya existe.";
        volver("registro.php"); 
            }else{
                $nuevoUsuario= "INSERT INTO usuario (nombre_usuario,password) VALUES ('$usuario','$password')";
                $añadirUsuario = $conexion->query($nuevoUsuario);
                volver("html_login.php?url=".$url);
            }
}
 
 }else{
    volver("main.php");
 }
}
 

?>