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
