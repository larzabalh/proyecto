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
    $("#tipos").empty();
    $("#gastos").empty();
    $("#bancos").empty();
    
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
            for (var i = 0; i < response.tipos.length; i++) {
              $("#tipos").append("<div>"+response.tipos[i].tipo+"="
                +numeral(response.tipos[i].importe).format('$0,0.00')+
                "</div>");
            }
            for (var i = 0; i < response.gastos.length; i++) {
              $("#gastos").append("<div>"+response.gastos[i].gasto+"="
                +numeral(response.gastos[i].importe).format('$0,0.00')+
                "</div>");
            }

            for (var i = 0; i < response.bancos.length; i++) {
              $("#bancos").append("<div>"+response.bancos[i].banco+"="
                +numeral(response.bancos[i].importe).format('$0,0.00')+
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

