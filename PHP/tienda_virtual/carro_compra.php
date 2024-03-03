<?php
session_start();
?>
<?php
include("./funciones.php");

$nombre_producto= $_GET["nombre"];
$id_producto=$_GET["id"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <div class="registro"></div>
    <h1>¿Estas seguro que quieres comprar el producto: <?php echo $nombre_producto; ?>?</h1>
    <button><?php echo "<a href='confirmar_compra.php?id=".$id_producto."'>Comprar</a>"?></button>
    <button><a href="inicio.php">Cancelar</a></button>
</body>
</html>