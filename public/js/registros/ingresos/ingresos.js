var dataTable
var token = $('#token').val();

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
        $('#total').html(numeral(total).format('$0,0.00'));
  };

/*2- Aprieto el boton ASIGNAR*/
document.getElementById("btnAsignar").addEventListener("click",function(e){
  e.preventDefault();
  var url = "/registros/ingresos/ingresos"//con esta ruta entro en el STORE, si es por POST!
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

console.log(data);

/*var data=[];
data.push(ids_clientes);
data.push(honorarios);
data.push(comentarios);

console.log(data)*/
  
  if(fecha != '')
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
    }, 5000);
  }
   else
   {
    $('#alert_message').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Faltan Campos Obligatorios!!!</strong></div>');
   }

  });



  init();

