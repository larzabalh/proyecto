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

document.getElementById("btnGuardar").addEventListener("click", function (e) {
  e.preventDefault();
  console.log('estoy');
  var request = new XMLHttpRequest()
  var url = "http://localhost:8000/configuracion/gasto/crear"

  request.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        // callback(null, JSON.parse(this.response))
        ("alerta").show();
      } else {
        callback(Error(this.status))
      }
    }
  }
  request.open('POST', url)
  request.send()


  });

init();
