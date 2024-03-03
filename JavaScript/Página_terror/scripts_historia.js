'use strict';
// VARIABLES PARA LAS HISTORIAS //

import { descripcionHistorias } from "./arrayImportar.js";
import { closeNav } from "./scripts.js";
import { cookies } from "./arrayImportar.js";
var titulosHistorias = ["Mi mascota", "Yo también" , "Fotografías", "La historia de un asesino", "Tiempo"];

var botonAnterior = document.getElementById("botonAnterior");

var botonSiguiente = document.getElementById("botonSiguiente");

var contador=0;

var cuerpoPagina=document.getElementsByClassName("cuerpoPagina");

var tituloActual= document.createElement("h1");

var descripcionActual= document.createElement("p");

crearContenido(titulosHistorias, descripcionHistorias);

botonAnterior.addEventListener("click", function () { botonAnteriorFuncion(titulosHistorias, descripcionHistorias) });
botonSiguiente.addEventListener("click", function () { botonSiguienteFuncion(titulosHistorias, descripcionHistorias) });

cuerpoPagina[0].appendChild(tituloActual);
cuerpoPagina[0].appendChild(descripcionActual);



// Funcion que segun la variable contador que nos dice en que historia estamos crea el titulo y el contenido

function crearContenido(arrayTitulo, arrayDescripcion) {
    if(localStorage.getItem("valorBusqueda")!=null){
        contador= localStorage.getItem("valorBusqueda");
        localStorage.removeItem("valorBusqueda");
    }
    
    tituloActual.innerHTML = arrayTitulo[contador];
    descripcionActual.innerHTML = arrayDescripcion[contador];    
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
// Creacion de los enlaces de la página de historia que se insertaran en el modal

var divEnlacesM=document.getElementById("EnlacesDPagina");

var enlacesPagina=[] ;

for(let i=0;i<titulosHistorias.length;i++){
    enlacesPagina[i]=document.createElement("button");
    enlacesPagina[i].setAttribute("value",i);
    enlacesPagina[i].setAttribute("class","btn btn-warning");
    enlacesPagina[i].innerHTML=titulosHistorias[i];
    enlacesPagina[i].addEventListener("click",function(){irEnlace(enlacesPagina[i].value)});
    enlacesPagina[i].setAttribute("data-bs-dismiss","modal");
    divEnlacesM.appendChild(enlacesPagina[i]);
}
//Funcion que dará funcionalidad a los enlaces creados anteriormente
function irEnlace(valor){
    contador=valor;
    crearContenido(titulosHistorias, descripcionHistorias);
    closeNav();
}
// Añadimos en una cookie los elementos favoritos del usuario
var fechaExpiracion = new Date();
fechaExpiracion.setDate(fechaExpiracion.getDate()+10);
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
        document.cookie=`historia${contador}=${contador};expires=${fechaExpiracion.toGMTString()}`;
    }else{
        alert("Ya está añadido a favoritos");
    }
    
});
