$("#tipo").change(function(e){
var periodo = document.getElementById("periodo").value;
console.log(periodo);

console.log(e.target.value);
  $.get("tipo/select_tipo/"+e.target.value+"/"+periodo+"", function(response){
          console.log(response);


        //   $("#gasto").empty();
        //   for (var i = 0; i < response.length; i++) {
        //     $("#gasto").append("<td>"+response[i].Importe+"</td>");
        //     $("#gasto").append("<td>"+response[i].importe+"</td>");
        //   }
        // });
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
