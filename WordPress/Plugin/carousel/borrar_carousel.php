<?php
include_once("../../../wp-load.php");

$id_carousel = $_GET["id"];

$wpdb->delete(
    'wp_imagenes_carouseles',
    array(
        'id_carousel' => $id_carousel,
    )
);
$wpdb->delete(
    'wp_carouseles',
    array(
        'id' => $id_carousel,
    )
);
header("location: /wordpress/wp-admin/admin.php?page=imprimir_carouseles");
die();
?>