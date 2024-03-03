"use strict";
// Variables usadas
import { cookies } from "./arrayImportar.js";
import { descripcionAcertijos } from "./arrayImportar.js";
import { titulosAlternativosHistorias } from "./arrayImportar.js";
var acertijosFav=[];
var historiasFav=[];
var valoresAcertijos=[];
var valoresHistorias=[];
var divAcertijos = document.getElementById("Acertijos");
var divHistorias = document.getElementById("Historias");
var tituloDivA=document.getElementById("TituloDivA");
var titulosDivH=document.getElementById("TituloDivH");

// Variables que comprueba si existen cookies de favoritos en la página y crea los enlaces para acceder a ellos
for(let i=0;i<cookies.length;i++){
    if(cookies[i].startsWith("acertijo")){
        acertijosFav.push(document.createElement("a"));
        valoresAcertijos.push(cookies[i].charAt(cookies[i].length-1));
    }else if(cookies[i].startsWith("historia")){
        historiasFav.push(document.createElement("a"));
        valoresHistorias.push(cookies[i].charAt(cookies[i].length-1));
    }
}
// Modificamos los enlaces para adaptarse a lo que ha elegido el usuario
for (let i=0;i<acertijosFav.length;i++){
        acertijosFav[i].setAttribute("value",valoresAcertijos[i]);
        acertijosFav[i].innerHTML = descripcionAcertijos[valoresAcertijos[i]];
        acertijosFav[i].setAttribute("href", "Acertijos.html");
        acertijosFav[i].addEventListener("click",function(){mover(valoresAcertijos[i])});
        divAcertijos.appendChild(acertijosFav[i]);
        let borrar= document.createElement("button");
        borrar.setAttribute("class","btn btn-danger");
        borrar.innerHTML="<i class='bi bi-trash3'></i>";
        borrar.addEventListener("click",function(){borrarFavoritos("acertijo",valoresAcertijos[i])});
        divAcertijos.appendChild(borrar);

}
// Modificamos los enlaces para adaptarse a lo que ha elegido el usuario
for(let i=0;i<historiasFav.length;i++){
   
         historiasFav[i].setAttribute("value",valoresHistorias[i]);
        historiasFav[i].innerHTML = titulosAlternativosHistorias[valoresHistorias[i]];
        historiasFav[i].setAttribute("href", "Historias.html");
        historiasFav[i].addEventListener("click",function(){mover(valoresHistorias[i])});
        divHistorias.appendChild(historiasFav[i]);
        let borrar= document.createElement("button");
        borrar.setAttribute("class","btn btn-danger");
        borrar.innerHTML="<i class='bi bi-trash3'></i>";
        borrar.addEventListener("click",function(){borrarFavoritos("historia",valoresHistorias[i])});
        divHistorias.appendChild(borrar); 
    }
  
// Si los array de favoritos no estan vacios que se inserte el titulo en la página.
if(acertijosFav.length>0){tituloDivA.style="display:block"};
if(historiasFav.length>0){titulosDivH.style="display:block"};
// Creacion de fecha de expiracion de las cookies

var fechaExpiracion = new Date();
fechaExpiracion.setDate(fechaExpiracion.getDate()-10);
// Guardamos en el local una variable para poder referenciarla en otro archivo.
function mover(valor) {
    localStorage.setItem("valorBusqueda", valor);
}
// Funcion que permite borrar una cookie
function borrarFavoritos(seleccion,valor){
    if(seleccion=="acertijo"){
        document.cookie=`acertijo${valor}=${valor};expires=${fechaExpiracion.toGMTString()}`;
        location.reload();
    }else{
        document.cookie=`historia${valor}=${valor};expires=${fechaExpiracion.toGMTString()}`;
        location.reload();
    }
    
}