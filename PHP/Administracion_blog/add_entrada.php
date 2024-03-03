<?php
session_start();
?>
<?php
include("./funciones.php");
conectar();
if(isset($_SESSION["admin"])&&$_SESSION["admin"]){
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
    <form action="" method="POST" id="formulario" class="formulario">
    <h1>Añadir entrada</h1>
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre de la entrada</label>
    <input type="text" class="form-control" id="nombre_entrada" name="titulo" aria-describedby="emailHelp" placeholder="Nombre">
    </div>
    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Contenido de la entrada</label>
    <textarea class="form-control" aria-label="With textarea" id="contenido_entrada" name="contenido" placeholder="Entrada..."></textarea>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Categoria</label>
    <select id="categoria_escogida" name="categoria_escogida">
      <?php
      $sql_categorias = "SELECT * from categoria";
      $categoria = $conexion->query($sql_categorias);
      echo "<option value='-1'>Seleccione una opcion</option>";
      while($row=$categoria->fetch_array()){
      echo "<option value='".$row["id"]."'>".$row["nombre_categoria"]."</option>";
      };
      ?>
    </select>
  </div>

  <input id="botonSubmit" type="submit" class="btn btn-warning" value="Añadir Entrada">
  </form>
  <button id="botonVolver" class="btn btn-primary" value="main.php">Volver</button>
    </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="script_entrada.js"></script>
  <?php
    if($_POST){
        $titulo_entrada=$_POST["titulo"];
        $contenido=$_POST["contenido"];
        $id_categoria = $_POST["categoria_escogida"];
        $sql_compr= "SELECT * from entradas where titulo='$titulo_entrada'";
        $resultado_compr=$conexion->query($sql_compr);
        if($resultado_compr->num_rows==1){
          alerta('El nombre de la entrada ya existe.');
        }else{
        $sql = "INSERT into entradas (titulo,contenido,categoria_id) VALUES ('$titulo_entrada','$contenido','$id_categoria')";
        $resultado = $conexion->query($sql); 
        }
        volver("main.php");
    }else if(!isset($_SESSION["logado"])){
      volver("main.php");
    }
    ?>
</body>
</html>
<?php
}else{
  volver("main.php");
}
?>