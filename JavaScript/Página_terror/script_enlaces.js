'use strict';
// Variables importadas 
import { descripcionAcertijos } from "./arrayImportar.js";

import { titulosAlternativosHistorias } from "./arrayImportar.js";
// Variables usadas para recoger los enlaces segun la busqueda hecha segun el sessionStorage
var aEAcertijos=[];
var aEHistorias=[];
// Comprobamos que el sessionStorage no este vacio
if(sessionStorage.getItem("aBAcertijos").length>0){aEAcertijos = sessionStorage.getItem("aBAcertijos").split(",");}
if(sessionStorage.getItem("aBHistorias").length>0){aEHistorias = sessionStorage.getItem("aBHistorias").split(",");}

// Variables usadas para crear los array de los enlaces que se van a crear relacionados con la busqueda
let arrayEnlacesCrearAcertijos = [];
let arrayEnlacesCrearHistorias = [];
let divAcertijos = document.getElementById("Acertijos");
let divHistorias = document.getElementById("Historias");

let titulos = [document.createElement("h2"), document.createElement("h2")];
titulos[0].innerHTML = "Enlaces para acertijos segun tu búsqueda:";
titulos[1].innerHTML = "Enlaces para historias segun tu búsqueda:";

// Comprobamos que los array no esten vacios para añadir el numero de enlaces que corresponden al numero de elementos que coinciden con la busqueda
if (aEAcertijos.length>0){for (let i = 0; i < aEAcertijos.length; i++) { arrayEnlacesCrearAcertijos.push(document.createElement("a")); }}
if (aEHistorias.length>0){for (let i = 0; i < aEHistorias.length; i++) { arrayEnlacesCrearHistorias.push(document.createElement("a")); }}
// Comprobamos que existen enlaces relacionados con la busqueda para insertar el titulo correspondiente
if (aEAcertijos.length>0 && aEAcertijos[0]!='') { divAcertijos.appendChild(titulos[0]); }
if (aEHistorias.length>0 && aEHistorias[0]!='') { divHistorias.appendChild(titulos[1]); }
// Creamos los enlaces
if (aEAcertijos.length>0) {
    for (let i = 0; i < arrayEnlacesCrearAcertijos.length; i++) {
        arrayEnlacesCrearAcertijos[i].setAttribute("value", aEAcertijos[i]);
        arrayEnlacesCrearAcertijos[i].innerHTML = descripcionAcertijos[aEAcertijos[i]];
        arrayEnlacesCrearAcertijos[i].setAttribute("href", "Acertijos.html");
        arrayEnlacesCrearAcertijos[i].addEventListener("click", function () { mover(aEAcertijos[i]) });
        divAcertijos.appendChild(arrayEnlacesCrearAcertijos[i]);
    }
}
if (aEHistorias.length>0) {
    for (let i = 0; i < arrayEnlacesCrearHistorias.length; i++) {
        arrayEnlacesCrearHistorias[i].setAttribute("value", aEHistorias[i]);
        arrayEnlacesCrearHistorias[i].innerHTML = titulosAlternativosHistorias[aEHistorias[i]];
        arrayEnlacesCrearHistorias[i].setAttribute("href", "Historias.html");
        arrayEnlacesCrearHistorias[i].addEventListener("click", function () { mover(aEHistorias[i]) });
        divHistorias.appendChild(arrayEnlacesCrearHistorias[i]);
    }
}
// Guardamos en el local una variable para poder referenciarla en otro archivo.
function mover(valor) {
    localStorage.setItem("valorBusqueda", valor);
}



