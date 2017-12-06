$("#periodo").change(function(e){
var periodo = document.getElementById("periodo").value;
var url = "tipo_gasto/"+periodo+"";
var saldo =0;



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
                    console.log(e.responseText);
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
    ajax();
});

function importe_total(){
  console.log('total')
  var periodo = document.getElementById("periodo").value;
  var url = "tipo_gasto/"+periodo+"";

  $.get(url, function(response){
          console.log(response);
          response=JSON.stringify(response)


          // for (var i = 0; i < response2.length; i++) {
          //   console.log('dentro del for');
          // }

          response.forEach(function(element, indice) {
                  console.log(element.gasto);
                  console.log('dentro');
              });

});

          console.log('afuera del for');
        };

function ajax(){
  var periodo = document.getElementById("periodo").value;
  var url = "tipo_gasto/"+periodo+"";
  var totales = null


       	var request = new XMLHttpRequest()
           request.onreadystatechange = function () {
               if (this.readyState == 4) {
                   if (this.status == 200) {
                       totales = JSON.stringify(request)
                       console.log(totales)
                       totales.forEach(function (total) {
                         console.log('dentro del for');
                         ('#gasto').innerText = total.gasto
                         })
                   } else {
                       alert('El pedido dio error')
                   }
               }
           }
           request.open('GET', url)
           request.send()
};



$("#tipo").change(function(e){

console.log(e.target.value);
  $.get("tipo_gasto/select_gasto/"+e.target.value+"", function(response){
          console.log(response);
          $("#gasto").empty();
          $("#gasto").append("<option></option>");
          for (var i = 0; i < response.length; i++) {
            $("#gasto").append("<option value='"+response[i].id+"'>"+response[i].gasto+"</option>");
          }
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
