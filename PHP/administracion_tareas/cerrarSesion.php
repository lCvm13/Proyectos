<?php
session_start();
unset($_SESSION["usuario"]);
session_destroy();
include("./funciones.php");
volver("htmllogin.php");

?>