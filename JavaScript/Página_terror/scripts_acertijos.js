'use strict';
// VARIABLES PARA LAS HISTORIAS junto con sus eventos //
import { closeNav } from "./scripts.js";

import { descripcionAcertijos } from "./arrayImportar.js";


var titulosAcertijos = ["Primer Acertijo", "Segundo Acertijo", "Tercer acertijo", "Cuarto acertijo", "Último acertijo"];

var pistasAcertijos = ["Probablemente lo has hecho de pequeño, ¿en la playa quizás?",
    "Es un juego de palabras con la respuesta en el mismo acertijo",
    "¿Te has asustado?, y... ¿has gritado?",
    "Mira el cielo y quizás puedas ver la respuesta",
    "¡No mires debajo de ti!, o... si."];

var botonPista = document.getElementById("botonPista");
botonPista.addEventListener("click", mostrarModalPista);
let boolean = true;
//Cancelamos la animacion de mouseover si el ancho de la pantalla es menor a 768px (para que no funcione en moviles o tablets).
if (boolean && window.innerWidth>768) {
    boolean = false;
    botonPista.addEventListener("mouseover", crearAnimacion);
}
function crearAnimacion() {
    botonPista.style = `animation:
    botonSorpresa 0.5s ease-in-out;
    animation-fill-mode: forwards;`;
}

var modalPista = document.getElementById("modal-pista");

var botonPistaOcultar = document.getElementById("botonPistaOcultar");

botonPistaOcultar.addEventListener("click", ocultarModalPista);

var botonCP = document.getElementById("botonCP");
botonCP.addEventListener("click", function () {eliminarAnimacion()});

var botonCancelar = document.getElementById("botonCancelar");
botonCancelar.addEventListener("click", function () {eliminarAnimacion()});

//Funcion que elimina la animacion de mouseover al hacerla una vez.

function eliminarAnimacion(){
    botonPista.removeEventListener("mouseover", crearAnimacion);
    botonPista.style.removeProperty(`animation`);
    botonPista.style.removeProperty("width");
}
var botonAnterior = document.getElementById("botonAnterior");

var botonSiguiente = document.getElementById("botonSiguiente");

var contador = 0;

var cuerpoPagina = document.getElementsByClassName("cuerpoPagina");

var tituloActual = document.createElement("h1");

var descripcionActual = document.createElement("p");

var botonesRespuestas = [document.createElement("button"),document.createElement("button"),document.createElement("button"),document.createElement("button")];

var posiblesRespuestas = [ ["Agujero","Camino","Esperanza","Oscuridad"] ,["Pera","Limón","Manzana","Lechuga"],["Silencio","Eco","Vacio","Sombra"],["Nube","Pájaro","Pensamiento","Papel quemándose"],["Sombra","Sueño","Pensamiento","Luz"]];
var respuestasCorrectas =["Agujero","Pera","Silencio","Nube","Sueño"];
crearContenido(titulosAcertijos, descripcionAcertijos);

botonAnterior.addEventListener("click", function () { botonAnteriorFuncion(titulosAcertijos, descripcionAcertijos) });
botonSiguiente.addEventListener("click", function () { botonSiguienteFuncion(titulosAcertijos, descripcionAcertijos) });

var divRespuestas= document.getElementById("respuestas");
cuerpoPagina[0].insertBefore(tituloActual,divRespuestas);
cuerpoPagina[0].insertBefore(descripcionActual,divRespuestas);


for(let i=0;i<botonesRespuestas.length;i++){
    botonesRespuestas[i].setAttribute("class","btn btn-danger");
    botonesRespuestas[i].setAttribute("value",i);
    botonesRespuestas[i].addEventListener("click",function(){comprobarRespuesta(botonesRespuestas[i].value)});
    divRespuestas.appendChild(botonesRespuestas[i]);
}


 // Funcion que segun la variable contador que nos dice en que acertijo estamos crea el titulo, el contenido y los botones del acertijo.
function crearContenido(arrayTitulo, arrayDescripcion) {
    if(localStorage.getItem("valorBusqueda")!=null){
        contador= localStorage.getItem("valorBusqueda");
        localStorage.removeItem("valorBusqueda");
    }
    tituloActual.innerHTML = arrayTitulo[contador];
    descripcionActual.innerHTML = arrayDescripcion[contador];
    let array=posiblesRespuestas[contador];
    array.sort(function (){return Math.random() - 0.5});

    for (let i=0;i<botonesRespuestas.length;i++){
        botonesRespuestas[i].innerHTML=array[i];
    } 
}
// Funcion que comprueba si la respuesta que ha introducido el usuario corresponde a la respuesta correcta
// Si acierta sale un modal para pasar a la siguiente pregunta, si falla le sale un screamer.
function comprobarRespuesta(valor){

    if (botonesRespuestas[valor].innerHTML==respuestasCorrectas[contador]){
        
        Swal.fire({
            title: '¡Has acertado! ¿Quieres pasar al siguiente acertijo?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Sí',
            denyButtonText: 'No',
            allowOutsideClick:false,
            customClass: {
              actions: 'my-actions',
              cancelButton: 'order-1 right-gap',
              confirmButton: 'order-2',
              denyButton: 'order-3',
            },
          }).then((result) => {
            if (result.isConfirmed) {
              contador++;
              crearContenido(titulosAcertijos,descripcionAcertijos);
            };
          })
    }else{
        botonScreamer();
    }
}
// Eventos para los botones anterior y siguiente //
function botonAnteriorFuncion(arrayTitulo, arrayDescripcion) {
    if (contador > 0) {
        contador--
    } else {
        contador = (arrayTitulo.length - 1);
    }
    crearContenido(arrayTitulo, arrayDescripcion);

}

