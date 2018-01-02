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
                            <div class="row">
                              <div class="col-lg-12">
                                <label>RAZON SOCIAL</label><br>
                                <input type="text" class="form-control" id="cliente">
                              </div>
                              <div class="col-lg-12">
                                <label>HONORARIO</label><br>
                                <input type="number" class="form-control" id="honorario">
                              </div>
                              <div class="col-lg-12">
                                <label>EMAIL</label><br>
                                <input type="email" class="form-control" id="email">
                              </div>
                              <div class="col-lg-12">
                                <label>FACTURA:</label><br>
                                <select class="form-control" name="tipo" id="facturador_id">
                                  <option selected></option>
                                  @foreach ($facturadores as $key => $value)
                                    <option value={{$value->id}}>{{$value->facturador}}</option>
                                  @endforeach
                                </select>                              
                              </div>                            
                              <div class="col-lg-12">
                                <label>LIQUIDADOR:</label><br>
                                <select class="form-control" name="tipo" id="liquidador_id">
                                    <option selected></option>
                                    @foreach ($liquidadores as $key => $value)
                                      <option value={{$value->id}}>{{$value->liquidador}}</option>
                                    @endforeach
                                  </select>                              
                              </div>
                              <div class="col-lg-12">
                                <label>COBRADOR:</label><br>
                                <select class="form-control" name="tipo" id="cobrador_id">
                                    <option selected></option>
                                    @foreach ($cobradores as $key => $value)
                                      <option value={{$value->id}}>{{$value->cobrador}}</option>
                                    @endforeach
                                  </select>                              
                              </div>
                              <div class="col-lg-12">
                                <label>PAGA EN:</label><br>
                                <select class="form-control" name="tipo" id="disponibilidad_id">
                                    <option selected></option>
                                    @foreach ($disponibilidades as $key => $value)
                                      <option value={{$value->id}}>{{$value->nombre}}</option>
                                    @endforeach
                                  </select>                              
                              </div>
                              <div class="col-lg-12">
                                <label>CONTACTO</label>
                                <input type="text" class="form-control" id="contacto" maxlength="50" placeholder="nombre">
                              </div>
                              <div class="col-lg-12">
                                  <label>COMENTARIO</label><br>
                                  <input type="text" class="form-control" id="comentario">
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
            ¿Está seguro de eliminar:" <strong id="eliminar"></strong> "?
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


<form action="prueba_submit" method="get" accept-charset="utf-8">
 <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_datatable">
<div class="container box">
   <h1 align="center">CLIENTES</h1>
   <br />
   <div class="table-responsive"><br/>
      <div class="row">
        <div class="col-lg-12">
          <form name="" id="form" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" />
              {{ csrf_field() }}
            <div class="form-group col-lg-1 col-md-3 col-sm-3 col-xs-12">
              <button type="button" name="add" id="add" class="btn btn-info">AGREGAR</button>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12"><h4 id="total"></h4></div>
          </form>
        </div>
      </div>
    <div id="alert_message"></div>
    <table id="tabla_datos" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>CLIENTE</th>
        <th>HONORARIO</th>
        <th>EMAIL</th>
        <th>LE FACTURA</th>
        <th>LIQUIDADOR</th>
        <th>COBRADOR</th>
        <th>PAGA EN</th>
        <th>CONTACTO</th>
        <th>COMENTARIO</th>
        <th></th>
       </tr>
     </thead>
    </table>
  </div>
</div>
</form>


@endsection

@section('script')

<script src="{{ asset('/js/configuracion/ingresos/clientes.js')}}"></script>

@endsection