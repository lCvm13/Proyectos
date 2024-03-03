<?php
session_start();
include("./funciones.php");
if(isset($_SESSION["admin"])&&$_SESSION["admin"]){
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
    conectar();
    $id_categoria = $_GET["id_categoria"];
    $sql_entrada = "SELECT * FROM categoria
    WHERE id =$id_categoria";

    $entrada = $conexion->query($sql_entrada);

    ?>
  <main class="main_formulario">
    <form method="POST" class="formulario" action="actualizar_categoria.php?url=datos_categoria.php?id_categoria=<?php echo $id_categoria;?>" >
    <h1>Datos de la categoria</h1>
    <input type="hidden" name="id" value="<?php echo $id_categoria;?>">
    <?php
    while($row1=$entrada->fetch_array()){
        echo "<label class='form-label'>Nombre de la categoria </label>
        <input class='form-control' id='nombre_categoria' type='text' name='nombre' value='".$row1["nombre_categoria"]."'>";
        echo "<input class='btn btn-warning' id='botonSubmit' type='submit' value='Editar'>";
    };
    ?>
    </form>
    <button class="btn btn-primary" id="botonVolver" value="categorias.php">Volver</button>
  </main>
    <?php
  if(isset($_SESSION["error_categoria"]) && $_SESSION["error_categoria"]==true ){
    echo "<script>alert('".$_SESSION["mensaje_error_categoria"]."');</script>";
    unset($_SESSION["error_categoria"]);
  }
  ?>
    <script src="script_categoria.js"></script>
</body>
</html>
<?php
}else{
  volver("main.php");
}
?>