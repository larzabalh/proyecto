@extends('template.main')
@extends('template.nav')
@section('titulo','Configuracion de Gastos')
@section('content')
  <div id="page-wrapper">
    <div class="row">
      {{-- Alarma de ERROR BOOTSTRAP --}}
      <div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document">
      		<div class="modal-content">
      			<div class="modal-header">
      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      				<h4 class="modal-title alert alert-danger" id="myModalLabel">ERROR</h4>
      			</div>
      			<div class="modal-body" id="mensaje_error">
              <div class="alert alert-danger">
                No se pudo ejecutar la consulta!!!
              </div>
      			</div>
      		</div>
      	</div>
      </div>
      {{-- FIN!!! Alarma de BOOTSTRAP --}}


      <!-- ALTA DE REGISTROS -->
      <button type="button" class="btn btn-default btn-lg col-lg-offset-5" data-toggle="modal" data-target="#myModal" id="abrir"><i class="fa fa-plus" aria-hidden="true"></i> AGREGAR GASTO</button>
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
                          </form>
                        </div>
                      <!-- /.panel-body -->
                  </div>
                  <!-- /.panel -->
              </div>
          </div>
        </div>
      </div>

{{-- ELIMINACION DE REGISTROS --}}
    {{-- Alarma de ELIMINACION BOOTSTRAP --}}
  <div class="modal fade" id="exito_eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">ELIMINACION DE REGISTROS</h4>
        </div>
        <div class="modal-body" id="">
          <div class="alert alert-success">
            Exito! El Gasto: "<strong><span id="gasto_exito_eliminar"></span></strong>" ha sido eliminado!!!
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN!!! Alarma de BOOTSTRAP --}}
<div>
  <form id="frmEliminarUsuario" action="" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_eliminar">
    <input type="hidden" id="id_eliminar" name="id_eliminar" value="">
    <!-- Modal -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h4>
          </div>
          <div class="modal-body">
            ¿Está seguro de eliminar:" <strong id="gasto_eliminar"></strong> "?
          </div>
          <div class="modal-footer">
            <button type="button" id="eliminar" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
  </form>
</div>
{{-- FIN ELIMINACION DE REGISTROS --}}

{{-- EDICION DE REGISTROS --}}
    {{-- Alarma de BOOTSTRAP --}}
    <div class="alert alert-success collapse col-lg-8" id="exito_editar">
      <a id="linkClose" href="#" class="close">&times;</a>
        Exito! El Gasto: "<strong><span id="gasto_exito_editar"></span></strong>" ha sido Actualizado Correctamente!!!
  </div>
    {{-- FIN!!! Alarma de BOOTSTRAP --}}
  <form id="" action="" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_editar">
    <input type="hidden" id="id_editar" name="id_eliminar" value="">
    <!-- Modal -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalEliminarLabel">Edicion</h4>
          </div>
          <div class="modal-body">
            <form name="formulario_edicion" id="" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_edit">
              <input type="hidden" name="id" id="id_edicion">
              <div >
                <label>Nombre:</label>
                <input type="text" class="form-control" name="gasto" id="gasto_edicion"maxlength="50" placeholder="Nombre del gasto">
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
                <button type="button" id="editar" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              </div>
              </div>
            </form>
          </div>
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
      </div>
{{-- FIN EDICION DE REGISTROS --}}

{{-- DATATABLE --}}
<form id="frm-example" action="{{ asset('/js/gasto/gasto.js')}}" method="POST">
          <div class="panel-body" id="listadoregistros">
              <div class="col-lg-12">
                  <table id="tabla_datos"  class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>GASTOS</th>
                      <th>TIPO DE GASTOS</th>
                      <th>OPCIONES</th>
                      <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                    </thead>
                  </table>
              </div>
              <!-- /.col-lg-12 -->
              <p>Press <b>Submit</b> and check console for URL-encoded form data that would be submitted.</p>

              <p><button>Submit</button></p>

              <b>Data submitted to the server:</b><br>
              <pre id="example-console">
              </pre>
              </form>
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
