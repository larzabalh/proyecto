$(document).ready(function(){

    $('#exito').hide();
});

$('#registro').click(function(e){
  e.preventDefault();

  var dato = $('#genero').val();
  var route = 'http://localhost:8000/pruebas';
  var token = $('#token').val();


  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    processData: true,
    dataType: 'json',
    data: {genero: dato},
    success:function(response){
      $('#exito').fadeIn();
    },
    error: function() {
                  $('#error').fadeIn();
              }
  });
});
