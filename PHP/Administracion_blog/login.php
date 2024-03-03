<?php
session_start();
include("./funciones.php");
if(isset($_SESSION["admin"]) && $_SESSION["admin"]){
  volver("main.php");
}else{
$usuario = $_POST["usuario"];
$password = $_POST["password"];

$url = $_GET["url"];


conectar();

$comprobar_usuario = "SELECT * FROM usuario WHERE nombre_usuario='$usuario' AND password='$password'";

$resultado_comprobacion = $conexion->query($comprobar_usuario);

    if($resultado_comprobacion->num_rows==1){
        $_SESSION["logado"]= true;
        while($filas=$resultado_comprobacion->fetch_array()){
          $_SESSION["id_usuario"]=$filas["id"];
          if($filas["admin"]){
            $_SESSION["admin"]=true;
          }else{
            $_SESSION["admin"]=false;
          }
        }
        unset($_SESSION["error"]);
        volver($url);
    
    }else{
      $_SESSION["error"]=true;
      $_SESSION["mensaje_error"] = "El usuario y la contraseña que has introducido son incorrectos.";
      volver("html_login.php?url=".$url);
    }

}

      ?>