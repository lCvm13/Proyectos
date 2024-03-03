<?php
session_start();
include("./funciones.php");
if(isset($_SESSION["logado"])){
 volver("main.php");
}else{
  if(isset($_GET["url"])){
    $url =$_GET["url"];
  }else{
    $url = "main.php";
  }
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
<main class="main_formulario">
    <form action="login.php?url=<?php echo $url ?>" method="POST" id="formulario" class="formulario">
    <h1>Login</h1>
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Usuario</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="usuario" aria-describedby="emailHelp" placeholder="Usuario">
    </div>
    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="*******">
  </div>
  <button type="submit" class="btn btn-primary">Iniciar sesion</button>
  </form> 

  <div class="registro">
  <h2>¿No tienes cuenta?</h2>
  <button class="btn btn-primary" id="botonRegistro" value="registro.php?url=<?php echo $url;?>">Registrate</button>
    </div>  
  <button style="margin-top:20px;" class="btn btn-secondary" id="volver" value="<?php echo $url; ?>">Volver</button>
</main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="script_registro.js"></script>
  <?php
  if(isset($_SESSION["error"]) && $_SESSION["error"]==true ){
    echo "<script>alert('".$_SESSION["mensaje_error"]."');</script>";
    unset($_SESSION["error"]);
  }
  ?>
</body>
</html>
<?php
}
?>