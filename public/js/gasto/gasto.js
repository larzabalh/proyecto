function init(){
    limpiar();
    mostrarform(false);
    listar();
}

//Función mostrar formulario
function mostrarform(flag)
{
    if (flag)
    {
        $("#listadoregistros").hide();
        $("#form_edicion").show();
        // $("#btnGuardar").prop("disabled",false);
        // $("#btnagregar").hide();
    }
    else
    {
        $("#listadoregistros").show();
        $("#form_edicion").hide();
        // $("#btnagregar").show();
    }
}

function limpiar()
{
    $("#gasto").val("");
    $("#tipo").val("");

}

function cancelarform()
{
    limpiar();
    listar();
    mostrarform(false);
}

function listar()
{
  console.log('hola  ');
            Table=$('#tabla_datos').DataTable({
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdf'
                    ],
          ajax: 'http://localhost:8000/configuracion/gasto-listar',
          type : "get",
          columns: [
              { data: 'gasto'},
              { data: 'tipo'},
              { 'defaultContent': "<button id='editar' type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i></button>	<button id='eliminar' type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
          ],
          "bDestroy": true,
          "iDisplayLength": 10,//Paginación
          "order": [[ 0, "asc" ]]//Ordenar (columna,orden)

      });
      editar_data_id('#tabla_datos tbody',Table);
      eliminar_data_id('#tabla_datos tbody',Table);

}

document.getElementById("btnGuardar").addEventListener("click",function(e){
  console.log('ACA ESTOY')
  e.preventDefault();

  var data = {
            'gasto':$('#gasto').val(),
            'tipo': $('#tipo').val()
  }
  var url = "http://localhost:8000/configuracion/gasto/crear"
  var token = $('#token').val();


  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    processData: true,
    dataType: 'json',
    data: data,
    success:function(response){
      // $('#exito').fadeIn();
      limpiar();
      $("#exito").show('fade')
      document.getElementById('gasto_exito').innerText =response.mensaje.gasto;
      setTimeout(function(){
        $("#exito").hide('fade');
        init();
      },1500);
    },
    error: function() {
                  $('#error').fadeIn();
              }
  });
});

// Funciones de Eliminar
var eliminar_data_id = function (tabla_datos, table){
    $(tabla_datos).on("click", "button.eliminar", function (e){
    e.preventDefault();
    var data = table.row( $(this).parents("tr") ).data();
    document.getElementById('gasto_eliminar').innerText =data.gasto+" que es del tipo "+data.tipo;
    var id=$('#id_eliminar').val(data.id);
  })
}

document.getElementById("eliminar-usuario").addEventListener("click",function(e){
  console.log('eliminando')
  e.preventDefault();

  var data = {'id':$('#id_eliminar').val()};
  console.log(data)
  var url = "http://localhost:8000/configuracion/gasto/eliminar/"+$('#id_eliminar').val()+""
  var token = $('#token_eliminar').val();


  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    processData: true,
    dataType: 'json',
    data: data,
    success:function(response){
      $("#abrir").hide();
      limpiar();
      $("#exito_eliminar").show('fade')
      document.getElementById('gasto_exito_eliminar').innerText =response.mensaje.gasto;
      setTimeout(function(){
        $("#exito_eliminar").hide('fade');
        $("#abrir").show();
        init();
      },1500);

      },
    error: function(response) {
            console.log();
                  $('#error').modal('show');
                  // document.getElementById('mensaje_error').innerText =response.message;
              }
  });
});

// Funciones de Editar
var editar_data_id = function (tabla_datos, table){
    $(tabla_datos).on("click", "button.editar", function (e){
    $("#form_edicion").show();
    $("#abrir").hide();
    $("#listadoregistros").hide();
    e.preventDefault();
    var data = table.row( $(this).parents("tr") ).data();
    console.log(data);
    var id=$('#id_edicion').val(data.id),
        gasto=$('#gasto_edicion').val(data.gasto),
        tipo=$("#tipo_edicion").val(data.id_tipo);
  })
}

  document.getElementById("btnEditar").addEventListener("click",function(e){
    console.log('ACA ESTOY')
    e.preventDefault();

    var data = {
              'id':$('#id_edicion').val(),
              'gasto':$('#gasto_edicion').val(),
              'tipo': $('#tipo_edicion').val(),
                }
    var url = "http://localhost:8000/configuracion/gasto/editar/"+$('#id_edicion').val()+""
    var token = $('#token_edit').val();


    $.ajax({
      url: url,
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      processData: true,
      dataType: 'json',
      data: data,
      success:function(response){
        limpiar();
        $("#exito_edit").show('fade')
        document.getElementById('gasto_exito_edit').innerText =response.mensaje.gasto;
        setTimeout(function(){
          $("#exito_edit").hide('fade');
          $("#form_edicion").hide();
          $("#abrir").show();
          $("#listadoregistros").show();
          init();
        },1500);

      },
      error: function() {
                    $('#error').modal('show');
                }
    });
  });

init();

// document.getElementById("btnGuardar").addEventListener("click", function (e) {
//   console.log('ACA ESTOY')
//   e.preventDefault();
//   console.log('estoy');
//   var request = new XMLHttpRequest();
//   var url = "http://localhost:8000/configuracion/gasto/crear"
//   var params = "gasto=Nicolas&tipo=1"
//
//   request.open('POST', url, true);
//   request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//
//   request.onreadystatechange = function () {
//     if (this.readyState == 4) {
//       if (this.status == 200) {
//         // callback(null, JSON.parse(this.response))
//         ("alerta").show();
//       } else {
//         console.log(Error(this.status))
//       }
//     }
//   }
//   request.send(params)
//   });
