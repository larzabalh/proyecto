

  // var gasto= document.querySelector('[name=gasto]');
  // var tipo= document.querySelector('[name=tipo]');

$("#tipo").change(function(e){

console.log(e.target.value);
  $.get("pruebas/select/"+e.target.value+"", function(response, gasto){
          console.log(response);
          $("#gasto").empty();
          // $("#gasto").append("<option></option>");
          for (var i = 0; i < response.length; i++) {
            $("#gasto").append("<option value='"+response[i].id+"'>"+response[i].gasto+"</option>");
          }
        });

});


// document.getElementById('form').onsubmit=function(e){
// e.preventDefault();
//
// if (document.getElementById('usuario').value == "" ) {
//   var mensaje_usuario = document.createElement("DIV");
//   mensaje_usuario.innerText = "EL CAMPO ES REQUERIDO";
//   document.getElementById('usuario').parentNode.append(mensaje_usuario);
// }
//
//
// if (document.getElementById('clave').value == "" ) {
//   var clave = document.querySelector('[name=clave]');
//   var mensaje_clave = document.createElement("DIV");
//   mensaje_clave.innerText = "EL CAMPO ES REQUERIDO";
//   clave.parentNode.append(mensaje_clave);
// }
//
// }


// $(document).ready(function(){
//
//     $('#exito').hide();
// });
//
// $('#registro').click(function(e){
//   e.preventDefault();
//
//   var dato = $('#genero').val();
//   var route = 'http://localhost:8000/pruebas';
//   var token = $('#token').val();
//
//
//   $.ajax({
//     url: route,
//     headers: {'X-CSRF-TOKEN':token},
//     type: 'POST',
//     processData: true,
//     dataType: 'json',
//     data: {genero: dato},
//     success:function(response){
//       $('#exito').fadeIn();
//     },
//     error: function() {
//                   $('#error').fadeIn();
//               }
//   });
// });
