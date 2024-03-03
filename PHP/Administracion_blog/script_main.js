'use strict';

var borrar = document.getElementsByClassName("borrar");

for(let i=0;i<borrar.length;i++){
   borrar[i].addEventListener("click" , function (event){
    let aviso  = window.confirm("¿Estás seguro que quieres borrar la entrada?");
    if(aviso){
        
    }else{
        event.preventDefault();
    }
}); 
}

var filtrar= document.getElementById("seleccionar_categoria");

var filtro=filtrar.value;

filtrar.addEventListener("change", function(){
   document.getElementById("formulario").submit();
});


var botonVolver=document.getElementsByClassName("botonVolver");

for (let i=0;i<botonVolver.length;i++){
    botonVolver[i].addEventListener("click",function(){
    location.href=botonVolver[i].value;
});
}