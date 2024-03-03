<?php
$conexion = new mysqli("localhost","root","","personas");
$pagina = $_GET["pagina"];
$inicio_pagina=($pagina-1)*100;
$sql = "SELECT * from listado_personas LIMIT $inicio_pagina , 100";
$resultado_pagina=$conexion->query($sql);
$cabecera = "<tr>
    <td>Nombre</td>
    <td>Apellidos</td>
    <td>Email</td>
    <td>Sexo</td>
</tr>";
$texto="";
while($row=$resultado_pagina->fetch_array()){
    $texto.="<tr>
            <td>
            ".$row["id"]."
            </td>
            <td>
            ".$row["nombre"]." 
            </td>
            <td>
            ".$row["apellidos"]."
            </td>
            <td>".$row["email"]."
            </td>
            <td>".$row["sexo"]."
            </td>
        </tr>";
    }    
echo $cabecera.$texto;
die();
?>