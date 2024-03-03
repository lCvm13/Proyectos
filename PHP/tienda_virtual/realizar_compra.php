<?php
session_start();
?>
<?php
include("./funciones.php");
conectar();
$id_carro= $_SESSION["id_carro"];
$realizar_compra="DELETE FROM compras WHERE id_carro_compra = $id_carro";

$compra = $conexion->query($realizar_compra);
volver("inicio.php");
?>