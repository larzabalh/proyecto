@extends('template.main')

@section('title','titulo')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <!-- /.ACA COMIENZA EL FORMULARIO DE ALTA!!!!!! -->


        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    EDICION DEL CLIENTE:
                    <h4>{{$cliente->cliente}}</h4>
                    <h4>{{$cliente->facturador_id}}</h4>
                </div>
                <div class="panel-body">
                    <form name="" id="" method="POST" action="{{route('clientes.update',$cliente->id)}}">
                      <input type="hidden" name="_method" value="put" />
                      {{ csrf_field() }}
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>HONORARIO:</label>
                        <input value="{{$cliente->honorario}}"type="decimal" class="form-control" name="honorario" maxlength="50" placeholder="999.99">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>EMAIL:</label>
                        <input value="{{$cliente->email}}"type="email" class="form-control" name="email" maxlength="50" placeholder="">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Factura:</label><br>
                        <select class="form-control" name="facturador">
                          <option selected value="{{$cliente->facturador_id}}">{{$cliente->facturador->facturador}}</option>
                          @foreach ($facturadores as $key => $value)
                            <option value={{$value->id}}>{{$value->facturador}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Liquidador:</label><br>
                        <select class="form-control" name="liquidador">
                          <option selected value="{{$cliente->liquidador_id}}">{{$cliente->liquidador->liquidador}}</option>
                          @foreach ($liquidadores as $key => $value)
                            <option value={{$value->id}}>{{$value->liquidador}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Cobrador:</label><br>
                        <select class="form-control" name="cobrador">
                          <option selected value="{{$cliente->cobrador_id}}">{{$cliente->cobrador->cobrador}}</option>
                          @foreach ($cobradores as $key => $value)
                            <option value={{$value->id}}>{{$value->cobrador}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Deposita:</label><br>
                        <select class="form-control" name="disponibilidad">
                          <option selected value="{{$cliente->disponibilidad_id}}">{{$cliente->disponibilidad->disponibilidad}}</option>
                          @foreach ($disponibilidades as $key => $value)
                            <option value={{$value->id}}>{{$value->disponibilidad}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>CONTACTO:</label>
                        <input value="{{$cliente->contacto}}"type="text" class="form-control" name="contacto" maxlength="50">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>COMENTARIO</label>
                        <input value="{{$cliente->comentario}}"type="text" class="form-control" name="comentario" placeholder="Ingresa un comentario">
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
                        <a href="{{route('clientes.index')}}" class="btn btn-primary"><i class="fa fa-backward"></i> Volver</a>
                      </div>
                    </form>
                    @if (count($errors)>0)
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                          @endforeach
                        </ul>
                      </div>

                    @endif
                  </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->

</div>
@endsection


@section('java')

{{-- <script>
  $(document).ready(function(){
      $('#mitabla').DataTable()
    });
</script> --}}
@endsection
