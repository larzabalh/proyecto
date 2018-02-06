
var dataTable
var token = $('#token').val();
$('.fecha').datepicker({ dateFormat: 'dd-mm-yy' });

 


  function init(){

    $('#probandofechas').pickadate({
          format: 'dd/mm/yyyy',
          formatSubmit: 'yyyy/mm/dd',
          hiddenName: true
        });

    crearDataTable(pagado);

  }

   

  function crearDataTable(estado)
  { 

    var url = '/registros/ctacte/cheques/listar/'+estado+''
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
              { data: 'fecha',"targets": 0 },
              { data: 'fecha_cobrar',"targets": 1 },
              { data: 'importe',render: $.fn.dataTable.render.number( ',', '.', 2 ),"targets": 2},
              { data: 'banco',"targets": 3},
              { data: 'numero',"targets": 4},
              { data: 'tipo',"targets": 5},
              { data: 'cliente_id',"targets": 6},
              { data: 'titular',"targets": 7},
              { data: 'destino',"targets": 8},
              { data: 'estado',"targets": 9},
              { 'defaultContent': "<button id='editar' type='button' class='editar btn btn-primary' data-target='#modalEditar'><i class='fa fa-pencil-square-o'></i></button> <button id='eliminar' type='button'class='eliminar btn btn-danger' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>","targets": 10}
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
          $('#total').append(numeral(saldo).format('$0,0.00'));
          console.log(response)


        });

}

$('#btnAgregar').on("click", function (e){
    e.preventDefault();
    $('#formulario').trigger("reset");
    $('#fecha').val(new Date().toDateInputValue());
    $('#altaModal').modal('show')
});


$('#btnGuardar').on("click", function (e){
  e.preventDefault();

  var fecha = $('#fecha').val();
  var fecha_cobrar = $('#fecha_cobrar').val();
  var importe = $('#importe').val();
  var banco = $('#banco').val();
  var numero = $('#numero').val();
  var tipo = $('#tipo').val();
  var cliente_id = $('#cliente_id').val();
  var titular = $('#titular').val();
  var destino = $('#destino').val();



  var contabilidad = $('input[name=contabilidad]:checked').val();

  var data = {
                'fecha':fecha,
                'fecha_cobrar': fecha_cobrar,
                'importe':importe,
                'banco':banco,
                'numero':numero,
                'tipo':tipo,
                'cliente_id':cliente_id,
                'titular':titular,
                'destino':destino
                };

  if(fecha != '' && fecha_cobrar != '' && importe != '' && banco != '' && numero != '' && tipo != '' && cliente_id != '' && titular != '')
  {
    var url = '/registros/ctacte/cheques'
    AjaxGuardar(data,url)
    console.log(data)
  }
   else
   {
    $('#alert_modal').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Faltan Campos Obligatorios!!!</strong></div>');
   }

});


function AjaxGuardar(data,url){
  $.ajax({
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        method:"POST",
        data:data,
        success:function(data)
        {
          $('#altaModal').modal('hide') 
          $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registrado Correctamente!</strong</div>');
          $('#tabla_datos').DataTable().ajax.reload();
        }
        });
    setInterval(function(){
    $('#alert_message').html('');
    }, 5000);

}

  /*ELIMINACION!!!*/
$('#tabla_datos').on("click", "button.eliminar", function (e){
    e.preventDefault();

    $('#modalEliminar').modal('show')
    var data = dataTable.row( $(this).parents("tr") ).data();
    $('#registro_eliminar').append(data.numero);
    $('#id_eliminar').val(data.id);
  })

$('#btneliminar').on("click", function (e){
  e.preventDefault();

  $('#modalEliminar').modal('hide');
  var data = {'id':$('#id_eliminar').val()};
  var url = '/registros/ctacte/cheques/eliminar/'+$('#id_eliminar').val()+''

  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    processData: true,
    dataType: 'json',
    data: data,
    success:function(data){
        setTimeout(function(){
          $('#exito_eliminar').modal('hide');
          $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registrado Eliminado Correctamente!</strong</div>');
          $('#tabla_datos').DataTable().ajax.reload();
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

function getFormattedDate(date) {
  var year = date.getFullYear();

  var month = (1 + date.getMonth()).toString();
  month = month.length > 1 ? month : '0' + month;

  var day = date.getDate().toString();
  day = day.length > 1 ? day : '0' + day;
  
  return month + '/' + day + '/' + year;
}

/*EDICION!!!*/
$('#tabla_datos').on("click", "button.editar", function (e){
    e.preventDefault();
    $('#formulario').trigger("reset");
    $('#altaModal').modal('show');

  var data = dataTable.row( $(this).parents("tr") ).data();
  $('#id_eliminar').val(data.id);
  var fecha=new Date(data.fecha); //Primero convierto el String en date
      fecha = getFormattedDate(fecha);//Se lo paso a la funcion y lo devuelve con el formato que quiero
      var d=new Date(data.fecha_cobrar); //Primero convierto el String en date
      fecha_cobrar = getFormattedDate(d);//Se lo paso a la funcion y lo devuelve con el formato que quiero
  $('#fecha').val(fecha);
  $('#fecha_cobrar').val(fecha_cobrar);
  $('#importe').val(data.importe);
  $('#banco').val(data.banco);
  $('#numero').val(data.numero);
  $('#tipo').val(data.tipo);
  $('#cliente_id').val(data.cliente_id);
  $('#titular').val(data.titular);
  $('#destino').val(data.destino);


});

init();