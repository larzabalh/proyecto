@extends('template.main')
@section('titulo','Configuracion de Gastos')


@section('content')

{{-- ALTA DE REGISTROS--}}
<div class="modal fade" id="altaModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div id="alert_modal"></div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="tituloModal"></h4>
        </div>
        <div class="modal-body" id="">
              <div id="formularioregistros">
                    <div class="panel panel-default">
                      <div class="panel-body" >
                          <form name="" id="formulario" method="POST">
                            <input type="hidden" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" class="form-control" id="id_editar">
                            <div class="row">
                              <div class="col-lg-6">
                                <label>FECHA de Registro</label><br>
                                <input type="text" class="fecha form-control" name="gasto" id="fecha">
                              </div>
                              <div class="col-lg-6">
                                <label>FECHA a COBRAR</label><br>
                                <input type="text" class="fecha form-control" name="gasto" id="fecha_cobrar">
                              </div>
                              <div class="col-lg-6">
                                <label>IMPORTE:</label>
                                <input type="number" class="form-control" id="importe" maxlength="50">
                              </div>
                              <div class="col-lg-6">
                                  <label>BANCO</label><br>
                                  <input type="text" class="form-control" id="banco">
                              </div>
                              <div class="col-lg-6">
                                  <label>Nº CH</label><br>
                                  <input type="number" class="form-control" id="numero">
                              </div>
                              <div class="col-lg-6">
                                <label>TIPO:</label><br>
                                <select class="form-control" name="tipo" id="tipo">
                                  <option selected></option>
                                  <option value="abierto">ABIERTO</option>
                                  <option value="cruzado">CRUZADO</option>
                                </select>
                              </div>
                              <div class="col-lg-6">
                                  <label>CLIENTE:</label><br>
                                  <select class="form-control" id="cliente_id">
                                    <option selected></option>
                                      @foreach ($cliente_id as $key => $value)
                                    <option value={{$value->id}}>{{$value->cliente}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col-lg-6">
                                  <label>TITULAR</label><br>
                                  <input type="text" class="form-control" id="titular">
                              </div>
                              <div class="col-lg-6">
                                  <label>DESTINO</label><br>
                                  <input type="text" class="form-control" id="destino">
                              </div>
                              <div class="col-lg-6">
                              <fieldset>
                                  <label>
                                      <input type="radio" name="pagar" id="impago" value="" checked="checked"> PENDIENTE
                                  </label>
                                  <label>
                                      <input type="radio" name="pagar" id="pagado" value="1"> COBRADO
                                  </label>
                                  <label style='display:none;' id="chek_banco">
                                  <input type="checkbox" name="banco" value="1" id="banco"> Registrar en el Banco<br>
                                  </label>
                              </fieldset>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                                <button class="btn btn-primary" type="submit" id="btnEditar" style='display:none;'><i class="fa fa-edit"></i> editar</button>
                                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> VOLVER</button>
                              </div>
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

{{-- PASAR A PAGADOS--}}
<div class="modal fade" id="ModalPagados"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div id="alert_modal_pagados"></div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title"">PASAR A PAGADOS</h4>
        </div>
        <div class="modal-body" id="">
              <div id="formularioregistros">
                    <div class="panel panel-default">
                      <div class="panel-body" >
                          <form name="" id="" method="POST">
                            <input type="hidden" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" class="form-control" id="id_editar">
                            <div class="row">
                              <div class="col-lg-12" id="fecha">
                                <label>FECHA:</label><br>
                                <input type="text" class="form-control" id="periodo_pasar_a_pagados" disabled>
                              </div>
                              <div class="col-lg-12" >
                                <ol id="conceptos_pasar_pagados">
                                  
                                </ol>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="submit" id="btnpasarpagados"><i class="fa fa-save"></i> Pasar Pagados</button>
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
            ¿Está seguro de eliminar:" <strong id="registro_eliminar"></strong> "?
          </div>
          <div class="modal-footer">
            <button type="submit" id="btneliminar" class="btn btn-primary">Aceptar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
  </form>
</div>
{{-- FIN ELIMINACION DE REGISTROS --}}


<form action="prueba_submit" method="get" accept-charset="utf-8">
 <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_datatable">
<div class="container box">
   <h1 align="center">CHEQUES</h1><br />   
   <div class="table-responsive"><br/>
      <div class="row">
        <div class="col-lg-12">
          <form name="" id="form" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" />
              {{ csrf_field() }}
            <div class="form-group col-lg-2 col-md-3 col-sm-3 col-xs-12">
              <button type="button" name="add" id="btnAgregar" class="btn btn-info">AGREGAR</button>
              <input type="text" id="probandofechas">
            </div>
            <fieldset>
                <label>
                    <input type="radio" name="estado" id="cobrados" value="si"> COBRADOS
                </label>
                <label>
                    <input type="radio" name="estado" id="pendientes" value="no" checked="checked"> PENDIENTES
                </label>
            </fieldset>
            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <h4 id="total">TOTAL: </h4>
            </div>
            <div class="form-group col-lg-1 col-md-3 col-sm-3 col-xs-12">
              <button type="button" name="add" id="btnpagados" class="btn btn-primary">PASAR A PAGADOS</button>
            </div>
          </form>
        </div>
      </div>
    <div id="alert_message"></div>
    <table id="tabla_datos" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>FECHA</th>
        <th>COBRAR EL</th>
        <th>IMPORTE</th>
        <th>BANCO</th>
        <th>NUMERO</th>
        <th>TIPO</th>
        <th>CLIENTE</th>
        <th>TITULAR</th>
        <th>DESTINO</th>
        <th>ESTADO</th>
        <th></th>
       </tr>
     </thead>
    </table>
  </div>
</div>
</form>


@endsection

@section('script')

<script src="{{ asset('/js/registros/CtaCte/cheques.js')}}"></script>

@endsection