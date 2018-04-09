var dataTable
var token = $('#token').val();

/*$(".sumar").mask('99999999,99',
               { reverse : true, placeholder: "$ 0,00",
                'translation': {9: {pattern: /[0-9]/} } } )
                .attr({ maxLength : 12 });*/


document.getElementById('fecha').value = new Date().toDateInputValue();

  function init(){
    listar();      
  }

  function listar()
  {   
      var url = '/registros/ingresos/ingresos/listar/'

      ajax(url, function (err, response) {
          if (err) return console.error(err)
          var saldo = response.data.reduce(function (accum, current) {
            return accum + current.honorario
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
      console.log(total)
        $('#total').html(numeral(total).format('$0,0.00'));
  };

/*2- Aprieto el boton ASIGNAR*/
/* Primero Verifico que no haya ingresado otro periodo en forma masiva */
document.getElementById("btnAsignar").addEventListener("click",function(e){
  e.preventDefault();
  var url = "/registros/ingresos/ingresos/verificar"
  var fecha = $('#fecha').val();
  var ids_clientes= [];$("input[name^='clientes']").each(function() {ids_clientes.push ($(this).val());});
  var honorarios= [];$("input[name^='honorarios']").each(function() {honorarios.push ($(this).val());});
  var comentarios= [];$("input[name^='comentarios']").each(function() {comentarios.push ($(this).val());});

  var data = [];
  var len = ids_clientes.length;
  for (var i = 0; i < len; i++) {
      data.push({
          id: ids_clientes[i],
          honorarios: honorarios[i],
          comentarios: comentarios[i],
      });
    } 

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
              $('#alert_message').html(
                   $.DivNotificacion({
                texto:'Ya se registro una carga masiva en este periodo!!!',
                class: 'alert alert-danger'
                })
              )
             }
          }
        });
    setInterval(function(){
    $('#alert_message').html('');
    }, 7000);

  }
  else
   {
    $('#alert_message').html(
                   $.DivNotificacion({
                texto:'Faltan Campos Obligatorios!!!',
                class: 'alert alert-warning'
                })
              )
   }
  });

function grabar_masivo(data,fecha) {

  var url = "/registros/ingresos/ingresos"//con esta ruta entro en el STORE, si es por POST!  
  {
    $.ajax({
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        method:"POST",
        data:{data,fecha},
        success:function(data)
          {
           $('#alert_message').html(
                   $.DivNotificacion({
                texto:'Registrado Correctamente!!!',
                class: 'alert alert-success'
                })
              )
          }
        });
    setInterval(function(){
    $('#alert_message').html('');
    }, 7000);
  }
   

  };



  init();

