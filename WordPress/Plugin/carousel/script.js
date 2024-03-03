'use strict';

document.addEventListener("DOMContentLoaded",function(){
var divForm=document.getElementById("carouseles");
var nombres=[];
let botonSubmit=document.getElementById("submit_imagenes");
console.log(jQuery("tbody").children("tr").children("td").children("span"));

    jQuery("div#carouseles").children().children("img").each(function () {
        jQuery(this).click(function () {
            if(jQuery(this).next().prop("checked")){
                jQuery(this).next().prop("checked",false);
                nombres.push(jQuery(this).attr("data-nombre"));
            }else{
                jQuery(this).next().prop("checked",true);
            };
          })
      });
    jQuery("tbody").children("tr").children("td").children("span").click(function(){
        alerta(jQuery(this));
    });
      
/*
    botonSubmit.addEventListener("click",function (event) {
        event.preventDefault();
        jQuery("div#carouseles").children().children("img").each(function () {
            if(jQuery(this).next().prop("checked")){
                nombres.push(jQuery(this).attr("data-nombre"));
            }
        });
        ajax(nombres.join());
      });
      */
});
function alerta(valor){
    Swal.fire({
        title: valor.attr("data-nombre"),
        imageUrl: `http://localhost/wordpress/wp-content/plugins/carousel/imagenes/${valor.attr("data-nombre")}`,
        confirmButtonText: 'Aceptar'
      })
}
/*
function ajax(valor){
    console.log(valor);
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function() {
      if(objXMLHttpRequest.readyState === 4) {
        if(objXMLHttpRequest.status === 200) {
            alert(objXMLHttpRequest.responseText);
        } else {
              alert('Error Code: ' +  objXMLHttpRequest.status);
              alert('Error Message: ' + objXMLHttpRequest.statusText);
        }
      }
    }
    objXMLHttpRequest.open('GET', '/wordpress/wp-admin/admin.php?page=add_carousel.php?nombres='+valor); // el metodo usado
    objXMLHttpRequest.send();
    
}
*/