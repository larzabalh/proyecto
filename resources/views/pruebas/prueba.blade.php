@extends('template.main')
@section('titulo','Configuracion de Gastos')


@section('content')

<ul>
  <li><input type="checkbox" value="lunes" class="dia" name="" checked>lunes</li>
  <li><input type="checkbox" value="martes" class="dia" name="" checked>martes</li>
  <li><input type="checkbox" value="miercoles" class="dia" name="" checked>miercoles</li>
  <li><input type="checkbox" value="jueves" class="dia" name="" checked>jueves</li>
  <li><input type="checkbox" value="viernes" class="dia" name="" >viernes</li>
  <li><input type="checkbox" value="sabado" class="dia" name="" >sabado</li>
  <li><input type="checkbox" value="domingo" class="dia" name="" >domingo</li>
</ul>

<p id="mensaje"></p>


@endsection
@section('script')

<script>
  var checkboxes= $('.dia'),
      mensaje = $('#mensaje');

  function escuchar(){
    console.log('se disparo')

    var dias =checkboxes.filter(':checked').map(function(){

      return $(this).val();
    }).get();

    console.log(dias);
    mensaje.text('He seleccionado:'+ dias.join(', '));
  }

  checkboxes.on('click',escuchar);

  escuchar();

</script>

@endsection