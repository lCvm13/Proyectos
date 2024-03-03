<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINCIPAL</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

    <?php

include("./funciones.php");
conectar();

if($_POST){
 $usuario= $_POST["usuario"];
 $sql = "SELECT * FROM carro_compra WHERE nombre_usuario='$usuario'";
 $resultado = $conexion->query($sql);

    if($resultado->num_rows==1){
        $_SESSION["usuario"]= $usuario;
        $_SESSION["confirmacion"]=false;
        
        while($row=$resultado->fetch_array()){
           $_SESSION["id_carro"]=$row["id"];
        };
        
    
    }
}
if($_SESSION){
    $usuario=$_SESSION["usuario"];
    $carro=$_SESSION["id_carro"];
?>
    <div id="principal">
        <?php

    if(isset($_SESSION["categoria_seleccionada"])){
       $categoria_actual=  $_SESSION["categoria_seleccionada"];
        $sql_productos="SELECT ofertas.calculo,productos.id, productos.nombre,productos.descripcion,ROUND(productos.precio-(productos.precio*ofertas.calculo)) as precio FROM productos, categorias,ofertas
        WHERE categorias.id = productos.categoria_id
        AND productos.oferta_id=ofertas.id
        AND categorias.nombre= '$categoria_actual' ";
    }else if(isset($_SESSION["destacados"])){
        $sql_productos="SELECT ofertas.calculo,productos.id, productos.nombre,productos.descripcion,ROUND(productos.precio-(productos.precio*ofertas.calculo)) as precio FROM productos,ofertas
        WHERE productos.oferta_id=ofertas.id
        AND productos.producto_destacado=1";
    }else {
        $sql_productos="SELECT ofertas.calculo,productos.id, productos.nombre,productos.descripcion,ROUND(productos.precio-(productos.precio*ofertas.calculo)) as precio FROM productos,ofertas
        WHERE productos.oferta_id=ofertas.id";
       
    }
    

    $producto = $conexion->query($sql_productos);
    $sql_categorias = "SELECT categorias.nombre FROM categorias";
    $categoria= $conexion->query($sql_categorias);
    ?>

        <div>
            <form method="POST" id="form_categoria" action="cambiar_categoria.php">
                <h1 style="text-align:left;">FILTROS</h1>
                <label for="categoria">Categorias: </label>
                <select name="categoria_seleccionada">
                    
                    <?php
                    while($row=$categoria->fetch_array()){
                        echo "<option name='categoria'>".$row["nombre"]."</option>";
                    };
                  
                    ?>
                    </select>
                <button type="submit" > Filtrar</button>
                <button class="btn btn-success" ><a style="text-decoration:none;color:white;font-weight:bolder;" href="mostrar_destacados.php">Mostrar destacados</a></button>
                <button class="btn btn-primary" ><a style="text-decoration:none;color:white;font-weight:bolder;" href="reiniciar_filtro.php">Reiniciar Filtro</a></button>
                </form>
            <h1>Seleccione sus productos, <?php echo $usuario?></h1>
            <?php
            echo "<a style='float:right;' href='mostrar_carro.php?id=".$carro."'>
            <i style='font-size:100px' class='bi bi-cart'></i>
            </a>";
            ?>
            <table class="table table-striped" class="tablaTarea">
                <tr>
                    <td>Nombre</td>
                    <td>Descripcion del producto</td>
                    <td>Precio</td>
                    <td></td>
                </tr>
                <?php
    while($row=$producto->fetch_array()){
        switch (true){
            case $row["calculo"]==0:
            echo "<tr>
            <td>".$row["nombre"]."</td>";
            break;
            case $row["calculo"]==0.75:
            echo "<tr>
            <td>".$row["nombre"]."<span style='color:red;'> Con oferta del 75%!!!</span></td>";
            break;
            case $row["calculo"]==0.5:
                echo "<tr>
                <td>".$row["nombre"]."<span style='color:aqua;'> Con oferta del 50%!!!</span></td>";
            break;
            case $row["calculo"]==0.25:
                echo "<tr>
                <td>".$row["nombre"]."<span style='color:orange;'> Con oferta del 25%!!!</span></td>";
            break;
        }
                echo "<td>".$row["descripcion"]."</td>
                <td>".$row["precio"]."€</td>
                <td>
                <a href='carro_compra.php?id=".$row["id"]."&nombre=".$row["nombre"]."'>
                <i class='bi bi-cart-plus'></i>
                </a>
                </td>
              </tr>";
    };
    

    ?>
            </table>
        </div>
        <button class="btn btn-primary">
            <a id="linktarea" href="cerrarSesion.php">Cerrar sesion</a>
        </button>
    </div>
    <?php
            }else{
                echo "<div class='registro'>";
                echo "<h2>El usuario no existe</h2>";
                echo "<button class='btn btn-primary' id='botonRegistro'><a style='color:white;font-weight:bolder;text-decoration:none;' href='login.php'>Volver</a></button>";
                echo "</div>";
            }

        

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>