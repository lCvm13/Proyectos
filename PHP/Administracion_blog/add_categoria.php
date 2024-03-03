<?php
session_start();
?>
<?php
include("./funciones.php");
conectar();

if(isset($_SESSION["admin"]) && $_SESSION["admin"]){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div id="main">
    <form action="" method="POST" id="formulario" class="formulario">
    <h1>Añadir Categoria</h1>
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre de la categoria</label>
    <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" aria-describedby="emailHelp" placeholder="Nombre">
    </div>
    
  <button id="botonSubmit" type="submit" class="btn btn-primary">Añadir categoria</button>
  </form>
<button id="botonVolver" class="btn btn-primary" value="categorias.php">Volver</button>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="script_categoria.js"></script>  
  <?php
    if($_POST){
        $comprobacion_nombre=$_POST["nombre_categoria"];
        $sql_cat_exis = "SELECT * from categoria WHERE nombre_categoria = '".$comprobacion_nombre."'";
        $comprobar_nombre = $conexion-> query($sql_cat_exis);
        if($comprobar_nombre->num_rows==1){
            alerta("La categoria con el nombre introducido ya existe");
        }else{
        $sql = "INSERT into categoria (nombre_categoria) VALUES ('$comprobacion_nombre')";
        $resultado = $conexion->query($sql);
        volver("categorias.php");
        }
    }

    ?>
  
</body>
</html>
<?php
}else{
  volver("main.php");
}
?>