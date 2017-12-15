var Table

// document.forms['edit'].gasto.value

function init(){
    limpiar();
    crearDataTable();
    suscribirEventos();
}

function limpiar()
{
    $("#gasto").val("");
    $("#tipo").val("");
}

function suscribirEventos () {
  editar_data_id('#tabla_datos tbody',Table);
  eliminar_data_id('#tabla_datos tbody',Table);

  // Handle click on "Select all" control
     $('#example-select-all').on('click', function(){
        // Get all rows with search applied
        var rows = Table.rows({ 'search': 'applied' }).nodes();
        // Check/uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);


     });

     // Handle click on checkbox to set state of "Select all" control
        $('#tabla_datos tbody').on('change', 'input[type="checkbox"]', function(){
           // If checkbox is not checked
           if(!this.checked){
              var el = $('#example-select-all').get(0);
              // If "Select all" control is checked and has 'indeterminate' property
              if(el && el.checked && ('indeterminate' in el)){
                 // Set visual state of "Select all" control
                 // as 'indeterminate'
                 el.indeterminate = true;
              }
           }
        });

        // Handle form submission event
        $('#frm-example').on('submit', function(e){
          e.preventDefault();
          var form = this;


          var checkeados = [];
          document.querySelectorAll('#tabla_datos tbody input[type=checkbox]').forEach(function (el) {
            if (el.checked) checkeados.push(el.value)
          });

          var url = "http://localhost:8000/configuracion/gasto/eliminar_masivos"+checkeados+""
          var token = $('#token_eliminar_masivos').val();
          var data = {
            gastos: checkeados
          }
          console.log(checkeados)

          $.ajax({
            url: url,
            headers: {
              'X-CSRF-TOKEN': token
            },
            type: 'POST',
            processData: true,
            dataType: 'json',
            data: data,
            success:function(response){
              $("#exito").show('fade')
              document.getElementById('gasto_exito').innerText =response.mensaje.gasto;
              setTimeout(function(){
                $("#exito").hide('fade');
                Table.ajax.reload();
              },1500);
            },
            error: function(response) {
              $('#error').modal('show');
              setTimeout(function(){
                $('#error').modal('hide');
              },1500);
            }
          })

});
}

function crearDataTable()
{
  Table = $('#tabla_datos').DataTable({
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdf',
                    ],
          ajax: 'http://localhost:8000/configuracion/gasto-listar',
          type : "get",
          columnDefs: [
              { data: 'gasto',"targets": 0 },
              { data: 'tipo',"targets": 1},
              { 'defaultContent': "<button id='editar' type='button' class='editar btn btn-primary' data-target='#modalEditar'><i class='fa fa-pencil-square-o'></i></button>	<button id='eliminar' type='button'class='eliminar btn btn-danger' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>","targets": 2},
              {
                'targets': 3,
         'searchable': false,
         'orderable': false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){

             return '<input type="checkbox" ' + (full.condicion ? 'checked="checked"' : '') + ' name="id[]" value="' + full.id  + '">';
              }
            }
        ],
        select: {
            style: 'os',
            selector: 'td:not(:last-child)' // no row selection on last column
        },
          "bDestroy": true,
          "iDisplayLength": 10,//Paginación
          "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
      });

}




document.getElementById("btnGuardar").addEventListener("click",function(e){
  e.preventDefault();

  var data = {
            'gasto':$('#gasto').val(),
            'tipo': $('#tipo').val(),
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
      $("#exito").show('fade')
      document.getElementById('gasto_exito').innerText =response.mensaje.gasto;
      setTimeout(function(){
        $("#exito").hide('fade');
        Table.ajax.reload();
      },1500);
    },
    error: function(response) {
              $('#error').modal('show');
                setTimeout(function(){
                  $('#error').modal('hide');
                    },1500);
              }
  });
});



// Funciones de Eliminar
var eliminar_data_id = function (tabla_datos, table){
    $(tabla_datos).on("click", "button.eliminar", function (e){
    e.preventDefault();
        $('#modalEliminar').modal('show')
    var data = table.row( $(this).parents("tr") ).data();
    document.getElementById('gasto_eliminar').innerText =data.gasto+" que es del tipo "+data.tipo;
    var id=$('#id_eliminar').val(data.id);
  })
}

document.getElementById("form_eliminar").addEventListener("submit",function(e){
  e.preventDefault();
  $('#modalEliminar').modal('hide');
  var data = {'id':$('#id_eliminar').val()};
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
        $('#exito_eliminar').modal('show');
        limpiar();
        document.getElementById('gasto_exito_eliminar').innerText =response.mensaje.gasto;
        setTimeout(function(){
          $('#exito_eliminar').modal('hide');
          Table.ajax.reload();
        },1500);
      },
    error: function(response) {
        $('#error').modal('show');
          setTimeout(function(){
            $('#error').modal('hide');
              },1500);
        }
  });
});

// Funciones de Editar
var editar_data_id = function (tabla_datos) {
  $(tabla_datos).on("click", "button.editar", function (e){
    console.log('click')
    $('#modalEditar').modal('show')
    e.preventDefault();
    var data = Table.row( $(this).parents("tr") ).data();
    $('#id_edicion').val(data.id);
    $('#gasto_edicion').val(data.gasto);
    $("#tipo_edicion").val(data.id_tipo);
  })
}


  document.getElementById("form_edit").addEventListener("submit",function(e){
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
                    $("#abrir").hide();
                    limpiar();
                    $('#modalEditar').modal('hide')
                    $("#exito_editar").show('fade')
                    document.getElementById('gasto_exito_editar').innerText =response.mensaje.gasto;
                    setTimeout(function(){
                        Table.ajax.reload();
                        $("#exito_editar").hide('fade');
                        $("#abrir").show();
                      },1500);
                  },
      error: function() {
                    $('#error').modal('show');
                    setTimeout(function(){
                      $('#error').modal('hide');
                      },1500);
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
