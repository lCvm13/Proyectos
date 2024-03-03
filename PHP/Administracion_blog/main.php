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
<header>
    <ul class="nav nav-pills nav-fill">  
    <li class="nav-item">
  <a class="nav-link active" aria-current="page" href="main.php">Inicio</a>
  </li>
<?php
if(isset($_SESSION["logado"]) && $_SESSION["logado"]){
    if(isset($_SESSION["admin"]) && $_SESSION["admin"]){
?>
<li class="nav-item">
  <a class="nav-link active" aria-current="page" href="categorias.php">Categorias</a>
  </li>
  <?php
    }
  ?>
  <li class="nav-item">
  <a class="nav-link active" aria-current="page" href="cerrarSesion.php?url=main.php">Cerrar sesión</a>
  </li>
    <?php
}else{
    ?>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="html_login.php?url=main.php">Iniciar sesión</a>
  </li>
    <?php
}
    ?>
    </ul>
    </header>
    <div id="principal">
        <?php
        if(!isset($_GET["pagina"])){
            $paginador = 1;
        }
        else{
            $paginador = $_GET["pagina"];
        }
        if(isset($_SESSION["categoria_seleccionada"])){
            $categoria_actual = $_SESSION["categoria_seleccionada"];
            $sql_numero = "SELECT COUNT(*) as numero_entradas FROM entradas
            WHERE categoria_id=$categoria_actual";
            $numero_entradas=$conexion->query($sql_numero);
            while($row = $numero_entradas->fetch_array()){
                $cantidad = $row["numero_entradas"];
                }
                $numero_paginas = ceil($cantidad /10) ;
                $inicio = ($paginador - 1) * 10;
            $sql_entradas = "SELECT entradas.id as entrada_id, entradas.titulo,entradas.contenido,entradas.fecha_creacion, categoria.id as categoria_id ,categoria.nombre_categoria as nombre_categoria FROM entradas,categoria
        WHERE entradas.categoria_id = categoria.id
        AND categoria_id = $categoria_actual
        ORDER BY fecha_creacion DESC
        LIMIT $inicio,10";
        }else{
            $sql_numero = "SELECT COUNT(*) as numero_entradas FROM entradas;";
            $numero_entradas=$conexion->query($sql_numero);
            while($row = $numero_entradas->fetch_array()){
                $cantidad = $row["numero_entradas"];
                }
                $numero_paginas = ceil($cantidad /10) ;
                $inicio = ($paginador - 1) * 10;
        $sql_entradas = "SELECT entradas.id as entrada_id, entradas.titulo,entradas.contenido,entradas.fecha_creacion, categoria.id as categoria_id ,categoria.nombre_categoria as nombre_categoria FROM entradas,categoria
        WHERE entradas.categoria_id = categoria.id
        ORDER BY fecha_creacion DESC
        LIMIT $inicio,10"; 
        }
        $entrada = $conexion->query($sql_entradas);

        $sql_categorias = "SELECT * from categoria";
        $categoria = $conexion -> query($sql_categorias);
        
        ?>
        <div id="cabecera">
        <h1>Entradas blog</h1>
        <div>
        <form style="float:right;" action="cambiar_categoria.php" method="POST" id="formulario">
        <label style="margin:5px;" for="categoria">Filtrar por categorias:
        <select id="seleccionar_categoria" name="categoria_seleccionada">
        <?php
        if(isset($_SESSION["categoria_seleccionada"])){
            $categoria_seleccionada = $_SESSION["categoria_seleccionada"];
        }
        echo "<option value='-1'>Seleccione una opcion</option>"; 
        while($row_categoria=$categoria->fetch_array()){
            $seleccionado=$row_categoria["id"]==$categoria_seleccionada?'selected':'';
            echo "<option value='".$row_categoria["id"]."' $seleccionado>".$row_categoria["nombre_categoria"]."</option>";
        }
        ?>
        </select>
    </div>
    </form>
    <?php
    if(isset($_SESSION["admin"]) && $_SESSION["admin"]){
    ?>
    <div id="botones">
    <button class="btn btn-primary botonVolver" value="add_entrada.php">Añadir Entrada</button>
    <button id="botonfiltro" value="reiniciar_filtro.php" class="btn btn-primary botonVolver">Reiniciar Filtro</button>
    </div>
    <?php
    }
    ?>
        </div>
        <table class="table table-striped" id="tabla_entradas">
                <tr>
                    <td>Nombre de la entrada</td>
                    <td>Contenido de la entrada</td>
                    <td>Fecha de creación de la entrada</td>
                    <td>Categoria</td>
                <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"]){
                    ?>
                    <td></td>
                    <td></td>
                    <?php
                }
                     ?>
                </tr>
                <?php
                $contador=0;
    while($row_entrada=$entrada->fetch_array()){
        $id= $row_entrada["entrada_id"];
        $sql_contenido_breve = "SELECT LEFT (contenido, 40) as contenido
                            from entradas
                            WHERE id=$id";

        $contenido_b=$conexion->query($sql_contenido_breve);
        while($contenido=$contenido_b->fetch_array()){
            $contenidobreve =$contenido["contenido"]; 
        }
        echo "<tr>
                <td>".$row_entrada["titulo"]."</td>
                <td>
                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal$contador'>
                Mostrar Contenido de la entrada
                </button></td>
                <div class='modal fade' id='exampleModal$contador' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-header'>
            <h1 class='modal-title fs-5' id='exampleModalLabel'>Contenido</h1>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
            <p>".$contenidobreve."...</p>
            <a href='entrada_completa.php?id_entrada=".$row_entrada["entrada_id"]."'>Leer más</a>
            </div>
            <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            </div>
            </div>
            </div>
            </div>
            <td>".$row_entrada["fecha_creacion"]."</td>
            <td>".$row_entrada["nombre_categoria"]."</td>";
            $contador++;

            if(isset($_SESSION["admin"]) && $_SESSION["admin"]){
    echo  "<td><a href='datos_entrada.php?id_entrada=".$row_entrada["entrada_id"]."'>
                <i class='bi bi-pencil-square'></i>
                </a>
                </td>
                <td>
                <a class='borrar' href='borrar_entrada.php?id_entrada=".$row_entrada["entrada_id"]."'>
                <i class='bi bi-trash3'></i>
                </a>
                </td>
              </tr>";
    }else{
      echo "</tr>";
    };
    }
              
    ?>
    </table>
    <?php
    echo "<ul class='pagination justify-content-center'>";
    for($i=1; $i<=$numero_paginas; $i++){
        echo "<li><a  class='page-link' href='main.php?pagina=$i'> $i </a></li>";
    }
    echo "</ul>";
    ?>
        <div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="script_main.js"></script>
</body>

</html>