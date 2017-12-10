@extends('template.main')
@extends('template.nav')
@section('title','titulo')

@section('content')
  <div id="page-wrapper">
    <div class="row">
        <!-- /.ACA COMIENZA EL FORMULARIO DE ALTA!!!!!! -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ALTA DE GASTOS
                </div>
                <div class="panel-body">
                    <form name="" id="" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>FECHA:</label>
                        <input type="date" class="form-control" name="fecha">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Gastos:</label><br>
                        <select class="form-control" name="gasto">
                          <option selected></option>
                          @foreach ($gastos as $key => $value)
                            <option value={{$value->id}}>{{$value->gasto}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>IMPORTE:</label>
                        <input type="decimal" class="form-control" name="importe" maxlength="50" placeholder="999.99">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                          <label>MESES:</label>
                          <select class="form-control" name="periodo">
                            <option selected></option>

                          @foreach ($periodos as $clave=>$value)

                            <option value={{$clave}}>{{$clave}}</option>
                          @endforeach
                          </select>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Gastos:</label><br>
                            <select class="form-control" name="gasto_buscar">
                              <option selected></option>
                              @foreach ($gastos as $key => $value)
                                <option value={{$value->id}}>{{$value->gasto}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>TIPOS DE GASTOS:</label><br>
                            <select class="form-control" name="tipo_buscar">
                              <option selected></option>
                              @foreach ($tipos as $key => $value)
                                <option value={{$value->id}}>{{$value->tipo}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>IMPORTE:</label><br>
                            <input type="decimal" class="form-control" name="importe_buscar" maxlength="50" placeholder="999.99">
                          </div>
                        </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> FILTRAR</button>
                        <a href="{{route('registrodegastos.index')}}" class="btn btn-success">SIN FILTROS</a>
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
            @foreach ($reg_gastos as $value)

      @php
        $saldo += $value->importe
      @endphp
            @endforeach
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  TOTAL DE GASTO:
              </div>
              <div class="panel-body text-center">
                  <h3>$ {{number_format($saldo,2)}}</h3>
              </div>
          </div>
      </div>

  <!-- /.ACA COMIENZA LA TABLA!!!!!! -->
          <div class="panel-body">
              <div class="col-lg-12">
                  <table id="mitabla" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>EDITAR</th>
                      <th>BORRAR</th>
                      <th>FECHA</th>
                      <th>GASTO</th>
                      <th>TIPO DE GASTO</th>
                      <th>IMPORTE</th>
                      <th>COMENTARIO</th>
                    </thead>
                      <tbody>
                        @foreach ($reg_gastos as $value)
                          <tr>
                            <td><a class="btn btn-info" href="{{ route('registrodegastos.edit', $value->id)}}"><i class="fa fa-pencil"></i></a></td>
                            <td><form method="POST" action =" {{route('registrodegastos.destroy', $value->id)}}">
                                  <input type="hidden" name="_method" value="delete" />
                                  {{ csrf_field() }}
                                  <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                            <td>{{date('Y-m', strtotime($value->fecha))}}</td>

                            <td>{{$value->gasto}}</td>
                            <td>{{$value->tipo}}</td>
                            <td>$ {{number_format($value->importe,2)}}</td>
                            <td>{{$value->comentario}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <th>EDITAR</th>
                        <th>BORRAR</th>
                        <th>FECHA</th>
                        <th>GASTO</th>
                        <th>TIPO DE GASTO</th>
                        <th>IMPORTE</th>
                        <th>COMENTARIO</th>
                      </tfoot>
                  </table>
              </div>
              <!-- /.col-lg-12 -->
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

  <script>
  $(document).ready(function(){
      $('#mitabla').DataTable(
{
        "aProcessing": true,//Activamos el procesamiento del datatables
        "aServerSide": true,//Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip',//Definimos los elementos del control de tabla
        buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
                ],
        "bDestroy": true,
        "iDisplayLength": 5,//Paginación
        "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
      }
    );
  });
</script>
@endsection
