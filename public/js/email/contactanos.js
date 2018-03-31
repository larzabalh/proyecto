/*2- Aprieto el boton GUARDAR del modal, valid y llamo a grabar!*/
document.getElementById("enviar").addEventListener("click",function(e){
  e.preventDefault();

  var url = "/contactanos";
  var token = $('#token').val();
  var name = $('#name').val();
  var email = $('#email').val();
  var message = $('#message').val();

  

 var data = {
                'name':name,
                'email': email,
                'message':message,
                };

          $.ajax({
            url:url,
            /*headers: {'X-CSRF-TOKEN':token},*/
            method:"POST",
            data:data,
            success:function(data)
            {
              console.log(data);
            }
            });
            setInterval(function(){
            $('#alert_message').html('');
            }, 5000);
 
  });