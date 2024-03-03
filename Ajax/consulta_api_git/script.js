'use strict';
var contenedor = document.createElement("div");
$("document").ready(function () {
    let botonMostrar = document.getElementById("btn-mostrar");
    if($("#nombre").prop("disabled")==false){
      botonMostrar.addEventListener("click",api);  
    }
    
    $("#divResultados").css("visibility", "hidden");
    $("#btn-cambiar").click(function () {
        contenedor.innerHTML = "";
        botonMostrar.removeEventListener("click",api);
        $("#nombre").prop("disabled", function () {
            $(this).prop("disabled") ? $(this).prop("disabled", false) : $(this).prop("disabled", true);
        });
        $("#datos").prop("disabled", function () {
            $(this).prop("disabled") ? $(this).prop("disabled", false) : $(this).prop("disabled", true);
        });


        if ($("#nombre").prop("disabled") == false) {
            document.getElementById("datos").innerHTML = "";
            let nombre = document.getElementById("nombre");
            botonMostrar.addEventListener("click", api);
        } else {
            $.ajax({
                url: "php/usuarios.php",
                type: "GET"
            })
                .done(function (responseText) {
                    crearSelect(responseText);
                    botonMostrar.addEventListener("click", function () { buscarbbdd(responseText, selectDatos.value) });
                })
                .fail(function (xhr, responseText) {
                    alert(xhr.status);
                })

            let selectDatos = document.getElementById("datos");

        }
    });

});

function api() {
    buscarApi(nombre.value);
  }

function crearSelect(respuesta) {
    let selectDatos = document.getElementById("datos");
    let opcionMuestra = document.createElement("option");
    opcionMuestra.setAttribute("value", "");
    opcionMuestra.innerHTML = "---";
    selectDatos.appendChild(opcionMuestra);

    for (let i = 0; i < respuesta.length; i++) {
        let opcion = document.createElement("option");
        opcion.setAttribute("value", respuesta[i].nombre);
        opcion.innerHTML = `${respuesta[i].nombre} ${respuesta[i].apellido}`;
        selectDatos.append(opcion);
    }

}

function buscarApi(nombre) {
    fetch(`https://api.github.com/users/${nombre}`)
        .then((response) => response.json())
        .then((data => {
            if (data.message != "Not Found") {
                $("#divResultados").css("visibility", "visible");
                // COLOCAMOS IMAGEN
                let contenedorImagen = document.getElementById("avatar-container");
                contenedorImagen.innerHTML = "";
                let imagen = document.createElement("img");
                imagen.setAttribute("src", data.avatar_url);
                contenedorImagen.appendChild(imagen);

                // COLOCAMOS NOMBRE CON REPOSITORIOS
                let divResultado = document.getElementById("resultado");
                divResultado.innerHTML = "";
                divResultado.innerHTML = `
        <h3>Hola, ¡${data.login}!</h3>
        <p>${data.name == null ? 'No tienes aun un nombre asociado a la cuenta de github' : `Tu nombre es: ${data.name}`}</p>
        <p>Tienes ${data.public_repos} repositorios públicos`;

                // Colocamos los repositorios
                let contenedorRepo = document.getElementById("repos-container");
                contenedorRepo.innerHTML = "";
                if (data.public_repos > 0) {
                    fetch(`https://api.github.com/users/${nombre}/repos`)
                        .then((response) => response.json())
                        .then((data) => data.forEach(element => {
                            contenedorRepo.innerHTML += `<p>${element.name}</p>`;
                        }));
                }
                // Colocamos la bio

                let contenedorBio = document.getElementById("bio-container");
                contenedorBio.innerHTML = "";
                contenedorBio.innerHTML = `<p>${data.bio == null ? `La bio no esta aún especificada` : `${data.bio}`}</p>`

                // Colocamos los años de antiguedad 

                let antiguedad = document.getElementById("antiguedad-container");
                antiguedad.innerHTML = "";
                let hoy = new Date();
                let resta = hoy.getFullYear() - data.created_at.slice(0, 4);
                antiguedad.innerHTML = `<p>${resta > 0 ? `Llevas ${resta} años con nosotros` : "Aun no llevas un año con nostors"}</p>`;

                // Agregamos funcion al boton volver a seleccion

                let botonSeleccion = document.getElementById("empezar");
                botonSeleccion.addEventListener("click", function () {
                    $("#divResultados").css("visibility", "hidden");
                })
            } else {
                alert("Usuario no existe");
            }
        }));
}

function buscarbbdd(respuesta, nombre) {
    for (let i = 0; i < respuesta.length; i++) {
        if (respuesta[i].nombre == nombre) {
            let containerPrin = document.getElementsByClassName("container");

            contenedor.innerHTML = `<h3>Nombre: ${respuesta[i].nombre}</h3>
        <p>Apellido: ${respuesta[i].apellido}</p>
        <p>Ciudad: ${respuesta[i].ciudad}</p>`;
            containerPrin[0].appendChild(contenedor);
        }
    }
}