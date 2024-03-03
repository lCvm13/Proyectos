<?php
$conexion = new mysqli("localhost","root","","personas");
$sql_contar="SELECT COUNT(*) as numero_personas from listado_personas";
$paginadores=$conexion->query($sql_contar);

while($paginas = $paginadores->fetch_array()){
    $cantidad = $paginas["numero_personas"]; 
 }
$numero_paginas = ceil($cantidad / 100);
//$inicio = ($paginador-1)*10;

$sql = "SELECT * FROM listado_personas LIMIT 100";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Ajax</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body style="display:flex;flex-direction:column">
    <h1 style="text-align:center">Personas</h1>
    <div style="align-self: center;">
        <button id="male">Hombres</button>
        <button id="female">Mujeres</button>
        <button id="none">Reiniciar filtro</button>
    </div>
<table class="table" style="width:80vw;height:80vh;align-self: center;">
    <tr>
        <td>Nombre</td>
        <td>Apellidos</td>
        <td>Email</td>
        <td>Sexo</td>
    </tr>
  <?php
    while($row=$resultado->fetch_array()){
        ?>
        <tr>
            <td>
               <?php
            echo $row["nombre"];
                ?> 
            </td>
            <td>
               <?php
            echo $row["apellidos"];
                ?> 
            </td>
            <td>
               <?php
            echo $row["email"];
                ?> 
            </td>
            <td>
               <?php
            echo $row["sexo"];
                ?> 
            </td>
        </tr>
        <?php
    }
  ?>
</table>
<ul class='pagination justify-content-center'>
    <?php
    for($i=1;$i<=$numero_paginas;$i++){
        echo "<li><input type='button' class='page-link' value=$i></li>";
    }
    ?>
    </ul>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>