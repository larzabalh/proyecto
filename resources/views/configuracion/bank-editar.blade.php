@extends('template.main')

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
                      EDICION DE BANCOS
                  </div>
                  <div class="panel-body" id="formularioregistros">
                      <form name="" id="" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Nombre:</label>
                          <input type="text" value ="{{ $banco->banco}}" class="form-control" name="banco" maxlength="50" placeholder="Nombre del banco">
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
                      </form>

                          <a href="{{'bank'}}" class="btn btn-primary"><i class="fa fa-save"></i>volver</a>
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
