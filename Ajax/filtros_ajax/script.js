'use strict';

var botones = document.getElementsByTagName("button");
let tabla = document.getElementsByTagName("table")[0];
let paginadores = document.getElementsByTagName("input");
document.addEventListener("DOMContentLoaded",function(){
   for (let i=0;i<botones.length;i++){
    botones[i].addEventListener("click",function(){ajax(botones[i].id)});
} 
for(let i=0;i<paginadores.length;i++){
    paginadores[i].addEventListener("click",function(){paginar(paginadores[i].value)});
}
});

function ajax(valor){
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function() {
      if(objXMLHttpRequest.readyState === 4) {
        if(objXMLHttpRequest.status === 200) {
            tabla.innerHTML = objXMLHttpRequest.responseText;
        } else {
              alert('Error Code: ' +  objXMLHttpRequest.status);
              alert('Error Message: ' + objXMLHttpRequest.statusText);
        }
      }
    }
    objXMLHttpRequest.open('GET', 'aplicar_filtros.php?sexo='+valor); // el metodo usado
    objXMLHttpRequest.send();
    
}

function paginar(valor){
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function() {
      if(objXMLHttpRequest.readyState === 4) {
        if(objXMLHttpRequest.status === 200) {
            tabla.innerHTML = objXMLHttpRequest.responseText;
        } else {
              alert('Error Code: ' +  objXMLHttpRequest.status);
              alert('Error Message: ' + objXMLHttpRequest.statusText);
        }
      }
    }
    objXMLHttpRequest.open('GET', 'cambiar_pagina.php?pagina='+valor); // el metodo usado
    objXMLHttpRequest.send();
}