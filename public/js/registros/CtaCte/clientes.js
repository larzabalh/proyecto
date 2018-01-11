
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
  $('#alert_modal').html('');
  var cliente = $('#cliente').val();
  $("input[type=radio]").attr('disabled', false);

  $('#selectCliente').val(cliente).val();
  $('#selectBanco').prop('selectedIndex',0);
  $('#importe_alta').val("");
  $('#comentario_alta').val("");
  $('input[name="contabilidad"]').prop('checked', false);
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
  if(fecha != '' && cliente_id != '' && honorario != '' && $("input[name='contabilidad']").is(':checked'))
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
  //obtengo la fila
  var a=this.parentNode.parentNode;
  //obtengo la primer columna, donde tengo el ID
  var id=a.getElementsByTagName("td")[0].getElementsByTagName("p")[0].innerHTML;
  var haber=a.getElementsByTagName("td")[4].getElementsByTagName("p")[0].innerHTML;

  
  document.getElementById('modal_eliminar').innerHTML ='¿Está seguro de eliminar: <strong>'+id+'</strong>? <div>(En caso de que tenga movimiento de cobranza, tambien se eliminará!)</div>';
  
    $('#id_eliminar').val(id);  
});

document.getElementById("form_eliminar").addEventListener("submit",function(e){
  e.preventDefault();
  $('#modalEliminar').modal('hide');
  var cliente_id = $('#cliente').val();
  var data = {'id':$('#id_eliminar').val()};
  var url = "/registros/ctacte/clientes/eliminar/"+$('#id_eliminar').val()+""

  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    processData: true,
    dataType: 'json',
    data: data,
    success:function(data){
          listar(cliente_id);
        $('#alert_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registro Eliminado!</strong></div>');
      },
    error: function(response) {
        $('#error').modal('show');
          setTimeout(function(){
            $('#error').modal('hide');
              },1500);
        }
  });
});

/*EDICION!!!*/
/*1- Abro el formulario modal para editar*/
$(tabla_datos).on("click", "button.editar", function (e){
  e.preventDefault();
  //obtengo la fila
  var a=this.parentNode.parentNode;
  //obtengo la primer columna, donde tengo el ID
  var id=a.getElementsByTagName("td")[0].getElementsByTagName("p")[0].innerHTML;
    console.log(id)

  $('#alert_modal').html('');
  var cliente_id = $('#cliente').val();
  var data = {'id':id};
  var url = "/registros/ctacte/clientes/listar_uno/"+id+""

  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN':token},
    type: 'get',
    processData: true,
    dataType: 'json',
    data: data,
    success:function(data){
      console.log(data.data)
      console.log(data.data[0].id)
      console.log(data.data[0].debe)

          
          var importe=0;

        if (data.data[0].debe!=0) 
          { importe=data.data[0].debe;
            $("#debe").prop('checked', 'checked');
            $("#haber").attr('disabled',true);
            $("#contabilidad_anterior").val('debe');
          } 
        else {
            importe=data.data[0].haber;
            $("#haber").prop('checked', 'checked');
            $("#haber").attr('disabled',false);
            $("#contabilidad_anterior").val('haber');
              }

          $('#id_editar').val(data.data[0].id).val();
          $('#fecha_alta').val(data.data[0].fecha).val();
          $('#selectCliente').val(data.data[0].cliente_id).val();
          $('#selectBanco').val(data.data[0].disponibilidad_id).val();
          $('#importe_alta').val(importe).val();
          $('#comentario_alta').val(data.data[0].comentario).val();

          $('#tituloModal').html('EDICION DE REGISTROS')
          $('#btnGuardar').hide();
          $('#btnEditar').show();
          $('#altaModal').modal('show') 


      },
    error: function(response) {
        $('#error').modal('show');
          setTimeout(function(){
            $('#error').modal('hide');
              },1500);
        }
  });  
});

/*2- Aprieto el boton editar del formulario modal*/
document.getElementById("btnEditar").addEventListener("click",function(e,data_edit ){
    e.preventDefault();

    var cliente_id = $('#cliente').val();
    var data = {'id':$('#id_eliminar').val()};
    var url = "/registros/ctacte/clientes/editar/"+$('#id_editar').val()+""


    var id = $('#id_editar').val();
    var fecha = $('#fecha_alta').val();
    var cliente_id = $("#selectCliente").val();
    var disponibilidad_id = $("#selectBanco").val();
    var honorario = $("#importe_alta").val();
    var comentario = $("#comentario_alta").val();
    var contabilidad = $('input[name=contabilidad]:checked').val();

  if(fecha != '' && cliente_id != '' && honorario != '' && $("input[name='contabilidad']").is(':checked'))
  {
      if(contabilidad = 'haber' && disponibilidad_id != '')
      {
           $.ajax({
                url:url,
                headers: {'X-CSRF-TOKEN':token},
                method:"POST",
                data:{id:id,fecha:fecha, cliente_id:cliente_id,disponibilidad_id:disponibilidad_id,honorario:honorario, comentario:comentario,contabilidad:contabilidad},
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
      $('#alert_modal').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Seleccionar Forma de Pago!!!</strong></div>');
     }    
  }
   else
   {
    $('#alert_modal').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Faltan Campos Obligatorios!!!</strong></div>');
   }
  });
/*FIN EDICION!!!!*/





init()
