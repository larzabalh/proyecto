@extends('template.main')
@section('titulo','Cta Cte Clientes')


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
                            <input type="hidden" class="form-control" id="id_editar">
                            <input type="hidden" class="form-control" id="contabilidad_anterior">
                            <div class="row">
                              <div class="col-lg-12" id="fecha">
                                <label>FECHA</label><br>
                                <input type="date" class="form-control" name="gasto" id="fecha_alta">
                              </div>
                              <div class="col-lg-12">
                                <label>GASTO:</label><br>
                                <select class="form-control" name="tipo" id="selectCliente">
                                  <option selected></option>
                                  @foreach ($clientes as $key => $value)
                                    <option value={{$value->id}}>{{$value->cliente}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div>
                              <label>FORMA DE PAGO:</label><br>
                              <select class="form-control" name="tipo" id="selectBanco">
                                <option selected></option>
                                @foreach ($disponibilidad_id as $key => $value)
                                  <option value={{$value->id}}>{{$value->bancos}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div >
                              <label>IMPORTE:</label>
                              <input type="number" class="form-control" name="gasto" id="importe_alta" maxlength="50" placeholder="1000">
                            </div>
                             <div>
                                <label>COMENTARIO</label><br>
                                <input type="text" class="form-control" name="gasto" id="comentario_alta">
                            </div>
                            <fieldset>
                                <label>DEBITO - CREDITO</label><br>
                                <label>
                                    <input type="radio" name="contabilidad" id="debe" value="debe"> FACTURA
                                </label>
                                <label>
                                    <input type="radio" name="contabilidad" id="haber" value="haber"> PAGO
                                </label>
                            </fieldset>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                              <button class="btn btn-primary" type="submit" id="btnEditar" style='display:none;'><i class="fa fa-edit"></i> editar</button>
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
          <div class="modal-body" id="modal_eliminar"></div>
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


<form action="prueba_submit" method="get" accept-charset="utf-8">
 <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_datatable">
<div class="container box">
   <h1 align="center">CUENTAS CORRIENTES DE CLIENTES</h1><br />   

      <div class="row">
        <div class="col-lg-12">
          <form name="" id="form" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" />
              {{ csrf_field() }}
            <div class="form-group col-lg-1 col-md-3 col-sm-3 col-xs-12">
              <button type="button" name="add" id="add" class="btn btn-info">AGREGAR</button>
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <label>CLIENTE:</label><br>
              <select class="form-control" name="periodo" id="cliente">
                  @foreach ($cliente_id as $value)
                  <option value="{{$value->id}}">{{$value->clientes}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <label>Saldo del Cliente:</label><br>
              <h4 id="saldo"></h4>
            </div>
          </form>
        </div>
      </div>
  
    <div id="alert_message"></div>
  <div class="table-wrapper">
    <table id="tabla_datos" class="table table-bordered table-hover">
       <tbody id="content_table"></tbody>
    </table>
    </div>

</div>
</form>

@endsection

@section('script')

<script src="{{ asset('/js/registros/CtaCte/clientes.js')}}"></script>

@endsection