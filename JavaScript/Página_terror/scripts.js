//------------------------------------------------------- //
// Variables usadas
import { descripcionHistorias } from "./arrayImportar.js";

var botonTema= document.getElementById("botonTema");
var iconoTema = document.getElementById("iconoDiaNoche");
var booleanTema=true;
var body=document.getElementById("body");
var parrafos= document.getElementsByTagName("p");
var titulosh1=document.getElementsByTagName("h1");
var titulosh2=document.getElementsByTagName("h2");
var label = document.getElementsByTagName("label");
var cabecera = document.getElementsByClassName("list-group-item");
botonTema.addEventListener("click",function(){cambiarIconoTema()});
// Comprueba si el usuario ha elegido un tema anteriormente. Si existe, lo aplica.

document.addEventListener("DOMContentLoaded",function(){
if(localStorage.getItem("tema")!=null){
    if(localStorage.getItem("tema")=="claro"){
        cambiarTema(true);
        booleanTema=true;
    }else if(localStorage.getItem("tema")=="oscuro"){
        cambiarTema(false);
        booleanTema=false;
    }
}
});
// Funcion que cambia el tema de la web en claro u oscuro y lo añade al localStorage
function cambiarTema(boolean){
    if(boolean){
    body.style=`background-color:black;`;
    
    if(parrafos.length>0){
       for(let i=0;i<parrafos.length;i++){
        parrafos[i].style="color:white!important";
    } 
    }
    if(titulosh1.length>0){
      for(let i=0;i<titulosh1.length;i++){
        titulosh1[i].style="color:white!important";
    }  
    }
    if(titulosh2.length>0){
     for(let i=0;i<titulosh2.length;i++){
        titulosh2[i].style="color:white!important";
    }
    }
    if(label.length>0){
        for(let i=0;i<label.length;i++){
            label[i].style="color:white!important";
       }
    }
    if(cabecera.length>0){
        for(let i=0;i<cabecera.length;i++){
            cabecera[i].style="background:linear-gradient(to right, rgba(0, 0, 0, 0.473), rgba(128, 128, 128, 0.418), rgba(128, 128, 128, 0.377))!important";
        }
    }
    
    localStorage.setItem("tema","claro");
    }else{
    body.style=`background-color:darkgrey;`;
    
    if(parrafos.length>0){
        for(let i=0;i<parrafos.length;i++){
         parrafos[i].style="color:black!important";
     } 
     }
     if(titulosh1.length>0){
       for(let i=0;i<titulosh1.length;i++){
         titulosh1[i].style="color:black!important";
     }  
     }
     if(titulosh2.length>0){
      for(let i=0;i<titulosh2.length;i++){
         titulosh2[i].style="color:black!important";
     }   
    
    }
    if(label.length>0){
        for(let i=0;i<label.length;i++){
            label[i].style="color:black!important";
       }
    }
    if(cabecera.length>0){
        for(let i=0;i<cabecera.length;i++){
            cabecera[i].style="background:linear-gradient(to right, rgb(39 38 38 / 47%), rgb(255 255 255 / 42%), rgb(213 213 213 / 38%))!important";
        }
    }
    localStorage.setItem("tema","oscuro");
    }
    return;
}
//Funcion que crea la animacion de el boton de cambiar de tema y el icono para que varie segun el tema en el que este.
function cambiarIconoTema(){
    botonTema.style=`animation:
                    animacionTema 0.5s ease;
                    animation-iteration-count: 1;`;
    iconoTema.removeAttribute("class");
    if(booleanTema){
       iconoTema.setAttribute("class","bi bi-moon-stars-fill"); 
    }else{
        iconoTema.setAttribute("class","bi bi-brightness-high-fill");
    }
    if(booleanTema){
        booleanTema=false;
    }else{
        booleanTema=true;
    }
    cambiarTema(booleanTema);
    timeout();
} 
// Funcion que tras acabar la animacion del icono de tema, la elimine.
function timeout() {
        setTimeout(eliminarAnimacion, 500);
    }
function eliminarAnimacion(){
    botonTema.style.removeProperty("animation");
}

