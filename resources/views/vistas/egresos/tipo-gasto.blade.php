@extends('template.main')
@extends('template.nav')
@section('title','titulo')

@section('content')

  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
<!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3><CENTER>VISTA TIPO - EGRESOS</CENTER></h3>
                </div>
                <div class="panel-body text-center">

                  <form name="" id="form" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" />
                      {{ csrf_field() }}
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>FECHA:</label><br>
                      <select class="form-control" name="periodo" id="periodo">
                          <option selected></option>
                          @foreach ($periodos as $value)
                          <option value="{{$value->fecha}}">{{$value->fecha}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>TOTAL DE GASTOS DEL PERIODO:</label><br>
                      <h4 id="gasto"></h4>
                    </div>
                  </form>
                </div>
                <div class="panel-body" id="listadoregistros">
                      <div class="col-lg-12">
                          <table id="tabla_datos"  class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                              <th>GASTO</th>
                              <th>TIPO</th>
                              <th>IMPORTE</th>
                            </thead>
                          </table>
                      </div>
                  </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    <!-- /.row -->
    </div>
<!-- /#page-wrapper -->
  </div>
@endsection

@section('script')
<script src="{{ asset('/js/vistas/egresos/tipo-gasto.js')}}"></script>

@endsection
