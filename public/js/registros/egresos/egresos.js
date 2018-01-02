
var dataTable
var token = $('#token').val();

/*   LE PONGO AL SELECT DE PERIODO EL PERIODO ACTUAL!!!*/
      // Return today's date and time
      var currentTime = new Date()
      // returns the month (from 0 to 11)
      var month = currentTime.getMonth() + 1
      // returns the day of the month (from 1 to 31)
      var day = currentTime.getDate()
      // returns the year (four digits)
      var year = currentTime.getFullYear()
      var periodo = year+"-"+month
      $('#gasto_filtro').append('<option value=0 selected="selected">TODOS</option>');
      var gasto_filtro = document.getElementById("gasto_filtro").value;

      $("#periodo").append("<option selected value='"+periodo+"'>"+periodo+"</option>");

  function init(){
    crearDataTable(periodo,gasto_filtro);      
  }

  function crearDataTable(periodo, gasto_filtro)
  {   
      var url = '/registros/registrodegastos/listar/'+periodo+'/'+gasto_filtro+''


    dataTable = $('#tabla_datos').DataTable({
        "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdf',
                    ],
          ajax: url,
          type : "get",
          columnDefs: [
              { data: 'periodo',"targets": 0 },
              { data: 'tipo',"targets": 1 },
              { data: 'gasto',"targets": 2 },
              { data: 'caja',"targets": 3},
              { data: 'comentario',"targets": 4},
              { data: 'importe',render: $.fn.dataTable.render.number( ',', '.', 2 ),"targets": 5},
              { 'defaultContent': "<button id='editar' type='button' class='editar btn btn-primary' data-target='#modalEditar'><i class='fa fa-pencil-square-o'></i></button> <button id='eliminar' type='button'class='eliminar btn btn-danger' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>","targets": 6}
                ],
        select: {
            style: 'os',
            selector: 'td:not(:last-child)' // no row selection on last column
        },
          "bDestroy": true,
          "iDisplayLength": 20,//Paginación
          "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
      });

        ajax(url, function (err, response) {
          if (err) return console.error(err)
          var saldo = response.data.reduce(function (accum, current) {
            return accum + current.importe
          }, 0)
          document.getElementById('gasto').innerText = numeral(saldo).format('$0,0.00')
        });

}

/*ALTA DE REGISTROS!!!*/
/*1- Abro el modal*/
$('#add').click(function(){

  document.getElementById('fecha_alta').value = new Date().toDateInputValue();
  $('#selectGasto').prop('selectedIndex',0);
  $('#selectBanco').prop('selectedIndex',0);
  $('#importe_alta').val("");
  $('#comentario_alta').val("");
  $('#tituloModal').html('ALTA DE REGISTROS')
  $('#btnGuardar').show();
  $('#btnEditar').hide();
  $('#altaModal').modal('show') 

});

/*2- Aprieto el boton GUARDAR del modal*/
document.getElementById("btnGuardar").addEventListener("click",function(e){
  e.preventDefault();
  var url = "/registros/registrodegastos"//con esta ruta entro en el STORE, si es por POST!
  var fecha = $('#fecha_alta').val();
  var gasto_id = $('#selectGasto').val();
  var forma_de_pagos_id = $('#selectBanco').val();
  var importe = $('#importe_alta').val();
  var comentario = $('#comentario_alta').val();
  if(fecha != '' && gasto_id != '' && forma_de_pagos_id != '' && importe != '')
  {
    $.ajax({
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        method:"POST",
        data:{fecha:fecha, gasto_id:gasto_id,forma_de_pagos_id:forma_de_pagos_id,importe:importe, comentario:comentario},
        success:function(data)
        {
          $('#altaModal').modal('hide') 
          $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registrado Correctamente!</strong</div>');
          /*$('#tabla_datos').DataTable().ajax.reload();*/
          dataTable.destroy()
          crearDataTable(periodo);

        }
        });
    setInterval(function(){
    $('#alert_message').html('');
    }, 5000);
  }
   else
   {
    $('#alert_modal').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Faltan Campos Obligatorios!!!</strong></div>');
   }
  });

  $(document).on('click', '#cancelar', function(){
  $('#tabla_datos').DataTable().ajax.reload();      
    

  });

  /*ELIMINACION!!!*/
