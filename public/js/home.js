/*   LE PONGO AL SELECT DE PERIODO EL PERIODO ACTUAL!!!*/
      // Return today's date and time
      var currentTime = new Date()
      // returns the month (from 0 to 11)
      var month = currentTime.getMonth() + 1
      // returns the day of the month (from 1 to 31)
      var day = currentTime.getDate()
      // returns the year (four digits)
      var year = currentTime.getFullYear()
      var periodo = year+"-"+month
      $("#periodo").append("<option selected value='"+periodo+"'>"+periodo+"</option>");
      


  function init(){
    listar(periodo);
  }





  function listar(periodo)
  { 
    $("#ingresos_todos").empty();
    $("#ingresos_impagos").empty();
    $("#saldosBancarios").empty();
    $("#tiposGastos").empty();
    $("#detalleGastos").empty();
    $("#mediosdepagosGastos").empty();
    $("#GastosPagados").empty();
    $("#GastosImpagos").empty();
    $("#titulo_GastosPagados").empty();
    $("#titulo_GastosImpagos").empty();
    
      var url = '/home/listar/'+periodo+''

        ajax(url, function (err, response) {
          if (err) return console.error(err)

          //INGRESOS
          //todos los ingresos
          var ingresos_todos = response.ingresos_todos.reduce(function (accum, current) {
              return accum + current.debe
            }, 0)
          $('#titulo_ingresos_todos').html('<div><strong>'+numeral(ingresos_todos).format('$0,0.00')+'</strong></div>');
          for (var i = 0; i < response.ingresos_todos.length; i++) {
              $("#ingresos_todos").append("<div>"+response.ingresos_todos[i].cliente+"="
                +numeral(response.ingresos_todos[i].debe).format('$0,0.00')+
                "</div>");
            }
            console.log(response)

          //ingresos impagos
          var ingresos_impagos = response.ingresos_impagos.reduce(function (accum, current) {
              return accum + current.deuda
            }, 0)
          $('#titulo_ingresos_impagos').html('<div><strong>'+numeral(ingresos_impagos).format('$0,0.00')+'</strong></div>');
          for (var i = 0; i < response.ingresos_impagos.length; i++) {
            if (response.ingresos_impagos[i].deuda!=0) {
              $("#ingresos_impagos").append("<div>"+response.ingresos_impagos[i].cliente+"="
                +numeral(response.ingresos_impagos[i].deuda).format('$0,0.00')+
                "</div>");
            } 
          }

          //BANCOS
          var saldo = response.saldosBancarios.reduce(function (accum, current) {
              return accum + current.saldo
            }, 0)
          $('#titulo_saldosBancarios').html('<div><strong>'+numeral(saldo).format('$0,0.00')+'</strong></div>');
          for (var i = 0; i < response.saldosBancarios.length; i++) {
              $("#saldosBancarios").append("<div>"+response.saldosBancarios[i].banco+"="
                +numeral(response.saldosBancarios[i].saldo).format('$0,0.00')+
                "</div>");
          }
          


          //EGRESOS
          var total_egresos = response.reg_gastos.reduce(function (accum, current) {
              return accum + current.importe
            }, 0)
           $('#total_egresos').html('<div><strong>TOTAL EGRESOS:'+numeral(total_egresos).format('$0,0.00')+'</strong></div>');
            for (var i = 0; i < response.tiposGastos.length; i++) {
              $("#tiposGastos").append("<div>"+response.tiposGastos[i].tipo+"="
                +numeral(response.tiposGastos[i].importe).format('$0,0.00')+
                "</div>");
            }
            for (var i = 0; i < response.detalleGastos.length; i++) {
              $("#detalleGastos").append("<div>"+response.detalleGastos[i].gasto+"="
                +numeral(response.detalleGastos[i].importe).format('$0,0.00')+
                "</div>");
            }

            for (var i = 0; i < response.mediosdepagosGastos.length; i++) {
              $("#mediosdepagosGastos").append("<div>"+response.mediosdepagosGastos[i].banco+"="
                +numeral(response.mediosdepagosGastos[i].importe).format('$0,0.00')+
                "</div>");
            }

            var ImporteGastosPagados = response.GastosPagados.reduce(function (accum, current) {
              return accum + current.importe
              }, 0)
            $('#titulo_GastosPagados').append('<div><strong>'+numeral(ImporteGastosPagados).format('$0,0.00')+'</strong></div>');
            for (var i = 0; i < response.GastosPagados.length; i++) {
              $("#GastosPagados").append("<div>"+response.GastosPagados[i].gasto+"="
                +numeral(response.GastosPagados[i].importe).format('$0,0.00')+
                "</div>");
            }

            var ImporteGastosImpagos = response.GastosImpagos.reduce(function (accum, current) {
              return accum + current.importe
              }, 0)
            $('#titulo_GastosImpagos').append('<div><strong>'+numeral(ImporteGastosImpagos).format('$0,0.00')+'</strong></div>');
            for (var i = 0; i < response.GastosImpagos.length; i++) {
              $("#GastosImpagos").append("<div>"+response.GastosImpagos[i].gasto+"="
                +numeral(response.GastosImpagos[i].importe).format('$0,0.00')+
                "</div>");
            }


            $('#resultado').html('<div><strong>'+numeral(ingresos_todos-total_egresos).format('$0,0.00')+'</strong></div>');

        });

}

  $("#periodo").change(function(e){
    var periodo = document.getElementById("periodo").value;
     $('#gasto_filtro').val(0)
    var url = 'http://localhost:8000/registros/registrodegastos/listar/'+periodo+''

    
    listar(periodo);
});

 


  init();

