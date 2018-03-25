
var dataTable
var token = $('#token').val();

	function init(){

	    crearDataTable();
	    
	}

  function crearDataTable()
  {  	
  		var url = '/configuracion/gasto-listar'
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
              { data: 'gasto',"targets": 0 },
              { data: 'tipo',"targets": 1},
              { 'defaultContent': "<button id='editar' type='button' class='editar btn btn-primary' data-target='#modalEditar'><i class='fa fa-pencil-square-o'></i></button>	<button id='eliminar' type='button'class='eliminar btn btn-danger' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>","targets": 2},
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

/*ALTA DE REGISTROS!!!*/
/*1- Abro el modal*/
$('#add').click(function(){
  $('#altaModal').modal('show')	
});

/*2- Aprieto el boton GUARDAR del modal*/
document.getElementById("btnGuardar").addEventListener("click",function(e){
  e.preventDefault();
	var url = "/configuracion/gasto"//con esta ruta entro en el STORE, si es por POST!
	var gasto = $('#gasto_alta').val();
	var tipo = $('#tipo_alta').val();
	if(gasto != '' && tipo != '')
	{
		$.ajax({
				url:url,
				headers: {'X-CSRF-TOKEN':token},
				method:"POST",
				data:{gasto:gasto, tipo:tipo},
				success:function(data)
				{
          $('#altaModal').modal('hide') 
					$('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registro: '+data.data.gasto+' Correctamente</strong</div>');
					$('#tabla_datos').DataTable().ajax.reload();
				}
				});
		setInterval(function(){
		$('#alert_message').html('');
		}, 5000);
	}
   else
   {
		$('#alert_message').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Faltan Campos Obligatorios!!!</strong></div>');
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
  var url = "/configuracion/gasto/eliminar/"+$('#id_eliminar').val()+""

  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    processData: true,
    dataType: 'json',
    data: data,
    success:function(data){
        $('#exito_eliminar').modal('show');
        document.getElementById('gasto_exito_eliminar').innerText =data.data.gasto;
        setTimeout(function(){
	        $('#exito_eliminar').modal('hide');
	        $('#tabla_datos').DataTable().ajax.reload();
        },1500);
        $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>El Gasto: '+data.data.gasto+' fue Eliminado!</strong></div>');
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
	$('#modalEditar').modal('show')
	e.preventDefault();
	var data = dataTable.row( $(this).parents("tr") ).data();
	$('#id_edicion').val(data.id);
	$('#gasto_edicion').val(data.gasto);
	$("#tipo_edicion").val(data.id_tipo);
});

/*2- Aprieto el boton editar del formulario modal de editar*/
document.getElementById("form_edit").addEventListener("submit",function(e){
    e.preventDefault();
    var id = $('#id_edicion').val();
    var gasto = $('#gasto_edicion').val();
    var tipo = $("#tipo_edicion").val();
    if(gasto != '' && tipo != '')
		update_data(id, gasto, tipo);
	else
   {	
		$('#message_edit').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Faltan Campos Obligatorios!!!</strong></div>');
   		setTimeout(function(){
	        $('#message_edit').hide()
        },1500);
   }

  });

/*3- AJAX para editar */
function update_data(id, gasto, tipo)
  {
  	var url = "/configuracion/gasto/editar/"+id+""

   $.ajax({
    url: url,
    method:"POST",
    data:{id:id, gasto:gasto, tipo:tipo},
    headers: {'X-CSRF-TOKEN':token},
    success:function(data)
    {
		console.log(data)
	    $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>El Gasto: '+data.data.gasto+' fue Editado correctamente!!!</strong></div>');
	    $('#tabla_datos').DataTable().ajax.reload();
	    $('#modalEditar').modal('hide')
    },
   });
		setInterval(function(){
		$('#alert_message').html('');
		}, 5000);

  } /*FIN EDICION!!!!*/

  init();


