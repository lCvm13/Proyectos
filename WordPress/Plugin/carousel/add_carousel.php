<?php
include_once("../../../wp-load.php");
// Creamos una id aleatoria para insertar en la base de datos un carousel
$numero_random;
do{
$numero_random = random_int(1, 999999);
$sql = $wpdb->get_results("SELECT * FROM wp_carouseles where id=$numero_random");
}while($wpdb->num_rows==1);
// recogemos el nombre del carousel que el usuario ha decidido.
$nombre_carousel= $_POST["nombre_carousel"];
$wpdb->insert(
    'wp_carouseles',
    array(
        'id' => $numero_random,
        'nombre' => $nombre_carousel,
        'shortcode' => "carousel".$numero_random
    )
);


// recogemos las imagenes que el usuario ha elegido.
$imagenes_seleccionadas=$_POST["imagenes"];

for($i=0;$i<count($imagenes_seleccionadas);$i++){
    $numero_parseado= intval($imagenes_seleccionadas[$i]);
   $variable= $wpdb->insert(
        'wp_imagenes_carouseles',
        array(
            'id_carousel' => $numero_random,
            'id_imagen' => $numero_parseado
        )
    );
    
}
/*
//define function to show output

function crear_carousel(){
    $html ="<div id='carouselExampleDark' class='carousel carousel-dark slide'>
    <div class='carousel-indicators'>
    <button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>";
    for($i=1;$i<count($imagenes_seleccionadas);$i++){
        
       $html.="<button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='$i' aria-label='Slide ". $i+1 ."'></button>";
        
    }
    $html.="</div>
  <div class='carousel-inner'>";
    foreach($wpdb->get_results("SELECT * FROM wp_imagenes") as $results => $imagen){
        $nombre_imagen = $imagen->nombre;
        $descripcion_imagen = $imagen->descripcion;
    $html.="<div class='carousel-item active' data-bs-interval='10000'>
      <img src=".plugin_dir_url( __FILE__ ) . 'imagenes/'.$nombre_imagen." class='d-block w-100' alt='$descripcion_imagen'>
      <div class='carousel-caption d-none d-md-block'>
        <p>$descripcion_imagen</p>
      </div>
    </div>";
    }
  $html.="</div>
  <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleDark' data-bs-slide='prev'>
    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
    <span class='visually-hidden'>Previous</span>
  </button>
  <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleDark' data-bs-slide='next'>
    <span class='carousel-control-next-icon' aria-hidden='true'></span>
    <span class='visually-hidden'>Next</span>
  </button>
</div>";

    return $html;
   } 

   
   add_shortcode( "carousel id='$numero_random'" , 'crear_carousel' );
   */
   header("location: /wordpress/wp-admin/admin.php?page=pagina_diseño_carousel");
   
?>