@extends('template.main')

@section('title','titulo')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <!-- /.ACA COMIENZA EL FORMULARIO DE ALTA!!!!!! -->


        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ALTA DE CLIENTES
                </div>
                <div class="panel-body">
                    <form name="" id="" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>RAZON SOCIAL:</label>
                        <input type="TEXT" class="form-control" name="cliente">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>HONORARIO:</label>
                        <input type="decimal" class="form-control" name="honorario" maxlength="50" placeholder="999.99">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>EMAIL:</label>
                        <input type="email" class="form-control" name="email" maxlength="50" placeholder="">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Factura:</label><br>
                        <select class="form-control" name="facturador">
                          <option selected></option>
                          @foreach ($facturadores as $key => $value)
                            <option value={{$value->id}}>{{$value->facturador}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Liquidador:</label><br>
                        <select class="form-control" name="liquidador">
                          <option selected></option>
                          @foreach ($liquidadores as $key => $value)
                            <option value={{$value->id}}>{{$value->liquidador}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Cobrador:</label><br>
                        <select class="form-control" name="cobrador">
                          <option selected></option>
                          @foreach ($cobradores as $key => $value)
                            <option value={{$value->id}}>{{$value->cobrador}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Deposita:</label><br>
                        <select class="form-control" name="disponibilidad">
                          <option selected></option>
                          @foreach ($disponibilidades as $key => $value)
                            <option value={{$value->id}}>{{$value->disponibilidad}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>CONTACTO:</label>
                        <input type="text" class="form-control" name="contacto" maxlength="50">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>COMENTARIO</label>
                        <input type="text" class="form-control" name="comentario" placeholder="Ingresa un comentario">
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
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
<!-- /.ACA ARRANCAN LOS FILTROS DE BUSQUEDAS -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    FILTROS
                </div>
                <div class="panel-body">
                  <div class="form-group col-lg-12 col-md-3 col-sm-3 col-xs-12">
                    <form name="" id="" method="get">
                      {{ csrf_field() }}
                        <div class="form-group col-lg-12 col-md-3 col-sm-3 col-xs-12">
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>CLIENTE:</label>
                          <select class="form-control" name="cliente_buscar">
                            <option selected></option>
                          @foreach ($todos_clientes as $clave=>$value)
                            <option value={{$value->id}}>{{$value->cliente}}</option>
                          @endforeach
                          </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>HONORARIO:</label><br>
                            <input type="decimal" class="form-control" name="honorario_buscar" maxlength="50" placeholder="999.99">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>EMAIL:</label><br>
                            <input type="text" class="form-control" name="email_buscar" maxlength="50" placeholder="">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>FACTURA:</label>
                          <select class="form-control" name="facturador_buscar">
                            <option selected></option>
                          @foreach ($facturadores as $clave=>$value)
                            <option value={{$value->id}}>{{$value->facturador}}</option>
                          @endforeach
                          </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>LIQUIDADOR:</label>
                          <select class="form-control" name="liquidador_buscar">
                            <option selected></option>
                          @foreach ($liquidadores as $clave=>$value)
                            <option value={{$value->id}}>{{$value->liquidador}}</option>
                          @endforeach
                          </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>COBRA:</label>
                          <select class="form-control" name="cobrador_buscar">
                            <option selected></option>
                          @foreach ($cobradores as $clave=>$value)
                            <option value={{$value->id}}>{{$value->cobrador}}</option>
                          @endforeach
                          </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>DEPOSITA:</label>
                          <select class="form-control" name="disponibilidad_buscar">
                            <option selected></option>
                          @foreach ($disponibilidades as $clave=>$value)
                            <option value={{$value->id}}>{{$value->disponibilidad}}</option>
                          @endforeach
                          </select>
                          </div>
                        </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> FILTRAR</button>
                        <a href="{{route('clientes.index')}}" class="btn btn-success">SIN FILTROS</a>
                      </div>
                    </form>
                  </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
      </div>

  <!-- /.ACA COMIENZA EL CALCULO DEL GASTO!!!!!! -->
      @php
        $saldo=0
      @endphp
            @foreach ($clientes as $value)

      @php
        $saldo += $value->honorario
      @endphp
            @endforeach
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  TOTAL DE INGRESOS:
              </div>
              <div class="panel-body text-center">
                  <h3>$ {{number_format($saldo,2)}}</h3>
              </div>
          </div>
      </div>


          <div class="panel-body">
              <div class="col-lg-12">
                <table class="table table-hover">
                  <tbody>
                  <tr>
                     <th>EDITAR</th>
                     <th>BORRAR</th>
                     <th>CLIENTE</th>
                     <th>HONORARIO</th>
                     <th>EMAIL</th>
                     <th>FACTURA</th>
                     <th>LIQUIDADOR</th>
                     <th>COBRADOR</th>
                     <th>DEPOSITA</th>
                     <th>CONTACTO</th>
                     <th>COMENTARIO</th>
                  </tr>
                  <tr>
                    @foreach ($clientes as $value)
                    <td><a class="btn btn-info" href="{{ route('clientes.edit', $value->id)}}"><i class="fa fa-pencil"></i></a></td>
                    <td><form method="POST" action =" {{route('clientes.destroy', $value->id)}}">
                          <input type="hidden" name="_method" value="delete" />
                          {{ csrf_field() }}
                          <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                        </form>
                    </td>
                    <td>{{$value->cliente}}</td>
                    <td>$ {{number_format($value->honorario,2)}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->facturador}}</td>
                    <td>{{$value->liquidador}}</td>
                    <td>{{$value->cobrador}}</td>
                    <td>{{$value->disponibilidad}}</td>
                    <td>{{$value->contacto}}</td>
                    <td>{{$value->comentario}}</td>
                  </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>



          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->

</div>
@endsection


@section('java')

{{-- <script>
  $(document).ready(function(){
      $('#mitabla').DataTable()
    });
</script> --}}
@endsection
