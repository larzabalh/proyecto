
var dataTable
var token = $('#token').val();

	function init(){

	    crearDataTable();
	    
	}

  function crearDataTable()
  {  	
  		var url = '/configuracion/registros/CtaCte/efectivo/listar'
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
              { data: 'nombre',"targets": 0 },
              { 'defaultContent': "<button id='editar' type='button' class='editar btn btn-primary' data-target='#modalEditar'><i class='fa fa-pencil-square-o'></i></button>	<button id='eliminar' type='button'class='eliminar btn btn-danger' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>","targets": 1},
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
/*1- Inserto una fila para que pueda registrar*/
$('#add').click(function(){
	var html = '<tr>';
	html += '<td contenteditable id="data1"></td>';
	html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">INSERTAR</button> <button type="button" name="cancelar" id="cancelar" class="btn btn-primary btn-xs">CANCELAR</button></td>';
	html += '</tr>';
	$('#tabla_datos tbody').prepend(html);
});

/*2- Aprieto el boton INSERTAR*/
  $(document).on('click', '#insert', function(){
	var url = "/configuracion/registros/CtaCte/efectivo"//con esta ruta entro en el STORE, si es por POST!
	var nombre = $('#data1').text();
	if(nombre != '')
	{
		$.ajax({
				url:url,
				headers: {'X-CSRF-TOKEN':token},
				method:"POST",
				data:{nombre:nombre},
				success:function(data)
				{
					$('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>'+data.data.nombre+'</strong</div>');
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
    document.getElementById('gasto_eliminar').innerText =data.nombre;
    $('#id_eliminar').val(data.id);
  })

document.getElementById("form_eliminar").addEventListener("submit",function(e){
  e.preventDefault();
  $('#modalEliminar').modal('hide');
  var data = {'id':$('#id_eliminar').val()};
  var url = "/configuracion/registros/CtaCte/efectivo/eliminar/"+$('#id_eliminar').val()+""

  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    processData: true,
    dataType: 'json',
    data: data,
    success:function(data){
        $('#exito_eliminar').modal('show');
        document.getElementById('gasto_exito_eliminar').innerText =data.data.tipo;
        setTimeout(function(){
	        $('#exito_eliminar').modal('hide');
	        $('#tabla_datos').DataTable().ajax.reload();
        },1500);
        $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>El Registro fue Eliminado!</strong></div>');
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
	$("#tipo_edicion").val(data.nombre);
});

/*2- Aprieto el boton editar del formulario modal de editar*/
document.getElementById("form_edit").addEventListener("submit",function(e){
    e.preventDefault();
    var id = $('#id_edicion').val();
    var nombre = $("#tipo_edicion").val();
    if(nombre != '')
		update_data(id,nombre);
	else
   {	
		$('#message_edit').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Faltan Campos Obligatorios!!!</strong></div>');
   		setTimeout(function(){
	        $('#message_edit').hide()
        },1500);
   }

  });

/*3- AJAX para editar */
function update_data(id, nombre)
  {
  	var url = "/configuracion/registros/CtaCte/efectivo/editar/"+id+""

   $.ajax({
    url: url,
    method:"POST",
    data:{id:id,nombre:nombre},
    headers: {'X-CSRF-TOKEN':token},
    success:function(data)
    {
		console.log(data)
	    $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>El Registro: '+data.data.nombre+' fue Editado correctamente!!!</strong></div>');
	    $('#tabla_datos').DataTable().ajax.reload();
	    $('#modalEditar').modal('hide')
    },
   });
		setInterval(function(){
		$('#alert_message').html('');
		}, 5000);

  } /*FIN EDICION!!!!*/

  init();


