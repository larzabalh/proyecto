
@extends('template.main')
@section('titulo','Configuracion de Gastos')
@section('content')
  <div id="page-wrapper">
    <div class="row">
      {{-- Alarma de BOOTSTRAP --}}
        <div class="row" class="center-block">
          <div class="alert alert-success collapse col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-offset-1" id="exito">
            <a id="linkClose" href="#" class="close">&times;</a>
              Exito! El Gasto: "<strong><span id="gasto_exito"></span></strong>" dado de alta!!!
          </div>
        </div>
        {{-- FIN!!! Alarma de BOOTSTRAP --}}

        <div class="panel-body" id="formulario">
            <h1 class="box-title"> Gastos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
        </div>
        <div class="col-lg-6" id="formularioregistros">
            <div class="panel panel-default">

                <div class="panel-body" >
                    <form name="" id="" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" name="gasto" id="gasto"maxlength="50" placeholder="Nombre del gasto">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Tipo de Gastos:</label><br>
                        <select class="form-control" name="tipo" id="tipo">
                          <option selected></option>
                          @foreach ($tipos as $key => $value)
                            <option value={{$value->id}}>{{$value->tipo}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                        <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Volver</button>
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
          <div class="panel-body" id="listadoregistros">
              <div class="col-lg-12">
                  <table id="tabla_datos"  class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>GASTOS</th>
                      <th>TIPO DE GASTOS</th>
                      <th></th>
                    </thead>
                  </table>
              </div>
              <!-- /.col-lg-12 -->
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->
@endsection

@section('script')

<script src="{{ asset('/js/gasto/gasto.js')}}"></script>

@endsection
