<?php
/*
Plugin Name: Carousel
Plugin URI: #
Description: Plugin que crea carouseles de imagenes y los edita.
Author: Yo
Version: 0.1
Author URI: #
*/

global $jal_db_version;
$jal_db_version = '1.0';

function load_external_css(){
   wp_enqueue_style( 'jquery-ui-style', plugins_url().'/carousel/css/estilos.css', true);
   wp_enqueue_style('prefix_bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
   wp_enqueue_style('bootstrap_icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css');

}
add_action( 'wp_enqueue_scripts', 'load_external_css');
add_action( 'admin_enqueue_scripts', 'load_external_css');

function load_js(){
  wp_enqueue_script('sweetalert', 'https://cdn.jsdelivr.net/npm/sweetalert2@11');

}
add_action('admin_enqueue_scripts','load_js');
add_action('wp_enqueue_scripts','load_js');

function load_jquery(){
  wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.1.js');

}
add_action("admin_enqueue_scripts","load_jquery");
add_action("wp_enqueue_scripts","load_jquery");
function load_external(){
  wp_enqueue_script('external_js', plugins_url().'/carousel/script.js');
}
add_action("admin_enqueue_scripts","load_external");
add_action("wp_enqueue_scripts","load_external");

function load_bootstrap_js(){
    wp_enqueue_script("bootstrap_js","https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js");
}
add_action("admin_enqueue_scripts","load_bootstrap_js");
add_action("wp_enqueue_scripts","load_bootstrap_js");

function jal_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'imagenes';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        nombre varchar(255) NOT NULL,
		fecha datetime DEFAULT current_timestamp() NOT NULL,
        descripcion varchar(255) not null
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}

register_activation_hook( __FILE__, 'jal_install' );

function jal_install_dos() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'carouseles';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        nombre varchar(255) NOT NULL,
		fecha datetime DEFAULT current_timestamp() NOT NULL,
        shortcode varchar(255) not null
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}

register_activation_hook( __FILE__, 'jal_install_dos' );

function jal_install_tres() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'imagenes_carouseles';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        id_carousel mediumint(9),
        id_imagen mediumint(9),
        FOREIGN KEY (id_carousel) REFERENCES wp_carouseles(id),
        FOREIGN KEY (id_imagen) REFERENCES wp_imagenes(id)
		
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}

register_activation_hook( __FILE__, 'jal_install_tres' );


function menu_carousel() {
    add_menu_page(
    'Carousel-imagenes',// page title
    'Carousel',// menu title
    'manage_options',// capability
    'carousel',// menu slug
    'imprimir_pagina_principal', // callback function
    'dashicons-images-alt2' //imagen usada para el icono del menu
    );
    add_submenu_page( 'carousel', 'Añadir Imagenes', 'Añadir Imagenes', 'manage_options', 'imprimir_pagina_principal', 'imprimir_pagina_principal');
    add_submenu_page( 'carousel', 'Diseñar Carousel', 'Diseñar Carousel', 'manage_options', 'pagina_diseño_carousel', 'pagina_diseño_carousel');
    add_submenu_page( 'carousel', 'Carouseles', 'Carouseles', 'manage_options', 'imprimir_carouseles', 'imprimir_carouseles');
    add_submenu_page( 'carousel', 'Imagenes', 'Imagenes', 'manage_options', 'imprimir_imagenes', 'imprimir_imagenes');
    remove_submenu_page( 'carousel','carousel' ); 
   } 
   add_action( 'admin_menu', 'menu_carousel' ); 
   function imprimir_pagina_principal() {
    ?>
        <h1>Añadir Imagen Carousel</h1>
        <form method='POST' id="form_imagenes" action='<?php echo plugins_url( 'upload.php', __FILE__ ); ?>' enctype='multipart/form-data'>
            <div>
                <span>Introduce el fichero a subir</span>
                <input type='file' name='uploadfile'>
            </div>
            <div>
                <label for="descripcion">Descripcion de imagen</label>
            <textarea type="text" name="descripcion"></textarea> 
            </div>
           
            <input type='submit' value='Enviar'>
        </form>
<?php
   } 
   global $imagenes_db;
   $imagenes_db=$wpdb->get_results("SELECT * FROM wp_imagenes");
   function pagina_diseño_carousel(){
    ?>
    <form method='POST' id="form_carousel" action='<?php echo plugins_url( 'add_carousel.php', __FILE__ );?>'>
    <h1>Diseña tu carousel</h1>
    <div class="div-form">
        <label for="name">Nombre del carousel</label>
        <input type="text" name="nombre_carousel">  
    </div>
    <h3>Elige las imagenes</h3>
    
    <div id="carouseles">
        
        <?php
    global $wpdb;
    global $imagenes_db;
    foreach($imagenes_db as $results => $imagen) {
        $nombre_imagen = $imagen->nombre;
        $descripcion_imagen = $imagen->descripcion;
        $id_imagen = $imagen->id;
        ?>
        <div>
        <img src="<?php echo  plugin_dir_url( __FILE__ ) . 'imagenes/'.$nombre_imagen; ?>" alt="<?php echo $descripcion_imagen; ?>" data-nombre="<?php echo $nombre_imagen;?>">
        <input name='imagenes[]' type='checkbox' value='<?php echo $id_imagen; ?>'>
        </div>
        <?php
        }
        ?>
    </div>
    <input id="submit_imagenes" type="submit" class="btn btn-danger" value="Añadir">
    </form>
    <?php
        
   }
