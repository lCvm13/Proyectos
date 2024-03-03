"use strict";

var campoComentario = document.getElementById("contenido_comentario");
var valor="";
var boton=document.getElementById("botonComentario");
campoComentario.addEventListener("focus",function () {
    boton.style="display:block";
  });

campoComentario.addEventListener("blur",function(){
  valor=campoComentario.value;
  if(valor.trim()==""){
    boton.style="display:none";
}else{
   boton.style="display:block";
}
});


