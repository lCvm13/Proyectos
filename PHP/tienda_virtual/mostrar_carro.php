<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<?php
include("./funciones.php");
conectar();
$usuario= $_SESSION["usuario"];
$sql_productos = "SELECT ofertas.calculo,productos.id, productos.nombre,productos.descripcion,ROUND(productos.precio-(productos.precio*ofertas.calculo)) as precio FROM productos , carro_compra, compras, ofertas
WHERE compras.id_carro_compra = carro_compra.id 
AND productos.id = compras.id_producto
AND productos.oferta_id=ofertas.id
AND carro_compra.nombre_usuario= '$usuario'";

$producto = $conexion->query($sql_productos);
$suma_precio=0;
?>
<h1>Carro de compras de <?php echo $usuario; ?></h1>
<table class="table table-striped" class="tablaTarea">
                <tr>
                    <td>Nombre</td>
                    <td>Descripcion del producto</td>
                    <td>Precio</td>
                    
                </tr>
                <?php
    while($row=$producto->fetch_array()){
        echo "<tr>
                <td>".$row["nombre"]."</td>
                <td>".$row["descripcion"]."</td>
                <td>".$row["precio"]."€</td>
                
              </tr>";
              $suma_precio+=$row["precio"];
    };
    ?>
</table>
<div class="enlacesCarro">
<span style="text-align:center">Precio total: <?php echo $suma_precio; ?>€</span>
<button><a href="realizar_compra.php">COMPRAR</a></button>
<button><a href="inicio.php">VOLVER</a></button>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>
</html>