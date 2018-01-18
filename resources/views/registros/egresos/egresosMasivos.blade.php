@extends('template.main')
@section('titulo','Registro de Ingresos')

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

<!-- Esto es de Juan Carlos -->        

              <div>
<!-- // inicio la variable vacia -->
          @php $forma_pago=''; $x=0; @endphp
          @foreach ($gastos_mensuales as $value)
            @php $x++; @endphp
<!-- //reviso si el registro anterior es el mismo gasto -->
            @if($forma_pago!=$value->forma_pago)
<!-- //si es asi la guardo en la variable  -->
                @php $forma_pago=$value->forma_pago @endphp
<!-- //cierro el div anterior para registros superiores a 1 -->
                @if($x!=1) {{$forma_pago}}</div> @endif
              <!-- ahora si genero el header del div -->
            
                  <form name="" id="" method="POST">
                        <input type="hidden" id="token" value="{{ csrf_token() }}">
                          <div id="alert_message"></div>
                          <table id="tabla" class="table table-responsive table-hover table-bordered">
                            <tbody>
                            <tr>
                               <th>Nº</th>
                               <th width='25%'>GASTO</th>
                               <th width='25%'>TIPO DE GASTO</th>
                               <th width='25%'>IMPORTE</th>
                               <th width='25%'>COMENTARIO</th>
                            </tr>
                            @endif
                        <!-- voy generando las filas una a una -->
                            <tr>
                              <td>{{$x}}</td>
                              <td>{{$value->gasto}}</td>
                              <td>
                                <select name="periodo" id="periodo">
                                    <option selected></option>
                                    @foreach ($tipos_de_gastos as $value)
                                    <option value="{{$value->id}}">{{$value->tipo}}</option>
                                    @endforeach
                                </select>
                              </td>
                              <td>                   
                                <input type="number"  name="honorarios[]" value="">
                              </td>
                              <td><input type="decimal"  name="comentarios[]" value="Honorario Mensual">
                              </td>
                            </tr>
                            </tbody>
                          </table>
                  </form>
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

<script src="{{ asset('/js/registros/ingresos/ingresos.js')}}"></script>

@endsection