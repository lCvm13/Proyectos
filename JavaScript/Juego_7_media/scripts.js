'use strict';

// VARIABLES USADAS EN EL EJERCICIO ENLAZANDO ELEMENTOS DEL HTML A JAVASCRIPT //

var usuario=document.getElementById("usuario");

var errorUsuario=document.getElementById("errorUser");

var edad= document.getElementById("edad");

var errorEdad=document.getElementById("errorEdad");

var botonComenzar=document.getElementById("comenzar");

var tablero=document.getElementById("tablero");

var puntosTablero=document.getElementById("tableroPuntos");

var puntuacion;

var puntos;

var contadorCartas=0;

var contadorGanados=0;

var contadorPerdidos=0;

var contadorPlantados=0;

var baraja=["bastos_1","bastos_2","bastos_3","bastos_4","bastos_5",
"bastos_6","bastos_7","bastos_10","bastos_11","bastos_12",
"copas_1","copas_2","copas_3","copas_4","copas_5",
"copas_6","copas_7","copas_10","copas_11","copas_12",
"espadas_1","espadas_2","espadas_3","espadas_4","espadas_5",
"espadas_6","espadas_7","espadas_10","espadas_11","espadas_12",
"oros_1","oros_2","oros_3","oros_4","oros_5",
"oros_6","oros_7","oros_10","oros_11","oros_12"];

var divImagen=document.getElementsByClassName("row tablero col-3 baraja");

var imagen;

var divBotonCarta=document.getElementById("botonCarta");

var divBotonPlanto=document.getElementById("botonMePlanto");

var botonCarta;

var botonMePlanto;

var puntuacionActual=0;

var empezar=true;
// ------------------------------------------------------------------------- //

// Evento que contiene todos los eventos necesarios para crear la aplicación, dicho evento se hara al cargar el dom de la página //
document.addEventListener("DOMContentLoaded",function(){
    //usuario.focus();
    usuario.addEventListener("blur",validarNombre);
    edad.addEventListener("blur",validarEdad);
    botonComenzar.addEventListener("click",empezarJuego);
});

// Funcion que permite validar el nombre de usuario que se introduce en el input //
//Debe contener letras y numeros pero tiene que ser de longitud minima de 6 caracteres //
function validarNombre(){
    let patron=/^[A-z0-9]{6,}$/;
   // let patron=/(DAM|DAW)20((2[0-9])|30)[a-z]{2,20}/;
if (!patron.test(usuario.value)) {
    errorUsuario.innerHTML = "Debe introducir un valor correcto";
    usuario.focus();
} else {
    errorUsuario.innerHTML = "Es correcto";
} 
}

// Funcion que permite validar la edad del usuario que se introduce en el input //
// Solo se pueden escribir caracteres numericos y la edad para poder continuar debe ser mayor a 18 años //
function validarEdad(){
    // patron que comprueba que lo que se introduce sean numeros //
    let patron=/^[0-9]{1,}$/;
    if (!patron.test(edad.value)) {
        errorEdad.innerHTML = "Debe introducir tu edad con números";
        edad.focus();
    } else {
        // Condicion de que si lo que se ha introducido son numeros, que sea mayor a 18 //
        if(edad.value<18){
            errorEdad.innerHTML="Tienes que ser mayor de 18 para jugar este juego";
            edad.focus();
        }else{
            errorEdad.innerHTML="Puede empezar a jugar";
            
        }
    } 
    
}
// funcion que tras validar la edad poder empezar a jugar //