// AÑADIR A LAS IMAGENES LOS EVENTOS, las rutas y los alt //
var imagenes = ["./imagenes/exorcista.jpg","./imagenes/jigsaw.jpg","./imagenes/michael.jpg"];
var imagenesAlt=["Imagen de la niña del exorcista","Imagen de jigsaw","Imagen de Michael Mayers"];
var imagenRota = document.getElementById("imagenesRota");
imagenRota.style=`
    width:200px;
    height:100px;
    border: 2px;
    border-style: solid;
    animation:
    animacionBordeModal 2s linear infinite`;

imagenRota.addEventListener("click",function(){elegirCancion(imagenRota.name)});

// AÑADIR LAS FUNCIONES A LAS IMAGENES //

//Funcion que crea un carousel de imagenes para decidir la cancion que se quiera poner de fondo.

var contadorImagenes=0;

function rotarImagenes(){
    if(contadorImagenes>=2){
        contadorImagenes=0;
    }else{
        contadorImagenes++;
    }
    imagenRota.setAttribute("src",imagenes[contadorImagenes]);
    imagenRota.setAttribute("alt",imagenesAlt[contadorImagenes]);
    imagenRota.setAttribute("name",contadorImagenes);
    imagenRota.addEventListener("click",function(){elegirCancion(imagenRota.name)});
    
}
var toggle=false;
var cancion;
// Funcion que recoge la cancion que se quiera poner de fondo segun su imagen.
function elegirCancion(valor){
    if(cancion!=undefined){
        cancion.pause();
        cancion.currentTime=0;
        sonarCancion();
    }
    switch(true){
        case valor=="0":
            cancion=document.getElementById("exorcista");
        break;
        case valor=="1":
            cancion=document.getElementById("jigsaw");
        break;  
        case valor=="2":
            cancion=document.getElementById("michael");
        break;
        default:
            cancion=document.getElementById("cancion");
        break;
    }
}
// Aplicacion de decoracion al icono del boton de musica para saber si se está reproduciendo o no.
var iconoMusica=document.getElementById("iconoMusica");
iconoMusica.style=`text-decoration: line-through;
text-decoration-color: red;
text-decoration-thickness: 3px;`;
// VARIABLES Y FUNCIONES PARA HACER EL TOGGLE DE MUSICA
var botonToggleMusica = document.getElementById("botonToggleMusica");
botonToggleMusica.addEventListener("click",function(){sonarCancion()});
function sonarCancion(){
    if(cancion==undefined){cancion=document.getElementById("cancion");}
    if(toggle==false){
        iconoMusica.style.removeProperty("text-decoration");
        toggle=true;
        cancion.loop=true;
        cancion.play();
        
    }else{
        iconoMusica.style=`text-decoration: line-through;
text-decoration-color: red;
text-decoration-thickness: 3px;`;
        toggle=false;
        cancion.pause();
        cancion.currentTime=0;
    }
}

var botonAjustes = document.getElementById("botonAjustes");
var temporizador;
var botonCerrarModal= document.getElementById("botonCerrarModal");

botonAjustes.addEventListener("click",function(){temporizador = setInterval(function () {rotarImagenes()}, 2000);});
botonCerrarModal.addEventListener("click",function(){clearInterval(temporizador)});


// ----------------------------------------------- //

// Funciones para abrir menu lateral

var botonAbrirM=document.getElementById("openbtn");
var botonCerrarM=document.getElementById("closebtn");

botonAbrirM.addEventListener("click",function(){openNav()});
botonCerrarM.addEventListener("click",function(){closeNav()});

function openNav() {
    document.getElementById("menuLateral").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    botonAbrirM.style.display="none";
  }
  
export function closeNav() {
    document.getElementById("menuLateral").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    botonAbrirM.style.display="block";
  }
  
// VARIABLES Y FUNCIONES PARA EL BUSCADOR SITUADO ARRIBA A LA DERECHA EN LA PAGINA WEB. //

var campoBuscador=document.getElementById("search");

var botonBuscador=document.getElementById("botonBusqueda");

botonBuscador.addEventListener("click",function(){ realizarBusqueda()});

