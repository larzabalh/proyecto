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
    $("#tipos").empty();
    $("#gastos").empty();
    $("#bancos").empty();
    
      var url = '/home/listar/'+periodo+''

        ajax(url, function (err, response) {
          if (err) return console.error(err)
            var saldo = response.reg_gastos.reduce(function (accum, current) {
              return accum + current.importe
            }, 0)
           $('#total_egresos').html('<div><strong>TOTAL EGRESOS:'+numeral(saldo).format('$0,0.00')+'</strong></div>');
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

        });

}

  $("#periodo").change(function(e){
    var periodo = document.getElementById("periodo").value;
     $('#gasto_filtro').val(0)
    var url = 'http://localhost:8000/registros/registrodegastos/listar/'+periodo+''

    
    listar(periodo);
});

 


  init();