$(tabla_datos).on("click", "button.eliminar", function (e){
    e.preventDefault();
        $('#modalEliminar').modal('show')
    var data = dataTable.row( $(this).parents("tr") ).data();
    document.getElementById('gasto_eliminar').innerText =data.gasto+" que es del tipo "+data.tipo;
    $('#id_eliminar').val(data.id);
  })

document.getElementById("form_eliminar").addEventListener("submit",function(e){
  e.preventDefault();
  $('#modalEliminar').modal('hide');
  var data = {'id':$('#id_eliminar').val()};
  var url = "/registros/registrodegastos/eliminar/"+$('#id_eliminar').val()+""

  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    processData: true,
    dataType: 'json',
    data: data,
    success:function(data){
          dataTable.destroy()
          crearDataTable(periodo);
        $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registro Eliminado!</strong></div>');
      },
    error: function(response) {
        $('#error').modal('show');
          setTimeout(function(){
            $('#error').modal('hide');
              },1500);
        }
  });
});

    /*EDICION!!!*/
/*1- Abro el formulario modal para editar*/
$(tabla_datos).on("click", "button.editar", function (e){
  
  e.preventDefault();
  var data = dataTable.row( $(this).parents("tr") ).data();
  $('#id_editar').val(data.id).val();
  $('#fecha_alta').val(data.fecha).val();
  $('#selectGasto').val(data.gasto_id).val();
  $('#selectBanco').val(data.forma_de_pagos_id).val();
  $('#importe_alta').val(data.importe).val();
  $('#comentario_alta').val(data.comentario).val();

  $('#tituloModal').html('EDICION DE REGISTROS')
  $('#btnGuardar').hide();
  $('#btnEditar').show();
  $('#altaModal').modal('show') 

});

/*2- Aprieto el boton editar del formulario modal*/
document.getElementById("btnEditar").addEventListener("click",function(e,data_edit ){
    e.preventDefault();

    var id = $('#id_editar').val();
    var fecha = $('#fecha_alta').val();
    var gasto_id = $("#selectGasto").val();
    var forma_de_pagos_id = $("#selectBanco").val();
    var importe = $("#importe_alta").val();
    var comentario = $("#comentario_alta").val();

    var data_edit = {
                'id':id,
                'fecha':fecha,
                'gasto_id': gasto_id,
                'forma_de_pagos_id':forma_de_pagos_id,
                'importe':importe,
                'comentario':comentario
                };

  if(data_edit.fecha != '' && data_edit.gasto_id != '' && data_edit.forma_de_pagos_id != '' && data_edit.importe != '')
    update_data(data_edit);
  else
   {  
    $('#alert_modal').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Faltan Campos Obligatorios!!!</strong></div>');
      setTimeout(function(){
          $('#alert_modal').hide()
        },1500);
   }

  });

/*3- AJAX para editar */
function update_data(data_edit)
  {
    var url = "/registros/registrodegastos/editar/"+data_edit.id+""

   $.ajax({
    url: url,
    method:"POST",
    data:data_edit,
    headers: {'X-CSRF-TOKEN':token},
    success:function(data)
    {
      $('#altaModal').modal('hide') 
      $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registrado Correctamente!</strong</div>');
      dataTable.destroy()
      crearDataTable(periodo);

    },
   });
    setInterval(function(){
    $('#alert_message').html('');
    }, 5000);

  } /*FIN EDICION!!!!*/


  //select que se activa con el otro select
  $("#selectBancos").change(function(e){
  $.get("forma_pagos/select/"+e.target.value+"", function(response){
          document.getElementById("selectCuentas").disabled = false;
          $("#selectCuentas").empty();
          $("#selectCuentas").append("<option></option>");
          $.each(response, function(i, value) {
            for (var i = 0; i < value.length; i++) {
                $("#selectCuentas").append("<option value='"+value[i].id+"'>"+value[i].nombre+"</option>");
              };
          });
        });
});

  $("#periodo").change(function(e){
    var periodo = document.getElementById("periodo").value;
     $('#gasto_filtro').val(0)
    var url = 'http://localhost:8000/registros/registrodegastos/listar/'+periodo+''

    dataTable.destroy()
    crearDataTable(periodo);
});

  $("#gasto_filtro").change(function(e){
    var periodo = document.getElementById("periodo").value;
    var gasto_filtro = document.getElementById("gasto_filtro").value;
    var url = 'http://localhost:8000/registros/registrodegastos/listar/'+periodo+'/'+gasto_filtro+''

    dataTable.destroy()
    crearDataTable(periodo,gasto_filtro);
});


  init();

