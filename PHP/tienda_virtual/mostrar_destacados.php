<?php
session_start();
?>
<?php
include("./funciones.php");
$_SESSION["destacados"]=true;
unset($_SESSION["categoria_seleccionada"]);
volver("inicio.php");
?>