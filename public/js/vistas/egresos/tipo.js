//Las funciones de datatable y ajax, las tengo en Footer

$("#tipo").change(function(e){
var periodo = document.getElementById("periodo").value;
var url = "tipo/select_tipo/"+e.target.value+"/"+periodo+"";
console.log(url);
datatable(url);


ajax(url, function (err, response) {
      if (err) return console.error(err)

      console.log("response", response)

      var saldo = response.data.reduce(function (accum, current) {
        return accum + current.importe
      }, 0)

      document.getElementById('gasto').innerText = numeral(saldo).format('$0,0.00')
    });
});


function datatable(url){


  Table=$('#tabla_datos').DataTable({
  'dataType': 'json',
  "aProcessing": true,//Activamos el procesamiento del datatables
  "aServerSide": true,//Paginación y filtrado realizados por el servidor
  dom: 'Bfrtip',//Definimos los elementos del control de tabla
  buttons: [
              'copyHtml5',
              'excelHtml5',
              'csvHtml5',
              'pdf'
          ],
  "ajax":
          {
              url: url,
              type : "get",
              dataType : "json",
              error: function(e){
                  console.log("jQuery ajax", e.responseText);
              }
          },
  type : "GET",
  columns: [
    { data: 'gasto', name: 'gasto' },
    { data: 'importe', name: 'importe',render: $.fn.dataTable.render.number( ',', '.', 2 ) }
  ],
  "bDestroy": true,
  "iDisplayLength": 10,//Paginación
  "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
  });

};

function ajax (url, callback) {
  var request = new XMLHttpRequest()
  request.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        callback(null, JSON.parse(this.response))
      } else {
        callback(Error(this.status))
      }
    }
  }
  request.open('GET', url)
  request.send()
};