function botonSiguienteFuncion(arrayTitulo, arrayDescripcion) {

    if (contador < (arrayTitulo.length - 1)) {
        contador++
    } else {
        contador = 0;
    }
    crearContenido(arrayTitulo, arrayDescripcion);

}
//Funcion que muestra el modal de la pista y añade la pista del acertijo actual segun la variable contador
function mostrarModalPista() {
    if (contador == 2) {
        botonScreamer();
    }
    modalPista.style.display = "table";
    botonPistaOcultar.style.display = "inline-block";
    let parrafo = document.getElementById("pistaAqui");
    parrafo.innerHTML = pistasAcertijos[contador];
    return;
}


// Funcion que oculta el modal usado en las paginas web.

function ocultarModalPista() {
    modalPista.style.display = "none";
    botonPistaOcultar.style.display = "none";
    return;
}
// Creacion de los enlaces de la página de acertijos que se insertaran en el modal
var divEnlacesM=document.getElementById("EnlacesDPagina");

var enlacesPagina=[] ;

for(let i=0;i<titulosAcertijos.length;i++){
    enlacesPagina[i]=document.createElement("button");
    enlacesPagina[i].setAttribute("value",i);
    enlacesPagina[i].setAttribute("class","btn btn-warning");
    enlacesPagina[i].innerHTML=titulosAcertijos[i];
    enlacesPagina[i].addEventListener("click",function(){irEnlace(enlacesPagina[i].value)});
    enlacesPagina[i].setAttribute("data-bs-dismiss","modal");
    divEnlacesM.appendChild(enlacesPagina[i]);
}
//Funcion que dará funcionalidad a los enlaces creados anteriormente
function irEnlace(valor){
    contador=valor;
    crearContenido(titulosAcertijos, descripcionAcertijos);
    closeNav();
}
var modal= document.getElementById("staticBackdrop2");


// Funcion que aplica un video screamer a un botón.
function botonScreamer() {
    let video = document.getElementById("video");
    let scare = document.getElementById("scareDiv");
    scare.style = "display:flex;position:fixed; height:100vh;width: 100hw;justify-content:center;";
    modal.style="display:none!important";
    const { documentElement } = document;
    if (documentElement.requestFullscreen) documentElement.requestFullscreen();
    else if (documentElement.mozRequestFullScreen) documentElement.mozRequestFullScreen();
    else if (documentElement.webkitRequestFullscreen) documentElement.webkitRequestFullscreen();
    else if (documentElement.msRequestFullscreen) documentElement.msRequestFullscreen();
    video.play();
    timeout();
}
// Funcion que oculta el screamer y vuelve a donde estaba el usuario antes de éste
function ocultarVideo() {
    let video = document.getElementById("video");
    let scare = document.getElementById("scareDiv");
    video.pause();
    video.currentTime = 0;
    scare.style.display = "none";
    modal.style="display:block!important";
    eliminarAnimacion();
    if (document.fullscreenElement) {
        document.exitFullscreen()
    }
}
/* Funcion que cronometra un tiempo en milisegundos para realizar una accion. 
En este caso se ha cronometrado para que al segundo pare el screamer si sucede y volver a la normalidad.
*/
function timeout() {
    setTimeout(ocultarVideo, 1000);

}
// Añadimos en una cookie los elementos favoritos del usuario
var fechaExpiracion = new Date();
fechaExpiracion.setDate(fechaExpiracion.getDate()+10);
var cookies=document.cookie.split('; ');
var botonFavoritos=document.getElementById("botonFavorito");
botonFavoritos.addEventListener("click",function(){
    let añadir=true;
    for(let i=0;i<cookies.length;i++){
        if(cookies[i].endsWith(contador)){
            añadir=false;
            break;
        }
    }
    if(añadir){
        document.cookie=`acertijo${contador}=${contador};expires=${fechaExpiracion.toGMTString()}`;
    }else{
        alert("Ya está añadido a favoritos");
    }
    
});