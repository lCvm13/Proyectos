<?php
$conexion = new mysqli("localhost","root","","personas");
$sexo = $_GET["sexo"];
$cabecera = "<tr>
    <td>Nombre</td>
    <td>Apellidos</td>
    <td>Email</td>
    <td>Sexo</td>
</tr>";
$texto="";
if($sexo=="none"){
    $sql = "SELECT * FROM listado_personas LIMIT 25";
    $resultado = $conexion->query($sql);
    while($row=$resultado->fetch_array()){
    $texto.="<tr>
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
}else{
    $sql = "SELECT * FROM listado_personas where sexo='$sexo' LIMIT 25";
    $resultado = $conexion->query($sql);
    $texto;
    while($row=$resultado->fetch_array()){
    $texto.="<tr>
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
}
die();
?>