<?php
session_start();
?>
<?php
include("./funciones.php");
$_SESSION["categoria_seleccionada"]=$_POST["categoria_seleccionada"];
if($_SESSION["categoria_seleccionada"] == -1){
    volver("reiniciar_filtro.php");
}else{
   volver("main.php"); 
}

?>