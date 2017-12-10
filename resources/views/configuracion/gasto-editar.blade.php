@extends('template.main')
@extends('template.nav')
@section('title','titulo')

@section('content')


  <div id="page-wrapper">
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">FORMULARIO</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
          <div class="col-lg-6">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      EDICION DE GASTOS
                  </div>
                  <div class="panel-body" id="formularioregistros">
                      <form name="" id="" method="POST" action="{{route('gasto.update',$gasto->id)}}">
                        <input type="hidden" name="_method" value="put" />
                        {{ csrf_field() }}
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Nombre:</label>
                          <input type="text" value ="{{ $gasto->gasto}}" class="form-control" name="gasto" maxlength="50">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Tipo de Gastos:</label><br>
                          <select class="form-control" name="tipo">
                            <option selected value={{$gasto->tipo_de_gasto->id}}>{{$gasto->tipo_de_gasto->tipo}}</option>
                            @foreach ($tipos as $key => $value)

                              <option value={{$value->id}}>{{$value->tipo}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
                      </form>

                          <a href="{{route('gasto.index')}}" class="btn btn-primary"><i class="fa fa-save"></i>volver</a>
                        </div>

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
@endsection
