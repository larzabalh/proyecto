$("#tipo").change(function(e){
var periodo = document.getElementById("periodo").value;
console.log(periodo);

console.log(e.target.value);
  $.get("tipo/select_tipo/"+e.target.value+"/"+periodo+"", function(response){
    $('#gastos').fadeIn();
    var $target = $("#gastos table tbody")
          console.log(response);

          $target.empty();

          response.forEach(function (gasto, index) {
            $('<tr data-index="' + index + '"><td>' + gasto.gasto + '</td><td>' + formatNumber.new(gasto.importe,'$') + '</td></tr>').appendTo($target)
            console.log(index, gasto.importe)
          })
});
});

$("#gasto").change(function(e){

console.log(e.target.value);
  $.get("tipo_gasto/suma_importe/"+e.target.value+"", function(response){
        console.log('suma_importe', response);
         $('#div_suma').fadeIn();

           //$('#suma_importe').value = response[0].importe;
           document.getElementById("suma_importe").value = formatNumber.new(response.importe, '$');
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
    { data: 'tipo', name: 'tipo' },
    { data: 'importe', name: 'importe' }
  ],
  "bDestroy": true,
  "iDisplayLength": 10,//Paginación
  "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
  });

};
