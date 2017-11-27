@extends('template.main')

@section('title','titulo')

@section('content')



  <div id="page-wrapper">
      <div class="row">
        {{-- @php
          dd($reg_gasto->gasto->gasto)
        @endphp --}}
        <!-- /.ACA COMIENZA EL FORMULARIO DE ALTA!!!!!! -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    EDICION DE REGISTROS DE GASTOS
                </div>
                <div class="panel-body">
                  <form name="" id="" method="POST" action="{{route('registrodegastos.update',$reg_gasto->id)}}">
                    <input type="hidden" name="_method" value="put" />
                      {{ csrf_field() }}
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>FECHA:</label>
                        <input type="date" class="form-control" name="fecha" value ={{$reg_gasto->fecha}}>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Gastos:</label><br>
                        <select class="form-control" name="gasto">
                          <option selected value="{{$reg_gasto->gasto->id}}">{{$reg_gasto->gasto->gasto}}</option>
                          @foreach ($gastos as $key => $value)
                            <option value={{$value->id}}>{{$value->gasto}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>IMPORTE:</label>
                        <input type="decimal" class="form-control" name="importe" maxlength="50" placeholder="999.99" value="{{$reg_gasto->importe}}">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>COMENTARIO</label>
                        <input type="text" class="form-control" name="comentario" placeholder="Ingresa un comentario" value="{{$reg_gasto->comentario}}">
                      </div>


                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
                          <a href="{{route('registrodegastos.index')}}" class="btn btn-primary"><i class="fa fa-backward"></i> Volver</a>
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
<!-- /.ACA ARRANCAN LOS FILTROS DE BUSQUEDAS -->




          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->
@endsection
