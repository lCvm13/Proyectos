<?php
session_start();
?>
<?php
include("./funciones.php");
conectar();
$id_entrada = $_GET["id_entrada"];

$noscript=false;
$sql_entrada = "SELECT * FROM entradas where id=$id_entrada";

$entrada_actual = $conexion -> query($sql_entrada);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<?php
while($row=$entrada_actual->fetch_array()){
  $titulo=$row["titulo"];
  $contenido=$row["contenido"];
}
?>




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
  <a class="nav-link active" aria-current="page" href="cerrarSesion.php?url=entrada_completa.php?id_entrada=<?php echo $id_entrada ?>">Cerrar sesión</a>
  </li>
    <?php
}else{
    ?>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="html_login.php?url=entrada_completa.php?id_entrada=<?php echo $id_entrada ?>">Iniciar sesión</a>
  </li>
    <?php
}
    ?>
    </ul>
    </header>
    <div id="contenedor_entrada">
    <h1><?php echo $titulo; ?></h1>
    <p><?php echo $contenido;?></p>
    <hr>
    <?php
    if(isset($_SESSION["logado"])){
    ?>
    <div id="añadir_comentario">
    <form class="formulario" action='añadir_comentario.php?url=entrada_completa.php?id_entrada=<?php echo $id_entrada;?>' method='POST'>
    <input type="hidden" name="id_entrada" value="<?php echo $id_entrada;?>">        
    <label style="font-weight:bolder;" class='form-label'>Añade comentario:</label>
            <textarea class='form-control' aria-label='With textarea' id='contenido_comentario' name='contenido'></textarea>
            <button id="botonComentario" class='btn btn-primary' type='submit'>Enviar comentario</button>
            </form>
    </div>    
    <?php
    }
    ?>
    <?php
    
    $sql_comentarios="SELECT usuario.nombre_usuario as nombre_usuario, comentarios.contenido as contenido ,comentarios.fecha as fecha from comentarios,usuario 
    WHERE comentarios.id_usuario = usuario.id 
    AND id_entrada=$id_entrada 
    ORDER BY fecha DESC";
    $comentarios = $conexion->query($sql_comentarios);
    if($comentarios->num_rows>0){
        ?>
        <h2 style="text-align:center;font-weight:bolder;">Comentarios</h2>
        <?php
    }else{
      $noscript=true;
    }
    while($comentario=$comentarios->fetch_array()){
        ?>
        <hr>
        <div class="comentario">
            <h3><?php echo $comentario["nombre_usuario"];?></h4>
            <span><b><?php echo "Publicado el ".$comentario["fecha"];?></b></span>
            <p><?php echo $comentario["contenido"];?></p>
        </div>
        <?php
    }
    ?>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <?php
    if(isset($_SESSION["logado"])&& $_SESSION["logado"]){
      if(!$noscript){
    ?>
    <script src="script_comentario.js"></script>
    <?php
    }
  }
    ?>
</body>
</html>