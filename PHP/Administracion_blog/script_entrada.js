'use strict';

var nombre= document.getElementById("nombre_entrada");

var contenido=document.getElementById("contenido_entrada");

var categoriaEscogida=document.getElementById("categoria_escogida");

var botonSubmit=document.getElementById("botonSubmit");

var botonVolver=document.getElementById("botonVolver");

botonVolver.addEventListener("click",function(){
    location.href=botonVolver.value;
});

botonSubmit.addEventListener("click",function(event){
    if((nombre.value==""||nombre.value.trim()=="") || (contenido.value=="" || contenido.value.trim()=="") || categoriaEscogida.value==-1){
        event.preventDefault();
        alert("Rellene todos los campos");
    }
});

