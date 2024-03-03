/* Variables usadas en todas las páginas */

var todo=document.getElementById("todo");
var confirmar=false;
var opcionTexto;
var opcionFondo;
var textito;
var fondo;
var isClicked=false;
var boton=document.getElementById("boton");
var ring=document.getElementById("ring");
var it=document.getElementById("it");
var krueger=document.getElementById("krueger");
var ocultar=document.getElementById("ocultar");
var color;
// Funcion para la unica pregunta que hay en la página de inicio. 
function pregunta(){
   let x=prompt('Dime la respuesta','');
   if (x=='incorrectamente'){
    alert('correcto');
   }else{
    alert('incorrecto');
   }
}

// Funcion que permite al usuario elegir que imagen de fondo tendrá la página web.
function ponerFondo(id){
    
    if(id==it){
        alert('Aplicado');
        opcionFondo=1;
        window.sessionStorage.setItem("fondo",opcionFondo);
    }
    if(id==ring){
        alert('Aplicado');
        opcionFondo=2;
        window.sessionStorage.setItem("fondo",opcionFondo);
    }
    if (id==krueger){
        alert('Aplicado');
        opcionFondo=3;
        window.sessionStorage.setItem("fondo",opcionFondo);
    }
    

}
// Funcion que permite al usuario decorar los textos de las páginas web.

function ponerTexto(id){

    if(id==t1){
        alert('Aplicado');
        
        opcionTexto=1;
        window.sessionStorage.setItem("textito",opcionTexto);
    }
    if(id==t2){
        alert('Aplicado');
        
       opcionTexto=2;
       window.sessionStorage.setItem("textito",opcionTexto);
    }
    if(id==t3){
        alert('Aplicado');
       opcionTexto=3;
       window.sessionStorage.setItem("textito",opcionTexto);
    }
    
}   
// Funcion que recibe el nombre del usuario que ingresa por teclado
function guardarNombre(){
    var nombreIngresado=document.getElementsByName('nombreInput')[0];
    sessionStorage.setItem('nombreGuardado', nombreIngresado.value);
    document.getElementById('nombreUsuario').innerHTML = nombreIngresado.value;
}
// Funcion que escribe el nombre introducido por el usuario.
function ponerNombre(){

    if(sessionStorage.getItem('nombreGuardado')==null){
        document.getElementById('nombreUsuario').innerHTML = "Sin identificar";
    }else{
        var nombreIngresado=sessionStorage.getItem('nombreGuardado');
        document.getElementById('nombreUsuario').innerHTML = nombreIngresado;
    }
}ponerNombre();
// Funcion para resolver la pregunta final
function guardarRespuesta(){
    var respuestaIngresada=document.getElementsByName('respuestaInput')[0];
    
    if(respuestaIngresada.value=='peine'){
        alert('Acertaste');
    }else{
        alert('Fallaste');
    }
}
// Funcion que recopila los cambios hechos por el usuario y los aplica donde corresponde.
function aplicarCambios(){

    if (window.sessionStorage.getItem("textito")==1){
        todo.style="font-weight: bolder; text-shadow: 2px 2px red";
    }
    if (window.sessionStorage.getItem("textito")==2){
        todo.style="font-weight: bolder; text-shadow: 4px 4px rgba(30, 0, 255, 0.521)";
    }
    if (window.sessionStorage.getItem("textito")==3){
        todo.style="font-weight: bolder; text-shadow: 3px 3px 3px rgba(148, 3, 116, 0.521)";
    }

    if(window.sessionStorage.getItem("fondo")==1){
        todo.style.backgroundImage="url('./imagenes/it.jpg')";
    }
    if(window.sessionStorage.getItem("fondo")==2){
        todo.style.backgroundImage="url('./imagenes/ring.jpg')";
    }
    if (window.sessionStorage.getItem("fondo")==3){
        todo.style.backgroundImage="url('./imagenes/krueger.webp')";
        
    }

confirmar=true;
   ponerBoton();
}

// Funcion que tras una serie de acciones muestra un botón con un enlace, que de normal esta oculto al usuario.
function ponerBoton(){
    let boton=document.getElementById("boton");
    let zonaFondo=document.getElementById("zonaFondo");
    let zonaTextos=document.getElementById("zonaTextos");
    let ocultarT=document.getElementById("ocultarT");
    let ocultarTe=document.getElementById("ocultarTe");
    let botonCambios=document.getElementById("botonCambios");
    let ocultarTa=document.getElementById("ocultarTa");
    let zonaNombre=document.getElementById("zonaNombre");
    if(confirmar==false){
        boton.style.display="none";
    }else{
        boton.style.display="block";
        zonaFondo.style.display="none";
        zonaTextos.style.display="none";
        ocultarT.style.display="none";
        ocultarTe.style.display="none";
        botonCambios.style.display="none";
        ocultarTa.style.display="none";
        zonaNombre.style.display="none";
    }
}
// Funcion que aplica un video screamer a un botón.
function botonScreamer(){
    let video=document.getElementById("video");
    let scare=document.getElementById("scareDiv");
    let overlay=document.getElementById("overlay");
    scare.style="display:flex;position:fixed; height:100vh;width: 100hw;justify-content:center;";
    overlay.style.display="none";
    const { documentElement } = document;
    if(documentElement.requestFullscreen) documentElement.requestFullscreen();
    else if(documentElement.mozRequestFullScreen) documentElement.mozRequestFullScreen();
    else if(documentElement.webkitRequestFullscreen) documentElement.webkitRequestFullscreen();
    else if(documentElement.msRequestFullscreen) documentElement.msRequestFullscreen();
    video.play();
   
    timeout();
}
// Funcion que oculta el screamer y vuelve a donde estaba el usuario antes de éste
function ocultarVideo(){
    let video=document.getElementById("video");
    let scare=document.getElementById("scareDiv");
    let overlay=document.getElementById("overlay");
    overlay.style.display="block";
    video.pause();
    video.currentTime=0;
    scare.style.display="none";
    if (document.fullscreenElement) {
        document.exitFullscreen()
}
}
/* Funcion que cronometra un tiempo en milisegundos para realizar una accion. 
En este caso se ha cronometrado para que al segundo pare el screamer si sucede y volver a la normalidad.
*/
function timeout(){
      setTimeout(ocultarVideo,1000);   
}
// Funcion que oculta el modal usado en las paginas web.
function ocultarModal() {
    
    document.getElementById("solucion").style.display = "none";

    
    document.getElementById("ver").style.display = "inline-block";

  
    document.getElementById("ocultar").style.display = "none";

    return;
}
// Funcion que muestra el modal usado en las paginas web
function mostrarModal() {
    document.getElementById("solucion").style.display = "table";

    
    document.getElementById("ocultar").style.display = "inline-block";

    
    document.getElementById("ver").style.display = "none";

    return;
}

