
var dataTable
var token = $('#token').val();

$("#cliente option:first").attr('selected','selected');
var cliente = document.getElementById("cliente").value;

function init(){
    listar(cliente);      
  }

  function listar(cliente)
  {   
      var url = '/registros/ctacte/clientes/listar/'+cliente+''


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
              { data: 'debe',"targets": 1 },
              { data: 'haber',"targets": 2 },
              { 'defaultContent': 'debe',"targets": 3},
              { data: 'bancos',"targets": 4},
              { data: 'comentario',"targets": 5},
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

$("#cliente").change(function(e){

    var cliente = document.getElementById("cliente").value;
    var url = 'http://localhost:8000/registros/registrodegastos/listar/'+cliente+''

    dataTable.destroy()
    listar(cliente);
});


init()