function empezarJuego(){
    //Se comprueba que la edad sea mayor o igual a 18 años, que el campo de usuario no esté vacio y sea la primera vez que
    // se empieza a jugar en la página //
    if(edad.value>=18 && usuario.value!=""&& empezar==true){
        empezar=false;
        desordenarBaraja();
        // Cambiar visibilidad de tablero a visible si la edad es mayor a 18 y el campo de usuario no está vacio //
        tablero.style.visibility="visible";
        // Creacion de un elemento parrafo con el contenido de puntuacion
        // y creacion de un elemento parrafo que contendrá la puntuacion del usuario //

        puntuacion=document.createElement("p");
        puntuacion.innerHTML="Puntuación";
        puntuacion.style="font-weight:bolder;font-size:x-large";
        puntosTablero.appendChild(puntuacion);
        puntos=document.createElement("input");
        puntos.setAttribute("type","number");
        puntos.setAttribute("readonly","readonly");
        puntos.value=0;
        puntos.style="color:black;font-weight:bolder;width:5vw;text-align:center";
        puntosTablero.appendChild(puntos);

        // Creacion del elemento imagen y su inserción donde corresponde //
        imagen=document.createElement("img");
        imagen.setAttribute("src","./imagenes/cartaVuelta.jpg");
        divImagen[0].appendChild(imagen);

        // creacion de botonCarta, su evento y su insercion en su div correspondiente //
        botonCarta=document.createElement("button");
        botonCarta.innerHTML="Carta";
        botonCarta.setAttribute("class","btn btn-primary");
        divBotonCarta.appendChild(botonCarta);
        botonCarta.addEventListener("click",funcionBotonCarta);

        // creacion de boton me planto, su evento y su insercion en su div correspondiente //
        botonMePlanto=document.createElement("button");
        botonMePlanto.innerHTML="Me planto";
        botonMePlanto.setAttribute("class","btn btn-danger");
        divBotonPlanto.appendChild(botonMePlanto);
        botonMePlanto.addEventListener("click",funcionBotonPlanto);

    }else{
        // Comprobación que en la segunda vez que se da click en comenzar (para reiniciar el juego totalmente)
        // los valores sigan estando correctos //
        if(edad.value>=18 && usuario.value!=""){
            reinicarTablero();
        }
       
    }
    

}
// Funcion que coge la siguiente carta de la bajara para poder jugar //
function funcionBotonCarta(){
    // Elegimos la carta siguiente de la baraja empezando por 0 //
    let cartaActual=baraja[contadorCartas];
    // Colocamos la imagen de la carta correspondiente //
    imagen.setAttribute("src","./imagenes/baraja/"+cartaActual+".jpg");
    // Recortamos de la carta el valor del número para la puntuación //
    // Comprobamos si el penultimo valor del nombre de la imagen sea un uno o no //
    if(cartaActual.slice(cartaActual.length-2,cartaActual.length-1)=="1"){
        //si lo es significa que la carta tendra numeros 10,11 o 12 por lo tanto habra que coger dos numeros //
        cartaActual=parseInt(cartaActual.slice(cartaActual.length-2,cartaActual.length));
    }else{
        // sino es 10,11 o 12 sera un numero del 1 al 7 //
        cartaActual=parseInt(cartaActual.slice(cartaActual.length-1,cartaActual.length));
    }
    
    // Calculo de puntuacion //
    switch (true){  
        // si la puntuacion de la carta va del 1 al 7 //
        case cartaActual<8:
            puntuacionActual+=cartaActual;
            puntos.value=puntuacionActual;
        break;
        // si la puntuacion es 10,11 o 12 //
        case cartaActual<13:
            puntuacionActual+=0.5;
            puntos.value=puntuacionActual;
        break; 
    }
    // Si tras la suma pierdes: //
    if(puntos.value>7.5){
        contadorPerdidos++;
        Swal.fire({
       
            title: 'Has perdido, ¿Qué quieres hacer?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Seguir jugando',
            denyButtonText: 'Terminar de jugar',
            allowOutsideClick:false,
            allowEscapeKey:false,
            customClass: {
              actions: 'my-actions',
              confirmButton: 'order-1',
              denyButton: 'order-2',
            },
          }).then((result) => {
            
            if (result.isConfirmed) {
                reiniciar();
            } else if (result.isDenied) {
                Alerta();
            }
          })
        
       // si tras la suma ganas //
    }else if(puntos.value==7.5){
        contadorGanados++;
        Swal.fire({
       
            title: 'Has ganado, ¿Qué quieres hacer?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Seguir jugando',
            denyButtonText: 'Terminar de jugar',
            allowOutsideClick:false,
            allowEscapeKey:false,
            customClass: {
              actions: 'my-actions',
              confirmButton: 'order-1',
              denyButton: 'order-2',
            },
          }).then((result) => {
            
            if (result.isConfirmed) {
                reiniciar();
            } else if (result.isDenied) {
              Alerta();
            }
          })
    }

    contadorCartas++;
    

}
// Funcion del boton plantar que suma al contador de veces plantadas //
function funcionBotonPlanto(){
    contadorPlantados++;
    Swal.fire({
       
        title: 'Te has plantado, ¿Qué quieres hacer?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Seguir jugando',
        denyButtonText: 'Terminar de jugar',
        allowOutsideClick:false,
        allowEscapeKey:false,
        customClass: {
          actions: 'my-actions',
          confirmButton: 'order-1',
          denyButton: 'order-2',
        },
      }).then((result) => {
        if (result.isConfirmed) {
            reiniciar();
        } else if (result.isDenied) {
            Alerta();
        }
      })
}
// FUNCION QUE RANDOMIZA EL INDICE ACTUAL POR UNO ALEATORIO
function desordenarBaraja(){

    let currentIndex = baraja.length,  randomIndex;

    // Mientras hayan mas elementos en el array
    while (currentIndex > 0) {
  
      // Coge el elemento y le calcula un numero al azar dentro del intervalo del array
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex--;
  
      // Lo intercambia de posicion con el que le corresponde
      [baraja[currentIndex], baraja[randomIndex]] = [
        baraja[randomIndex], baraja[currentIndex]];
    }
    // Devuelve el array nuevo //
    return baraja;
  }
  // Boton para seguir jugando //
function reiniciar(){
    imagen.setAttribute("src","./imagenes/cartaVuelta.jpg");
    puntos.value=0;
    puntuacionActual=0;
    desordenarBaraja();
    contadorCartas=0;
}

// Boton para finalizar el juego y mostrar alerta con el nombre usuario, veces ganadas, perdidas y plantadas//
function Alerta(){
    botonCarta.setAttribute("disabled","disabled");
    botonMePlanto.setAttribute("disabled","disabled");
    Swal.fire({
        title: ("Usuario: "+usuario.value+"\n"+
        "Partidas ganadas: "+contadorGanados+"\n"+
        "Partidas perdidas: "+contadorPerdidos+"\n"+
        "Partidas plantadas: "+contadorPlantados),
        showDenyButton: false,
        showCancelButton: false,
        
        confirmButtonText: 'Aceptar',
        denyButtonText: 'Terminar de jugar',
        allowOutsideClick:false,
        allowEscapeKey:false,
        customClass: {
          actions: 'my-actions',
          confirmButton: 'order-1',
          denyButton: 'order-2',
        },
      }).then((result) => {
        if (result.isConfirmed) {
            
        } 
      })
}

// Funcion que reinicia todo el tablero por si tras terminar queremos jugar de nuevo //
function reinicarTablero(){
    imagen.setAttribute("src","./imagenes/cartaVuelta.jpg");
    puntos.value=0;
    puntuacionActual=0;
    desordenarBaraja();
    contadorCartas=0;
    contadorGanados=0;
    contadorPerdidos=0;
    contadorPlantados=0;
    botonCarta.removeAttribute("disabled");
    botonMePlanto.removeAttribute("disabled");
}