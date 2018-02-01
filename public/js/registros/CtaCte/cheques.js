
var dataTable
var token = $('#token').val();
var pagado =0;
 

  function init(){
    //Le pongo al select, todas las cuentas de Gastos que tiene en ese periodo
/*    var url = '/registros/registrodegastos/listar/'+periodo+'/'+gasto_filtro+'/'+pagado+''
    ajax(url, function (err, response) {
          $("#gasto_filtro").empty();
          $('#gasto_filtro').append('<option value=0 selected="selected">TODOS</option>');

              var nuevo =eliminarDuplicados(response.data)

                $.each(nuevo, function(i, value) {
                    console.log(i)
                      $("#gasto_filtro").append("<option value='"+nuevo[i].forma_de_pagos_id+"'>"+nuevo[i].caja+"</option>");
                });
      });*/
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


        });

}

$('#btnAgregar').on("click", function (e){
    e.preventDefault();




 $('#altaModal').modal('show')
});



init();