global $wpdb;

global $consulta_carouseles;

$consulta_carouseles = $wpdb->get_results("SELECT 
wp_carouseles.id as id_carouseles,
wp_carouseles.nombre as nombre_carouseles,
wp_carouseles.shortcode as carouseles_shortcode,
GROUP_CONCAT(wp_imagenes.nombre) as nombre_imagenes,
GROUP_CONCAT(wp_imagenes.descripcion) as alt_imagenes
FROM 
wp_imagenes_carouseles
JOIN 
wp_imagenes ON wp_imagenes.id = wp_imagenes_carouseles.id_imagen
JOIN 
wp_carouseles ON wp_carouseles.id = wp_imagenes_carouseles.id_carousel
GROUP BY 
wp_carouseles.id
ORDER BY 
wp_carouseles.id;");
function imprimir_carouseles(){
    ?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID del carousel</th>
      <th scope="col">Nombre del carousel</th>
      <th scope="col">Shortcode del carousel</th>
      <th scope="col">Imagenes</th>
      <th></th>
      </tr>
  </thead>
  <tbody>
      <?php
    global $consulta_carouseles;
    foreach($consulta_carouseles as $results=>$carousel){
        $nombre_carousel = $carousel->nombre_carouseles;
        $nombre_imagen = explode(",",$carousel->nombre_imagenes);
        $descripcion_imagen = explode(",",$carousel-> alt_imagenes);
        $shortcode = $carousel->carouseles_shortcode;
        $id_carousel = $carousel-> id_carouseles;
?>
    <tr>
      <th scope="row"><?php echo $id_carousel; ?></th>
      <td><?php echo $nombre_carousel; ?></td>
      <td><?php echo '['.$shortcode.']'; ?></td>
      <td><?php for($i=0;$i<count($nombre_imagen);$i++){
        echo "<span data-nombre='$nombre_imagen[$i]'>$nombre_imagen[$i]</span>
        <br>";
      }; ?></td>
      <td><a href="<?php echo plugin_dir_url( __FILE__ ).'borrar_carousel.php?id='.$id_carousel ;?>"><i class="bi bi-trash3"></i></a></td>
    </tr>
      
        <?php
    }
    ?>
    </tbody>
</table>
<?php
   }


foreach ($consulta_carouseles as $results => $carousel) {
   global $nombre_imagen;
   $nombre_imagen = explode(",", $carousel->nombre_imagenes);
    global $descripcion_imagen;
    global $id_carousel;
    $descripcion_imagen = explode(",", $carousel->alt_imagenes);
    //add_shortcode("carousel_id" . $carousel->id_carouseles, crear_carousel($nombre_imagen, $descripcion_imagen));
    add_shortcode("carousel".$carousel->id_carouseles , 'crear_carousel');
    
}

function crear_carousel() {
    global $nombre_imagen;
    global $descripcion_imagen;
    $html = "<div id='carouselExampleDark' class='carousel carousel-dark slide'>
    <div class='carousel-indicators'>
    <button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>";
    for ($i = 1; $i < count($nombre_imagen); $i++) {
        
        $html .= "<button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='$i' aria-label='Slide " . ($i + 1) . "'></button>";
    }
    $html .= "</div>
  <div class='carousel-inner'>";
    for ($i = 0; $i < count($nombre_imagen); $i++) { 
        $html .= "<div class='carousel-item" . ($i == 0 ? " active" : "") . "' data-bs-interval='10000'>
      <img src=" . plugin_dir_url(__FILE__) . 'imagenes/' . $nombre_imagen[$i] . " class='d-block w-100' alt='$descripcion_imagen[$i]'>
      <div class='carousel-caption d-none d-md-block'>
        <p>$descripcion_imagen[$i]</p>
      </div>
    </div>";
    }
    $html .= "</div>
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
  function imprimir_imagenes(){
  global $imagenes_db;
  ?>
  <table class="table">
<thead>
  <tr>
    <th scope="col">ID de la imagen</th>
    <th scope="col">Nombre de la imagen</th>
    <th scope="col">Descripción de la imagen</th>
    <th scope="col">Fecha de subida</th>
    <th></th>
    </tr>
</thead>
<tbody>
    <?php
  global $consulta_carouseles;
  foreach($imagenes_db as $results => $imagen) {
      $nombre_imagen = $imagen->nombre;
      $descripcion_imagen =$imagen->descripcion;
      $fecha=$imagen->fecha;
      $id_imagen = $imagen->id;
?>
  <tr>
    <th scope="row"><?php echo $id_imagen; ?></th>
    <td><?php echo $nombre_imagen; ?></td>
    <td><?php echo $descripcion_imagen; ?></td>
    <td><?php echo $fecha; ?></td>
    <td><a href="<?php echo plugin_dir_url( __FILE__ ).'borrar_imagen.php?id='.$id_imagen ;?>"><i class="bi bi-trash3"></i></a></td>
  </tr>

      <?php
  }
  ?>
  </tbody>
</table>
<?php
  }
  
   ?>
