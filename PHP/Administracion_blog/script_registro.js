"use strict";

var botonVolver  = document.getElementById("volver");
var botonRegistro=document.getElementById("botonRegistro");

botonRegistro.addEventListener("click",function(){
    location.href=botonRegistro.value;
});
botonVolver.addEventListener("click",function(){
    location.href=botonVolver.value;
});