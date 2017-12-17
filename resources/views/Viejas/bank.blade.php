@extends('template.main')
@extends('template.nav')
@section('title','titulo')

@section('content')


  <div id="page-wrapper">
      {{-- <div class="row">
          <div class="col-lg-12">
            <br>
              <a href="{{'bank-alta'}}"><button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>ALTA DE BANCOS</button></a>
          </div>
          <!-- /.col-lg-12 -->
      </div> --}}
      <!-- /.row -->
      <div class="row">

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ALTA DE BANCOS
                </div>
                <div class="panel-body" id="formularioregistros">
                    <form name="" id="" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" name="banco" maxlength="50" placeholder="Nombre del banco">
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
                    </form>

                        <a href="{{'bank'}}" class="btn btn-primary"><i class="fa fa-save"></i>volver</a>
                      </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>



          <div class="panel-body">
              <div class="col-lg-12">
                  <table id="mitabla" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>OPCIONES</th>
                      <th>BANCO</th>
                      <th>CONDICION</th>
                    </thead>
                      <tbody>
                        @foreach ($bancos as $key => $value)
                          <tr>
                            <td>
                              <button class="btn btn-secondary"><a href="{{ route('editarbank', $value->id)}}"><i class="fa fa-pencil"></i></a></button>
                              <button class="btn btn-danger"><a href="{{ route('nota.de', $value->id)}}"><i class="fa fa-trash-o"></i></button>
                            </td>
                            <td>{{$value->banco}}</td>
                            <td>{{$value->condicion}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <th>OPCIONES</th>
                        <th>BANCO</th>
                        <th>CONDICION</th>
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
