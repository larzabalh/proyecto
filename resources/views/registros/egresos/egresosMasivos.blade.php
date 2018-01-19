@extends('template.main')
@section('titulo','Registro de Egresos Masivos')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
          <div class="container box">
              <h1 align="center">REGISTRACION DE EGRESOS</h1><br />
                <div class="row">
                  <div class="form-group col-lg-2 col-md-3 col-sm-3 col-xs-12">
                    <button class="btn btn-primary" type="submit" id="btnAsignar"><i class="fa fa-save"></i> Asignar</button>
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>FECHA</label>
                    <input type="date" class="form-control" name="gasto" id="fecha">
                  </div>
                  <div class="form-group col-lg-4 col-md-3 col-sm-3 col-xs-12">
                  TOTAL DE INGRESOS: <h3 id="total"></h3>
                  </div>
                </div>
            <div id="alert_message"></div>


            <!-- Abro el form e inicializo la logica de la tabla -->
            <form name="" id="" method="POST">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
            <!-- // inicio la variable vacia -->
            @php $forma_pago=''; $x=0; @endphp
            @foreach ($gastos_mensuales as $data)
            @php $x++; @endphp
            <!-- //reviso si el registro anterior es el mismo gasto -->
            @if($forma_pago!=$data->forma_pago)
            <!-- //si es asi la guardo en la variable  -->
                @php $forma_pago=$data->forma_pago @endphp
            <!-- //cierro el div anterior para registros superiores a 1 -->
                @if($x!=1) 
                  </form>
                @endif
            <!-- ahora si genero el header del div -->
                  <div class="row"><center><h3>{{$forma_pago}}</h3></center></div>
            @endif
                        <table id="tabla" class="table table-responsive table-hover table-bordered">
                          <tbody>
                            <tr>
                               <th>Nº</th>
                               <th width='25%'>GASTO</th>
                               <th width='25%'>TIPO DE GASTO</th>
                               <th width='25%'>IMPORTE</th>
                               <th width='25%'>COMENTARIO</th>
                            </tr>
                        <!-- voy generando las filas una a una -->
                            <tr>
                              <td>{{$x}}</td>
                              <td>
                                <input type="hidden" name="calcular[{{$data->forma_de_pagos_id}}]" value="{{$data->importe}}" id="calcular">
                                <input type="hidden" name="gastos[{{$data->gasto_id}}]" value="{{$data->gasto_id}}">
                                <input type="hidden" name="forma_de_pagos_id[{{$data->forma_de_pagos_id}}]" value="{{$data->forma_de_pagos_id}}">

                                {{$data->gasto}}
                              </td>
                              <td>
                                <select name="tipo_gasto[{{$x}}]" id="tipo_gasto{{$x}}" disabled>
                                    <option value="{{$data->id_tipo}}"selected="selected">{{$data->tipo}}</option>
                                    @foreach ($tipos_de_gastos as $value)
                                    <option value="{{$value->id}}">{{$value->tipo}}</option>
                                    @endforeach
                                </select>
                              </td>
                              <td> 
                                <input type="number" class="sumar form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" name="importe[{{$data->id}}]" value="{{$data->importe}}">
                              </td>
                              <td><input type="decimal" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" name="comentarios[{{$data->id}}]" value="{{$data->comentario}}">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                @endforeach        
            </div>       
          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->
</div>
@endsection

@section('script')

<script src="{{ asset('/js/registros/egresos/egresosMasivos.js')}}"></script>

@endsection