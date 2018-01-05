
var dataTable
var token = $('#token').val();

$("#cliente option:first").attr('selected','selected');
var cliente = document.getElementById("cliente").value;

function init(){
    listar(cliente);      
  }

  function listar(cliente)
  {   
      var url = '/registros/ctacte/clientes/listar/'+cliente+''

        ajax(url, function (err, response) {
          if (err) return console.error(err)
          var saldo = response.data.reduce(function (accum, current) {
            return accum + current.importe
          }, 0)

          
          var tabla=document.getElementById("tabla_datos");
          var saldo = 0;


          console.log(response.data);
          response.data.forEach(function(data,index,a) {
            console.log(a);

            var row = tabla.insertRow(0+1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(6);

            
            saldo=saldo +data.debe;

            cell1.innerHTML = '<p name="numero_f[]" class="non-margin">'+index+'</p>';
            cell2.innerHTML = '<p name="codigo_p[]" class="non-margin">'+data.periodo+'</p>';
            cell3.innerHTML = '<p name="descuento_p[]" class="non-margin">'+data.debe+'</p>';
            cell4.innerHTML = '<p name="cantidad_p[]" class="non-margin">'+data.haber+'</p>';
            cell5.innerHTML = '<p name="cantidad_p[]" class="non-margin">'+saldo+'</p>';
            cell6.innerHTML = '<p name="precio_p[]" class="non-margin">'+data.disponibilidad_id+'</p>';
            cell7.innerHTML = '<p name="subtotal_p[]" class="non-margin">'+data.comentario+'</p>';
            cell8.innerHTML = '<span class="icon fa-edit"></span><span class="icon fa-eraser"></span>';
          
          });
          
        });

}

$("#cliente").change(function(e){


    var cliente = document.getElementById("cliente").value;

    listar(cliente);
});


init()
