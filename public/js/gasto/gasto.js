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
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
    }
    else
    {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

function limpiar()
{
    $("#gasto").val("");

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
              { data: 'id', name: 'id' },
              { data: 'gasto', name: 'gasto' },
              { data: 'condicion', name: 'condicion' }
          ],
          "bDestroy": true,
          "iDisplayLength": 10,//Paginación
          "order": [[ 0, "asc" ]]//Ordenar (columna,orden)

      });

}

init();
