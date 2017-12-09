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
        $("#form_edicion").hide();
        $("#btnGuardar").prop("disabled",false);
        // $("#btnagregar").hide();
    }
    else
    {
        $("#listadoregistros").show();
        $("#form_edicion").show();
        $("#btnagregar").show();
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
              { 'defaultContent': "<button id='editar' type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i></button>	<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
          ],
          "bDestroy": true,
          "iDisplayLength": 10,//Paginación
          "order": [[ 0, "asc" ]]//Ordenar (columna,orden)

      });
      obtener_data_id('#tabla_datos tbody',Table);

}

var obtener_data_id = function (tabla_datos, table){
    $(tabla_datos).on("click", "button.editar", function (e){
    document.getElementById("abrir_edicion").click();
    e.preventDefault();
    var data = table.row( $(this).parents("tr") ).data();
    console.log(data.gasto);
    var id=$('#id_edicion').val(data.id),
        gasto=$('#gasto_edicion').val(data.gasto),
        tipo=$("#tipo_edicion").val(data.tipo);


  })
}

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
        },4000);
      },
      error: function() {
                    $('#error').fadeIn();
                }
    });
  });

init();
