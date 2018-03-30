var dataTable
var token = $('#token').val();
$('.fecha').datepicker({ dateFormat: 'dd-mm-yy' });

$(".number").mask('99999999,99',
   { reverse : true, placeholder: "$ 0,00",
    'translation': {9: {pattern: /[0-9]/} } } )
    .attr({ maxLength : 12 });

$(".integer").mask('9999999999',
   { reverse : true, placeholder: "0123456789",
    'translation': {9: {pattern: /[0-9]/} } } )
    .attr({ maxLength : 12 });

function init(){
    crearDataTable(estado=0);

  }

  function crearDataTable(estado)
  { 
    var url = $("#route-cheques-listar").val().trim().replace('&param', estado);
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
              { data: 'id',"targets": 0 },
              { data: 'fecha',"targets": 1 },
              { data: 'fecha_cobrar',"targets": 2 },
              { data: 'importe',render: $.fn.dataTable.render.number( ',', '.', 2 ),"targets": 3},
              { data: 'banco',"targets": 4},
              { data: 'numero',"targets": 5},
              { data: 'tipo',"targets": 6},
              { data: 'cliente',"targets": 7},
              { data: 'titular',"targets": 8},
              { data: 'destino',"targets": 9},
              { data: 'estado',
                  "render": function ( data ) {
                    if (data == "1") {
                       data = "PAGADO";
                    } else {
                       data = "PENDIENTES";
                    }
                  return data;
                  },
                "targets": 10},
              { 'defaultContent': "<button id='editar' type='button' class='editar btn btn-primary' data-target='#modalEditar'><i class='fa fa-pencil-square-o'></i></button> <button id='eliminar' type='button'class='eliminar btn btn-danger' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>","targets": 11}
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
          $('#total').html('TOTAL: '+ numeral(saldo).format('$0,0.00'));
        });

}

$('#btnAgregar').on("click", function (e){
    e.preventDefault();
    $('#alert_modal').html('');
    $('#formulario').trigger("reset");
    $('#btnGuardar').show();
    $('#btnEditar').hide();
    $("#fecha").datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "0");
    $('#altaModal').modal('show')
});


$('#btnGuardar').on("click", function (e){
  e.preventDefault();
  var url = $("#route-cheques-store").val().trim();


datos(url);

});

  function datos(url,metodo){


  
  var fecha = $('#fecha').val();
  var fecha_cobrar = $('#fecha_cobrar').val();
  var importe = $('#importe').val();
  var banco = $('#banco').val();
  var numero = $('#numero').val();
  var tipo = $('#tipo').val();
  var cliente_id = $('#cliente_id').val();
  var titular = $('#titular').val();
  var destino = $('#destino').val();
  var estado = $('input:radio[name=pagar]:checked').val()

  var data = {
                'fecha':fecha,
                'fecha_cobrar': fecha_cobrar,
                'importe':importe,
                'banco':banco,
                'numero':numero,
                'tipo':tipo,
                'cliente_id':cliente_id,
                'titular':titular,
                'destino':destino,
                'estado':estado
                };

  if (metodo=='editar') {

    var id = $('#id_editar').val();
    console.log(id)
    data['id']=id;
  }

  console.log(data)

  if(fecha != '' && fecha_cobrar != '' && importe != '' && banco != '' && numero != '' && tipo != '' && cliente_id != '' && titular != '')
  {
    
    AjaxGuardar(data,url)

  }
   else
   {
      $('#alert_modal').html(
        $.DivNotificacion({
          texto:'Faltan Campos Obligatorios!!!',
          class: 'alert alert-warning'
          })
        )
   }

};


function AjaxGuardar(data,url){
  $.ajax({
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        method:"POST",
        data:data,
        success:function(data)
        {
          $('#altaModal').modal('hide') 
           $('#alert_message').html(
              $.DivNotificacion({
                texto:'Registrado Correctamente!!!!',
                class: 'alert alert-success'
                })
              )
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
  var url = $("#route-cheques-eliminar").val().trim().replace('&param', $('#id_eliminar').val());

  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    processData: true,
    dataType: 'json',
    data: data,
    success:function(data){
              var estado = $('input:radio[name=estado]:checked').val()
              dataTable.destroy()
              crearDataTable(estado);
          $('#alert_message').html(
              $.DivNotificacion({
                texto:'Registro Eliminado Correctamente!!!',
                class: 'alert alert-success'
                })
              )

          $('#exito_eliminar').modal('hide');
        setTimeout(function(){
          $('#alert_message').html('');
        },2500);
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
$('#tabla_datos').on("click", "button.editar", function (e){
      e.preventDefault();
        $('#formulario').trigger("reset");

        var data = dataTable.row( $(this).parents("tr") ).data();
        $('#id_editar').val(data.id);

        var url = $("#route-cheques-listar_uno").val().trim().replace('&param', $('#id_editar').val());
        $.ajax({
                url:url,
                headers: {'X-CSRF-TOKEN':token},
                method:"GET",
                data:data,
                success:function(data)
                {
                  $('#fecha').val(data.data[0].fecha);
                  $('#fecha_cobrar').val(data.data[0].fecha_cobrar);
                  $('#importe').val(data.data[0].importe);
                  $('#banco').val(data.data[0].banco);
                  $('#numero').val(data.data[0].numero);
                  $('#tipo').val(data.data[0].tipo);
                  $('#cliente_id').val(data.data[0].cliente_id);
                  $('#titular').val(data.data[0].titular);
                  $('#destino').val(data.data[0].destino);
                  (data.data[0].estado==0)? $('#impago').prop('checked',true) : $('#pagado').prop('checked',true);
                }
                });

          $('#btnGuardar').hide();
          $('#btnEditar').show();
          $('#altaModal').modal('show');

});

$('#btnEditar').on("click", function (e){
  e.preventDefault();
  var url = $("#route-cheques-editar").val().trim();
  var metodo ='editar'
  datos(url,'editar');

});


$('input:radio[name=estado]').change(function(e){
    e.preventDefault();

    var estado = $('input:radio[name=estado]:checked').val()
    dataTable.destroy()
    crearDataTable(estado);
});

init();


  