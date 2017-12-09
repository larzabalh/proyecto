
@extends('template.main')
@section('titulo','Configuracion de Gastos')
@section('content')
  <div id="page-wrapper">
    <div class="row">
      <!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="abrir"><i class="fa fa-plus" aria-hidden="true"></i> AGREGAR GASTO</button>

      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ALTA DE GASTOS</h4>
          </div>
          <div class="modal-body">

            {{-- Alarma de BOOTSTRAP --}}
                <div class="alert alert-success collapse" id="exito">
                  <a id="linkClose" href="#" class="close">&times;</a>
                    Exito! El Gasto: "<strong><span id="gasto_exito"></span></strong>" dado de alta!!!
              </div>
              {{-- FIN!!! Alarma de BOOTSTRAP --}}

              <div id="formularioregistros">
                  <div class="panel panel-default">

                      <div class="panel-body" >
                          <form name="" id="" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                            <div >
                              <label>Nombre:</label>
                              <input type="text" class="form-control" name="gasto" id="gasto"maxlength="50" placeholder="Nombre del gasto">
                            </div>
                            <div>
                              <label>Tipo de Gastos:</label><br>
                              <select class="form-control" name="tipo" id="tipo">
                                <option selected></option>
                                @foreach ($tipos as $key => $value)
                                  <option value={{$value->id}}>{{$value->tipo}}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="modal-footer">
                              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                              <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> VOLVER</button>
                            </div>
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
            </form>
          </div>
        </div>
      </div>


{{-- FORMULARIO DE EDICION --}}
<div class="row" id="form_edicion">
      <!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="abrir_edicion" style="display:none"><i class="fa fa-plus" aria-hidden="true"></i> AGREGAR GASTO</button>

      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">EDICION DE GASTOS</h4>
          </div>
          <div class="modal-body">

            {{-- Alarma de BOOTSTRAP --}}
                <div class="alert alert-success collapse" id="exito_edit">
                  <a id="linkClose_edit" href="#" class="close">&times;</a>
                    Exito! El Gasto: "<strong><span id="gasto_exito_edit"></span></strong>" dado de alta!!!
              </div>
              {{-- FIN!!! Alarma de BOOTSTRAP --}}

              <div>
                  <div class="panel panel-default">

                      <div class="panel-body" >
                          <form name="formulario_edicion" id="" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                            <input type="hidden" name="id" id="id_edicion">
                            <div >
                              <label>Nombre:</label>
                              <input type="text" class="form-control" name="gasto" id="gasto_edicion" maxlength="50" placeholder="Nombre del gasto">
                            </div>
                            <div>
                              <label>Tipo de Gastos:</label><br>
                              <select class="form-control" name="tipo" id="tipo_edicion">
                                <option selected></option>
                                @foreach ($tipos as $key => $value)
                                  <option value={{$value->id}}>{{$value->tipo}}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="modal-footer">
                              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                              <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> VOLVER</button>
                            </div>
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
            </form>
          </div>
        </div>
      </div>
</div>
{{-- FIN FORM EDICION --}}


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
