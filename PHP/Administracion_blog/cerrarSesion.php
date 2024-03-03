<?php
session_start();
if(isset($_SESSION["logado"])&&$_SESSION["logado"]){
    if(isset($_GET["url"])){
    $url = $_GET["url"];
}else{
    $url = "main.php";
}

unset($_SESSION["logado"]);
session_destroy();
include("./funciones.php");
volver($url);
}else{
    volver("main.php");
}

?>