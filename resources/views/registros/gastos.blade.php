@extends('template.main')
@section('titulo','Configuracion de Gastos')


@section('content')

{{-- ALTA DE REGISTROS--}}
<div class="modal fade" id="altaModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">ALTA DE REGISTROS</h4>
        </div>
        <div class="modal-body" id="">
           {{-- Alarma de BOOTSTRAP --}}
                <div class="alert alert-success collapse" id="exito_alta">
                  <a id="linkClose" href="#" class="close">&times;</a>
                     <strong>Registro con Exito!</strong>
              </div>
              {{-- FIN!!! Alarma de BOOTSTRAP --}}
              <div id="formularioregistros">
                    <div class="panel panel-default">
                      <div class="panel-body" >
                          <form name="" id="" method="POST">
                            <input type="hidden" id="token" value="{{ csrf_token() }}">
                            <div class="row">
                              <div class="col-lg-12">
                                <label>GASTO:</label><br>
                                <select class="form-control" name="tipo" id="selectBancos">
                                  <option selected></option>
                                  @foreach ($gasto as $key => $value)
                                    <option value={{$value->id}}>{{$value->gasto}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div>
                              <label>FORMA DE PAGO:</label><br>
                              <select class="form-control" name="tipo" id="selectCuentas">
                                <option selected></option>
                                @foreach ($forma_pagos as $key => $value)
                                  <option value={{$value->id}}>{{$value->forma_pagos}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div >
                              <label>IMPORTE:</label>
                              <input type="text" class="form-control" name="gasto" id="forma_alta" maxlength="50" placeholder="Nombre del gasto">
                            </div>

                            <div class="modal-footer">
                              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                              <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> VOLVER</button>
                            </div>
                          </form>
                        </div>
                    </div>
                      <!-- /.panel-body -->
                </div>
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
<div>
  <form id="form_eliminar" action="" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_eliminar">
    <input type="hidden" id="id_eliminar" name="id_eliminar" value="">
    <!-- Modal -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalEliminarLabel">Eliminar</h4>
          </div>
          <div class="modal-body">
            ¿Está seguro de eliminar:" <strong id="gasto_eliminar"></strong> "?
          </div>
          <div class="modal-footer">
            <button type="submit" id="eliminar" class="btn btn-primary">Aceptar</button>
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
   {{-- Alarma de ELIMINACION BOOTSTRAP --}}
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">ELIMINACION DE REGISTROS</h4>
          </div>
          <div class="modal-body" id="">
            
          </div>
        </div>
      </div>
    </div>
  {{-- FIN!!! Alarma de BOOTSTRAP --}}
    <!-- Modal -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="message_edit"></div>
            <h4 class="modal-title" id="modalEliminarLabel">Edicion</h4>
          </div>
          <div class="modal-body">
            <form id="form_edit" name="edit" action="" method="POST">
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
                  @foreach ($gasto as $key => $value)
                    <option value={{$value->id}}>{{$value->gasto}}</option>
                  @endforeach
                </select>
              </div>
              <div class="modal-footer">
                <button type="submit" id="editar" class="btn btn-primary">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
{{-- FIN EDICION DE REGISTROS --}}



<form action="prueba_submit" method="get" accept-charset="utf-8">
 <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_datatable">

<div class="container box">
   <h1 align="center">REGISTRACION DE GASTOS</h1>
   <br />
   <div class="table-responsive">
   <br />
    <div align="left">
     <button type="button" name="add" id="add" class="btn btn-info">AGREGAR</button>
    </div>
    <br />
    <div id="alert_message"></div>
    <table id="tabla_datos" class="table table-bordered table-striped">
     <thead>
      <tr>
         <th>BANCO</th>
         <th>CUENTA</th>
         <th>FORMA DE PAGO</th>
         <th></th>
       </tr>
     </thead>
    </table>
  </div>
</div>
</form>


@endsection

@section('script')

<script src="{{ asset('/js/registros/egresos/egresos.js')}}"></script>

@endsection