campoBuscador.addEventListener("focus",function(){
    
    document.addEventListener("keydown" , function (event){
        if(event.which==13){
            realizarBusqueda();
        }
       
    });
});
// Funcion que comparan  palabras clave al resultado de la busqueda del usuario para redirigirlos a una pestaña con enlaces relacionados con la busqueda
function realizarBusqueda(){

    let arrayAcertijos = [["agujero","cuanto","más","quites","grande","vuelve"], 
    ["amarillo","dentro","verde","fuera","espera"],
    ["nombras","eliminas","existencia"],
    ["vuela","alas","llora","ojos"],
    ["ligero","viento","ver","tocar"]];

    let arrayHistorias=[["gato","puerta","solo","vivo","arañara","noche","extraño","entrañable","solo","habitacion"],
    ["amanda","habitacion","deberes","madre","armario","escaleras","armario","demacrada","envejecida"],
    ["accidente","carretera","michael","amigo","entierro","fotografia","album","foto","camara","espejo","baño"],
    ["llanto","hermano","cuerpo","cadaver","matar","pozo","desaparecido","desaparecer","magia","asesinato","amor","retorcido"],
    ["tiempo","habitación","sueño","pesadilla","hora","armario","golpes","ruido","muerte","pecho","atravesar","ser","humanoide","alto","grande","despierto","movil","telefono"]];
    let aBAcertijos = [];
    let aBHistorias = [];
    
    let busqueda = campoBuscador.value;

    for (let i=0;i<arrayAcertijos.length;i++){
        for(let j=0;j<arrayAcertijos[i].length;j++){
            if(busqueda.toLowerCase().includes(arrayAcertijos[i][j])){
                aBAcertijos.push(i);
                break;
            }
        }
    }
    for (let i=0;i<arrayHistorias.length;i++){
        for(let j=0;j<arrayHistorias[i].length;j++){
            if(busqueda.toLowerCase().includes(arrayHistorias[i][j])){
                aBHistorias.push(i);
                break;
            }

        }
    }
    

    sessionStorage.setItem("aBAcertijos",aBAcertijos);
    sessionStorage.setItem("aBHistorias",aBHistorias);
    

    //event.preventDefault();
    switch (true){
        case (sessionStorage.getItem("aBAcertijos").length>0)||(sessionStorage.getItem("aBHistorias").length>0):
           location.href="Enlaces.html";
        break;
        default:
            alert("Su búsqueda no coincide con ningún registro en nuestra página web, pruebe otra cosa.");
        break;
    }

    }


// Funciones y variables que crea 20 gotas de sangre que se iran moviento a lo largo de la altura maxima de la pantalla y explotarán en un alto de la pantalla al azar.
//Dichas funciones son infinitas.

var sangre = [];
var posicionesIniciales= [];
var posiciones=[];
var posicionFinalRandom= [];

for(let i=0;i<20;i++){
    do{
        var random=Math.floor((Math.random() * -100) + 0);
    }while(random%50!=0);
    var anchuraRandom=Math.floor(Math.random() * window.innerWidth-30);
    sangre.push(document.createElement("img"));
    sangre[i].setAttribute("src","./imagenes/gota_sangre.png");
    sangre[i].style=`position:absolute;left:${anchuraRandom}px;`;
    posicionesIniciales.push(random);
    posiciones.push(random);
    document.body.appendChild(sangre[i]);
}
temporizador = setInterval(function () {
    for (let i=0;i<sangre.length;i++){
    do{
        var random=Math.floor(Math.random() * window.innerHeight);
    }while(random%50!=0 && random>posicionesIniciales[i]);

    posicionFinalRandom.push(random);
    }
    
   for (let i=0;i<sangre.length;i++){
    if(posiciones[i]!=posicionFinalRandom[i]){
        let calculo = posiciones[i]+50;
       sangre[i].style.top=calculo+"px";
       posiciones[i]=calculo;
    }else{
        sangre[i].setAttribute("src","./imagenes/explosion_sangre.png");
        setTimeout(function(){reset(i)},200);
    }
   }
}, 500);
//Funcion que reiniciara las gotas de sangre al llegar a su destino.
function reset(objeto){
    var anchuraRandom=Math.floor(Math.random() * window.innerWidth-30);
    sangre[objeto].style.top=posicionesIniciales[objeto]+"px";
    sangre[objeto].setAttribute("src","./imagenes/gota_sangre.png");
    posiciones[objeto]=posicionesIniciales[objeto];
    sangre[objeto].style.left=anchuraRandom+"px";
}
