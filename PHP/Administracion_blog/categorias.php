<?php
session_start();
?>
<?php
include("./funciones.php");
conectar();
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
<div id="main">
    <?php
if(isset($_SESSION["admin"]) && $_SESSION["admin"]){
?>
    <header>
    <ul class="nav nav-pills nav-fill">
  
  <li class="nav-item">
  <a class="nav-link active" aria-current="page" href="main.php">Inicio</a>
  </li>
  <li class="nav-item">
  <a class="nav-link active" aria-current="page" href="cerrarSesion.php?">Cerrar sesión</a>
  </li>
    </ul>
    </header>
    <div id="principal">
        <?php
        $sql_categorias = "SELECT * from categoria";

        $categoria = $conexion->query($sql_categorias);
        ?>
        <h1>Categorias blog</h1>
        <table class="table table-striped" id="tabla_entradas">
                <tr>
                    <td>Nombre de la categoria</td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
    while($row=$categoria->fetch_array()){
        echo "<tr>
                <td>".$row["nombre_categoria"]."</td>
                <td><a href='datos_categoria.php?id_categoria=".$row["id"]."'>
                <i class='bi bi-pencil-square'></i>
                </a>
                </td>
                <td>
                <a href='borrar_categoria.php?id_categoria=".$row["id"]."'>
                <i class='bi bi-trash3'></i>
                </a>
                </td>
              </tr>";
    }
    ?>
    </table>
    <div id="botones">
        <button class="btn btn-success">
            <a id="linktarea" href="add_categoria.php">Añadir Categoria</a>
        </button>
    </div>
    <?php
}else{
    volver("main.php");
}
    ?>
        <div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script> 
    
</body>

</html>