<?php
session_start();
?>
<?php
include("./funciones.php");
unset($_SESSION["categoria_seleccionada"]);
volver("main.php");
?>