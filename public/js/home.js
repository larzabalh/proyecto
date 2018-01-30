var token = $('#token').val();

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
    
    listar(periodo)
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
    $("#saldosBancariosProyectado").empty();
    $("#titulo_mediosdepagosGastos").empty();
    $("#titulo_mediosdepagosGastosPagados").empty();
    $("#titulo_cajas").empty();
    $("#cajas").empty();

    
    
      var url = '/home/listar/'+periodo+''

        ajax(url, function (err, response) {
          if (err) return console.error(err)

            console.log(response)
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

          //BANCOS PROYECTADOS
          var impagos = response.saldosBancariosProyectado.reduce(function (accum, current) {
              return accum + current.importe
            }, 0)
          var saldosBancarios = response.saldosBancarios.reduce(function (accum, current) {
              return accum + current.saldo
            }, 0)
          $('#titulo_saldosBancariosProyectado').html('<div><strong>'+numeral(saldosBancarios-impagos).format('$0,0.00')+'</strong></div>');
          
          for (var i = 0; i < response.saldosBancarios.length; i++) {
              for (var j = 0; j < response.saldosBancariosProyectado.length; j++) {

                 
                  if (response.saldosBancarios[i].cuenta==response.saldosBancariosProyectado[j].cuenta) {
                    response.saldosBancarios[i].saldo= response.saldosBancarios[i].saldo-response.saldosBancariosProyectado[j].importe;

                  }
                  
              }
              
              $("#saldosBancariosProyectado").append("<div>"+response.saldosBancarios[i].banco+"="
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

            var ImporteGastos = response.mediosdepagosGastos.reduce(function (accum, current) {
              return accum + current.importe
              }, 0)
            $('#titulo_mediosdepagosGastos').append('<div><strong>'+numeral(ImporteGastos).format('$0,0.00')+'</strong></div>');            
            for (var i = 0; i < response.mediosdepagosGastos.length; i++) {
              $("#mediosdepagosGastos").append("<div>"+response.mediosdepagosGastos[i].banco+"="
                +numeral(response.mediosdepagosGastos[i].importe).format('$0,0.00')+
                "</div>");
            }


            var ImporteGastosPagados = response.mediosdepagosGastosPagados.reduce(function (accum, current) {
              return accum + current.importe
              }, 0)
            $('#titulo_mediosdepagosGastosPagados').append('<div><strong>'+numeral(ImporteGastosPagados).format('$0,0.00')+'</strong></div>');            
            for (var i = 0; i < response.mediosdepagosGastosPagados.length; i++) {
              $("#mediosdepagosGastosPagados").append("<div>"+response.mediosdepagosGastosPagados[i].banco+"="
                +numeral(response.mediosdepagosGastosPagados[i].importe).format('$0,0.00')+
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

            //CAJAS
            for (var i = 0; i < response.cajas.length; i++) {
              /*$("#cajas").append("<div>"+response.cajas[i].nombre+"="+numeral(response.cajas[i].importe).format('$0,0.00')+"</div>");*/

              $("#cajas").append("<div class='form-group col-lg-12 col-md-12 col-sm-12 col-xs-12'><strong>"+response.cajas[i].nombre+"</strong><input type='text' class='sumar form-group col-lg-4 col-md-4 col-sm-4 col-xs-4' name="+response.cajas[i].id+" value="+response.cajas[i].importe+"></div>");
            };


            $('#resultado').html('<div><strong>'+numeral(ingresos_todos-total_egresos).format('$0,0.00')+'</strong></div>');

        });

}

$(".sumar").mask('00/00/0000')
/*$(".sumar").numeric("."); */// No lo esta ejecutando!!!!! no funcion!!!
 



$('#btnActualizar').on("click", function (e){
    e.preventDefault();
var id= [];$("input[class^='sumar']").each(function() {id.push ($(this).attr('name'));});
var importe= [];$("input[class^='sumar']").each(function() {importe.push ($(this).val());});

console.log('id',id)
console.log('importe',importe)

var data = [];
  var len = id.length;
  for (var i = 0; i < len; i++) {
      data.push({
          id: id[i],
          importe: importe[i],
      });
    }

  console.log('data:',data);

  var url = "/home"
  {
    $.ajax({
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        method:"POST",
        data:{data},
        success:function(data)
          {
            console.log(data)
            $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Actualizado Correctamente!</strong</div>');
          }
        });
    setInterval(function(){
    $('#alert_message').html('');
    }, 2000);
  }

});

  $("#periodo").change(function(e){
    var periodo = document.getElementById("periodo").value;
     $('#gasto_filtro').val(0)
    var url = 'http://localhost:8000/registros/registrodegastos/listar/'+periodo+''

    
    listar(periodo);
});

 


  init();

