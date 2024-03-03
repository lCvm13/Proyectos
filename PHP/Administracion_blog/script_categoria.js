'use strict';
var nombre=document.getElementById("nombre_categoria");
  var botonSubmit=document.getElementById("botonSubmit");
  botonSubmit.addEventListener("click",function(event){
    if(nombre.value.trim()==""||nombre.value==""){
      event.preventDefault();
      alert("Rellene todos los campos");
    }
  });
  var botonVolver=document.getElementById("botonVolver");

botonVolver.addEventListener("click",function(){
  location.href=botonVolver.value;
});