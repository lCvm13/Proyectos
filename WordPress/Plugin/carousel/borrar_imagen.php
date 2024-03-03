<?php
include_once("../../../wp-load.php");

$id_imagen = $_GET["id"];

$wpdb->delete(
    'wp_imagenes_carouseles',
    array(
        'id_imagen' => $id_imagen,
    )
);
$wpdb->delete(
    'wp_imagenes',
    array(
        'id' => $id_imagen,
    )
);
header("location: /wordpress/wp-admin/admin.php?page=imprimir_imagenes");
die();
?>