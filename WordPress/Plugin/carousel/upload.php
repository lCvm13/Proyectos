<?php
include_once("../../../wp-load.php");

$fileTempPath= $_FILES["uploadfile"]["tmp_name"]; //carpeta y el nombre temporal.
$fileName= $_FILES["uploadfile"]["name"]; //nombre archivo.
$fileSize= $_FILES["uploadfile"]["size"]; //tamaño.
$fileType= $_FILES["uploadfile"]["type"]; //tipo de archivo.

//Averiguar la extension del archivo:
$fileNameCamps = explode(".",$fileName);// Array con las partes del nombre partida por el punto
$fileExtension = strtolower(end($fileNameCamps)); //cojo la extension en minuscula.

//Vamos a sanitizar el nombre de archivo: (para que no tenga caracteres extraños,espacios...)

do{
    $newFileName=md5(time() . $fileName) .".". $fileExtension ;
   $comprobar_nombre=$wpdb->get_results("SELECT * FROM wp_imagenes where nombre='$newFileName'"); 
}while($wpdb->num_rows==1);

// si no quiero hacerlo al azar:
//$newFileName= "palaciochaves_" . $fileName . "." ."fileExtension ;

//echo "El nuevo nombre de archivo es ". $newFileName;

//comprobacion de las extensiones :

//extensiones permitidas
$allowedFileExtensions = array("jpg" , "gif" , "png","pdf");
//tamaño maximo permitido
$max_file_size  = 200000;
// in_array("lo que busco", "donde lo busco");

if(in_array($fileExtension,$allowedFileExtensions) && $fileSize < $max_file_size){

    //definir carpeta donde guardar archivo

    $uploadFileDir = "./imagenes/"; //carpeta donde se van a guardar los archivos.

    $destino_path = $uploadFileDir . $newFileName; //carpeta más el nombre del archivo.
    //mover a donde queremos.
    //el resultado de lo de abajo es un booleano (si se ha movido sin error o no).
    if(move_uploaded_file($fileTempPath , $destino_path)){
        $wpdb->insert(
            'wp_imagenes',
            array(
                'nombre' => $newFileName,
                'descripcion' => $_POST["descripcion"]
            )
        );
        header("location: /wordpress/wp-admin/admin.php?page=carousel");
    }
    else{
        echo "Algo ha ido mal.";
    }


}else{
    echo "Tu extension no es válida o tamaño de archivo excedido.";
}

?>