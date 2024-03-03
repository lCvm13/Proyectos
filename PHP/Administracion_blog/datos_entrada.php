<?php
session_start();
include("./funciones.php");
if(isset($_SESSION["admin"]) && $_SESSION["admin"]){
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
    <main class="main_formulario">
    <?php
    conectar();
    $id_entrada = $_GET["id_entrada"];

    $sql_entrada = "SELECT entradas.titulo,entradas.contenido,categoria.nombre_categoria,entradas.categoria_id FROM entradas,categoria
    WHERE entradas.categoria_id = categoria.id
    AND entradas.id=".$id_entrada;

    $entrada = $conexion->query($sql_entrada);

    ?>

    <form method="POST" action="actualizar_entrada.php?url=datos_entrada.php?id_entrada=<?php echo $id_entrada;?>" class="formulario" >
    <h1>Datos de la entrada</h1>
    <input type="hidden" name="id_entrada" value="<?php echo $id_entrada;?>">
    <?php
    while($row1=$entrada->fetch_array()){

        echo "<label class='form-label'>Nombre entrada </label>
        <input class='form-control' id='nombre_entrada' type='text' name='titulo' value='".$row1["titulo"]."'>
    
        <label class='form-label'>Contenido</label>
        <textarea class='form-control' aria-label='With textarea' id='contenido_entrada' name='contenido'>".$row1["contenido"]."</textarea>

        <label class='form-label'>Categoria </label>
        <select name='categoria_escogida'>";

        $sql_categoria_actual = "SELECT * from categoria";
        $categoria = $conexion->query($sql_categoria_actual);
        
        while($row2=$categoria->fetch_array()){
            if($row1["categoria_id"] == $row2["id"]){
                $selected = "selected";
            }
            else{
                $selected = "";
            }
        echo "<option value='".$row2["id"]."' $selected>".$row2["nombre_categoria"]."</option>";
        };
        echo "
        </select>";
        echo "<br>";
        echo "<input class='btn btn-warning' id='botonSubmit' type='submit' value='Editar'>";
    };
    ?>
    </form>
    <button class="btn btn-primary" id="botonVolver" value="main.php">VOLVER</button>
</main>
    <script src="script_entrada.js"></script>
    <?php
  if(isset($_SESSION["error_entrada"]) && $_SESSION["error_entrada"]==true){
    echo "<script>alert('".$_SESSION["mensaje_error_entrada"]."');</script>";
    unset($_SESSION["error_entrada"]);
  }

  ?>
</body>
</html>
<?php
}else{
volver("main.php");
}
?>