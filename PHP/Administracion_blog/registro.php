<?php
session_start();
include("./funciones.php");

if(isset($_SESSION["logado"])&&$_SESSION["logado"]==true){
  volver("main.php");
 }else{
  $url=$_GET["url"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<main class="main_formulario">
    <form action="registrocomprobacion.php?url=<?php echo $url;?>" method="POST" id="formulario" class="formulario">
    <h1>Registro</h1>
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Usuario</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="usuarioRegistro" aria-describedby="emailHelp" placeholder="Usuario">
    <div id="emailHelp" class="form-text">Tu usuario tiene que ser único.</div>
    </div>
    <div class="mb-3">
    <label class="form-label">Contraseña * </label>
    <input class="form-control" type="password" name="password" id="password" placeholder="*****">
 </div>
  <button type="submit" class="btn btn-primary" id="botonRegistro">Registrarse</button>
  </form> 
  <button style="margin-top:20px;" class="btn btn-secondary" id="volver" value="html_login.php?url=<?php echo $url;?>">Volver</button>
 </main>
  <?php
  if(isset($_SESSION["error_registro"]) && $_SESSION["error_registro"]==true ){
    echo "<script>alert('".$_SESSION["mensaje_error_registro"]."');</script>";
    unset($_SESSION["error_registro"]);
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="script_registro.js"></script>
</body>
</html>

<?php
 }
 ?>