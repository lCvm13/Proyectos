<?php
session_start();
unset($_SESSION["usuario"]);
unset($_SESSION["id_carro"]);
session_destroy();
include("./funciones.php");
volver("login.php");

?>