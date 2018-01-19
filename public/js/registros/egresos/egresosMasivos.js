var dataTable
var token = $('#token').val();

document.getElementById('fecha').value = new Date().toDateInputValue();

  function init(){
    listar();      
  }

  function listar()
  {   
      var url = '/registros/egresos/egresosMasivos/listar/'

      ajax(url, function (err, response) {
          if (err) return console.error(err)
          var saldo = response.data.reduce(function (accum, current) {
            return accum + current.importe
          }, 0)
          
          document.getElementById('total').innerText = numeral(saldo).format('$0,0.00')
        });

}


$(".sumar").change(function(e){
     suma()
});

function suma() {
      var total = 0;
      $('.sumar').each(function() {
            if (!isNaN($(this).val())) {
              total += Number($(this).val());
          }
      });
        $('#total').html(numeral(total).format('$0,0.00'));
  };

/*2- Aprieto el boton ASIGNAR*/
/* Primero Verifico que no haya ingresado otro periodo en forma masiva */
document.getElementById("btnAsignar").addEventListener("click",function(e){
  e.preventDefault();
  var url = "/registros/egresos/egresosMasivos/verificar"
  var fecha = $('#fecha').val();
  var gastos= [];$("input[name^='gastos']").each(function() {gastos.push ($(this).val());});
  var forma_de_pagos_id= [];$("input[name^='forma_de_pagos_id']").each(function() {forma_de_pagos_id.push ($(this).val());});
  var importe= [];$("input[name^='importe']").each(function() {importe.push ($(this).val());});
  var comentarios= [];$("input[name^='comentarios']").each(function() {comentarios.push ($(this).val());});

  var calcular= [];$("input[name^='calcular']").each(function() {calcular.push ($(this).attr("name"));});
  var valor= [];$("input[name^='calcular']").each(function() {valor.push ($(this).val());});
  var subtotal=0;
  var actual='';

  for (var i = 0; i < calcular.length; i++) {
      actual=calcular[i]
      if (actual ==calcular[i]) {
        subtotal=subtotal+ parseFloat(valor[i]);
      }
    
    }
    console.log(subtotal);


  var data = [];
  var len = gastos.length;
  for (var i = 0; i < len; i++) {
      data.push({
          gasto_id: gastos[i],
          forma_de_pagos_id: forma_de_pagos_id[i],
          importe: importe[i],
          comentarios: comentarios[i],
      });
    }

  console.log(data);

  if(fecha != '')
  {
    $.ajax({
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        method:"get",
        data:{fecha},
        success:function(response)
          { 
            console.log(response.data.length)
            if(response.data.length == 0){
                grabar_masivo(data,fecha); //Verifique que no hubo => Le paso para que grabe
              }
            else
             {
              $('#alert_message').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Ya se registro una carga masiva en este periodo!!!</strong></div>');
             }
          }
        });
    setInterval(function(){
    $('#alert_message').html('');
    }, 7000);

  }
  else
   {
    $('#alert_message').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Faltan Campos Obligatorios!!!</strong></div>');
   }

  

  });

function grabar_masivo(data,fecha) {

  var url = "/registros/egresos/egresosMasivos"//con esta ruta entro en el STORE, si es por POST!  
  {
    $.ajax({
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        method:"POST",
        data:{data,fecha},
        success:function(data)
          {
            $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registrado Correctamente!</strong</div>');
          }
        });
    setInterval(function(){
    $('#alert_message').html('');
    }, 7000);
  }
   

  };



  init();

