/*$(function(){

	$('#btnImportar').on("click", function (e){
  e.preventDefault();

		
		var comprobar = $('#csv').val().length;
		
		if(comprobar>0){
			
			var formulario = $('#csv');
			console.log(formulario)
			
			var archivos = new FormData();	
			
			var url = $("#route-importar-liquidador").val().trim()
			
		
           	 archivos.append((formulario.find('input[type="file"]:eq('+1+')').attr("name")),((formulario.find('input[type="file"]:eq('+1+')')[0])));
				 
      		 	
      		 	console.log(archivos)
      		 	

			$.ajax({
				
				url: url,
				
				type: 'POST',
				
				contentType: false, 
				
            	data: archivos,
				
               	processData:false,
				
				beforeSend : function (){
					
					$('#alert_message').html('<center><img src="/cargando.gif" width="50" heigh="50"></center>');	
				
				},
				success: function(data){
					
					if(data == 'OK'){

						$('#alert_message').html('<label style="padding-top:10px; color:green;">Importacion de CSV exitosa</label>');	
						return false;	

					}else{

						$('#alert_message').html('<label style="padding-top:10px; color:red;">Error en la importacion del CSV</label>');
						return false;
					}	
				},

				error: function(){
						$('#alert_message').html('ERROR');	
				},
				
			});
			
			return false;
			
		}else{
			
			alert('Selecciona un archivo CSV para importar');
			
			return false;
			
		}
	});
});*/

$(document).on("submit",".formarchivo",function(e){

        e.preventDefault();
        var formu=$(this);
        var nombreform=$(this).attr("id");

        var url = $("#route-importar-liquidador").val().trim()
        //información del formulario
        var formData = new FormData($("#"+nombreform+"")[0]);
        console.log(formData)

        //hacemos la petición ajax   
        $.ajax({
            url: url,  
            type: 'POST',
     
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
              $('#alert_message').html('<center><img src="/cargando.gif" width="50" heigh="50"></center>');   
            },
            //una vez finalizado correctamente
            success: function(data){
              console.log('success ajax DATA:', data)            
            },
            //si ha ocurrido un error
            error: function(data){
               $('#alert_message').html('ERROR');	
                
            }
        });
        });