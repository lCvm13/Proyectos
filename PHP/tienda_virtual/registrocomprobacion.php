<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php
 include("./funciones.php");
 conectar();

 $usuario= $_POST["usuarioRegistro"];


 $sql = "SELECT * FROM carro_compra WHERE nombre_usuario='$usuario'";
 $resultado = $conexion->query($sql);
 
 
    if($resultado->num_rows==1){
                echo "<div class='registro'>";
                echo "<h2>El usuario ya existe</h2>";
                echo "<button class='btn btn-primary' id='botonRegistro'><a href='registro.php'>Volver</a></button>";
                echo "</div>";
            }else{
                $nuevoUsuario= "INSERT INTO carro_compra (nombre_usuario) VALUES ('$usuario')";
                $añadirUsuario = $conexion->query($nuevoUsuario);
                volver("login.php");
            }

?>

</body>
</html>