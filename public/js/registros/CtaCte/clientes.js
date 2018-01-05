
var dataTable
var token = $('#token').val();

$("#cliente option:first").attr('selected','selected');
var cliente = document.getElementById("cliente").value;

function init(){
    listar(cliente);      
  }

  function listar(cliente)
  {   
    $("#tabla_datos tr").remove(); 

      var url = '/registros/ctacte/clientes/listar/'+cliente+''

        ajax(url, function (err, response) {
          if (err) return console.error(err)
          var saldo = response.data.reduce(function (accum, current) {
            return accum + current.importe
          }, 0)

          var tabla = document.getElementById('tabla_datos').getElementsByTagName('tbody')[0];
          var row = tabla.insertRow(tabla.rows.length);
            row.insertCell(0).innerHTML='<p class="text-center"><strong>ID</strong></p>';
            row.insertCell(1).innerHTML='<p class="text-center"><strong>NUMERO</strong></p>';
            row.insertCell(2).innerHTML='<p class="text-center"><strong>PERIODO</strong></p>';
            row.insertCell(3).innerHTML='<p class="text-center"><strong>DEBE</strong></p>';
            row.insertCell(4).innerHTML='<p class="text-center"><strong>HABER</strong></p>';
            row.insertCell(5).innerHTML='<p class="text-center"><strong>SALDO</strong></p>';
            row.insertCell(6).innerHTML='<p class="text-center"><strong>PAGA EN</strong></p>';
            row.insertCell(7).innerHTML='<p class="text-center"><strong>COMENTARIO</strong></p>';
            row.insertCell(8).innerHTML='<p class="text-center"><strong>OPCIONES</strong></p>';

          var saldo = 0;
          var numero =0;
          

          response.data.forEach(function(data,index,a) {
            

          var row = tabla.insertRow(tabla.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            var cell9 = row.insertCell(8);
            
            saldo=saldo +data.debe-data.haber;
            numero = index+1

            cell1.innerHTML = '<p name="id" id="id" class="text-center">'+data.id+'</p>';
            cell2.innerHTML = '<p name="numero_f[]" id="id" class="text-center">'+numero+'</p>';
            cell3.innerHTML = '<p name="codigo_p[]" class="text-center">'+data.periodo+'</p>';
            cell4.innerHTML = '<p name="descuento_p[]" class="text-center">'+numeral(data.debe).format('$0,0.00')+'</p>';
            cell5.innerHTML = '<p name="cantidad_p[]" class="text-center">'+numeral(data.haber).format('$0,0.00')+'</p>';
            cell6.innerHTML = '<p name="cantidad_p[]" class="text-center">'+numeral(saldo).format('$0,0.00')+'</p>';
            cell7.innerHTML = '<p name="precio_p[]" class="non-margin">'+data.disponibilidad_id+'</p>';
            cell8.innerHTML = '<p name="subtotal_p[]" class="non-margin">'+data.comentario+'</p>';
            cell9.innerHTML = "<button id='editar' type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i></button> <button id='eliminar' type='button'class='eliminar btn btn-danger' ><i class='fa fa-trash-o'></i></button>";
          
          });

          document.getElementById("saldo").innerHTML = numeral(saldo).format('$0,0.00');
          
        });

}

$("#cliente").change(function(e){

    var cliente = document.getElementById("cliente").value;

    

    listar(cliente);
});


/*ALTA DE REGISTROS!!!*/
/*1- Abro el modal*/
$('#add').click(function(){

  document.getElementById('fecha_alta').value = new Date().toDateInputValue();
  
  var cliente = $('#cliente').val();

  $('#selectCliente').val(cliente).val();
  $('#selectBanco').prop('selectedIndex',0);
  $('#importe_alta').val("");
  $('#comentario_alta').val("");
  $('#tituloModal').html('ALTA DE REGISTROS')
  $('#btnGuardar').show();
  $('#btnEditar').hide();
  $('#altaModal').modal('show') 

});

/*2- Aprieto el boton GUARDAR del modal*/
document.getElementById("btnGuardar").addEventListener("click",function(e){
  e.preventDefault();
  var url = "/registros/ctacte/clientes/grabar"
  var fecha = $('#fecha_alta').val();
  var cliente_id = $('#selectCliente').val();
  var disponibilidad_id = $('#selectBanco').val();
  var honorario = $('#importe_alta').val();
  var comentario = $('#comentario_alta').val();
  var contabilidad = $('input[name=contabilidad]:checked').val();
  if(fecha != '' && cliente_id != '' && honorario != '' && contabilidad != '')
  {
    $.ajax({
        url:url,
        headers: {'X-CSRF-TOKEN':token},
        method:"POST",
        data:{fecha:fecha, cliente_id:cliente_id,disponibilidad_id:disponibilidad_id,honorario:honorario, comentario:comentario,contabilidad:contabilidad},
        success:function(data)
        {
          $('#altaModal').modal('hide') 
          $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registrado Correctamente!</strong</div>');
          
          
          listar(cliente_id);

        }
        });
    setInterval(function(){
    $('#alert_message').html('');
    }, 5000);
  }
   else
   {
    $('#alert_modal').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Faltan Campos Obligatorios!!!</strong></div>');
   }
  });

  $(document).on('click', '#cancelar', function(){
  $('#tabla_datos').DataTable().ajax.reload();      
    

  });

/*ELIMINACION!!!*/
$(tabla_datos).on("click", "button.eliminar", function (e){
    e.preventDefault();
        $('#modalEliminar').modal('show')
  var a=this.parentNode.parentNode;
  console.log(a)
  
   var cantidad=a.getElementsByTagName("id")
    console.log(cantidad);


  var x = document.getElementById("id").parentNode.parentNode;
  

var id="";

/*  $('#tabla_datos tr').each(function() {
    id = $(this).find("#id").eq(0).html();   

    console.log(id) 
 });
console.log(id) */

var a=this.parentNode.parentNode;
  //Obteniendo el array de todos loe elementos columna en esa fila
  //var b=a.getElementsByTagName("td");


/*  $('#tabla_datos tr').each(function() {
    var customerId = $(this).find("td").eq(2).html();  
    $(this).closest('tr').find('td').eq(0).find('input').val()
      console.log(customerId)
});
*/
});


init()
