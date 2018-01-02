
var dataTable
var token = $('#token').val();


  function init(){
    listar();      
  }

  function listar(periodo, gasto_filtro)
  {   
      var url = '/configuracion/ingresos/clientes/listar/'


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
              { data: 'cliente',"targets": 0 },
              { data: 'honorario',render: $.fn.dataTable.render.number( ',', '.', 2 ),"targets": 1},
              { data: 'email',"targets": 2 },
              { data: 'facturador',"targets": 3},
              { data: 'liquidador',"targets": 4},
              { data: 'cobrador',"targets": 5},
              { data: 'banco',"targets": 6},
              { data: 'contacto',"targets": 7},
              { data: 'comentario',"targets": 8},              
              { 'defaultContent': "<button id='editar' type='button' class='editar btn btn-primary' data-target='#modalEditar'><i class='fa fa-pencil-square-o'></i></button> <button id='eliminar' type='button'class='eliminar btn btn-danger' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>","targets": 9}
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
            return accum + current.honorario
          }, 0)
          /*document.getElementById('total').innerText = numeral(saldo).format('$0,0.00')*/
           $('#total').html('TOTAL DE HONORARIOS: '+numeral(saldo).format('$0,0.00'))
        });

}

/*ALTA DE REGISTROS!!!*/
/*1- Abro el modal*/
$('#add').click(function(){

  $('#cliente').val("");
  $('#honorario').val("");
  $('#email').val("");
  $('#facturador_id').prop('selectedIndex',0);
  $('#liquidador_id').prop('selectedIndex',0);
  $('#cobrador_id').prop('selectedIndex',0);
  $('#disponibilidad_id').prop('selectedIndex',0);
  $('#contacto').val("");
  $('#comentario').val("");

  $('#tituloModal').html('ALTA DE REGISTROS')
  $('#btnGuardar').show();
  $('#btnEditar').hide();
  $('#altaModal').modal('show') 

});

/*2- Aprieto el boton GUARDAR del modal*/
document.getElementById("btnGuardar").addEventListener("click",function(e){
  e.preventDefault();
  var url = "/configuracion/ingresos/clientes"//con esta ruta entro en el STORE, si es por POST!

  var cliente= $('#cliente').val();
  var honorario= $('#honorario').val();
  var email= $('#email').val();
  var facturador_id= $('#facturador_id').val();
  var liquidador_id= $('#liquidador_id').val();
  var cobrador_id= $('#cobrador_id').val();
  var disponibilidad_id= $('#disponibilidad_id').val();
  var contacto= $('#contacto').val();
  var comentario= $('#comentario').val();


  if(cliente != '' && honorario != '')
  {
    $.ajax({
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        method:"POST",
        data:{cliente:cliente, honorario:honorario,email:email,facturador_id:facturador_id, liquidador_id:liquidador_id,cobrador_id:cobrador_id,disponibilidad_id:disponibilidad_id,contacto:contacto,comentario:comentario},
        success:function(data)
        {
          $('#altaModal').modal('hide') 
          $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registrado Correctamente!</strong</div>');
          /*$('#tabla_datos').DataTable().ajax.reload();*/
          dataTable.destroy()
          listar();

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
    document.getElementById('eliminar').innerText =data.cliente;
    $('#id_eliminar').val(data.id);
  })

document.getElementById("form_eliminar").addEventListener("submit",function(e){
  e.preventDefault();
  $('#modalEliminar').modal('hide');
  var data = {'id':$('#id_eliminar').val()};
  var url = "/configuracion/ingresos/clientes/eliminar/"+$('#id_eliminar').val()+""

  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    processData: true,
    dataType: 'json',
    data: data,
    success:function(data){
          dataTable.destroy()
          listar();
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
  $('#cliente').val(data.cliente);
  $('#honorario').val(data.honorario);
  $('#email').val(data.email);
  $('#facturador_id').val(data.facturador_id);
  $('#liquidador_id').val(data.liquidador_id);
  $('#cobrador_id').val(data.cobrador_id);
  $('#disponibilidad_id').val(data.disponibilidad_id);
  $('#contacto').val(data.contacto);
  $('#comentario').val(data.comentario);


  $('#tituloModal').html('EDICION DE REGISTROS')
  $('#btnGuardar').hide();
  $('#btnEditar').show();
  $('#altaModal').modal('show') 

});

/*2- Aprieto el boton editar del formulario modal*/
document.getElementById("btnEditar").addEventListener("click",function(e,data_edit ){
    e.preventDefault();

    var id = $('#id_editar').val();
    var cliente= $('#cliente').val();
    var honorario= $('#honorario').val();
    var email= $('#email').val();
    var facturador_id= $('#facturador_id').val();
    var liquidador_id= $('#liquidador_id').val();
    var cobrador_id= $('#cobrador_id').val();
    var disponibilidad_id= $('#disponibilidad_id').val();
    var contacto= $('#contacto').val();
    var comentario= $('#comentario').val();

    var data_edit = {
                'id':id,
                'cliente':cliente,
                'honorario': honorario,
                'email':email,
                'facturador_id':facturador_id,
                'liquidador_id':liquidador_id,
                'cobrador_id':cobrador_id,
                'disponibilidad_id':disponibilidad_id,
                'contacto':contacto,
                'comentario':comentario
                };

  if(data_edit.cliente != '' && data_edit.honorario != '')
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
    var url = "/configuracion/ingresos/clientes/editar/"+data_edit.id+""

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
      listar();

    },
   });
    setInterval(function(){
    $('#alert_message').html('');
    }, 5000);

  } /*FIN EDICION!!!!*/


  /*ASIGNAR A PAERIODO!!!*/
/*1- Abro el modal*/
$('#asignar').click(function(){
  $('#tituloModal').html('ASIGNAR A PERIODO')
  $('#btnGuardar').hide();
  $('#btnEditar').hide();
  $('#btnAsignar').show();

  $('#fecha').show();  
  $('#cliente').val("");
  $('#honorario').val("");
  $('#comentario').val("");


  $('#email').hide();
  $('#facturador_id').hide();
  $('#liquidador_id').hide();
  $('#cobrador_id').hide();
  $('#disponibilidad_id').hide();
  $('#contacto').hide();
  
  $('#altaModal').modal('show') 

});

  init();

