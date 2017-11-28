
@section('title','titulo')
@extends('template.main')



@section('content')



  <div id="page-wrapper">
    <div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>¡Cuidado!</strong> Es muy importante que leas este mensaje de alerta.
    </div>

      <div class="row">
          <div class="panel-body" id="formulario">
            <h1 class="box-title"> Alta Gastos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
        </div>
        <div class="col-lg-6" id="formularioregistros">
            <div class="panel panel-default">

                <div class="panel-body" >
                    <form name="" id="" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" name="gasto" maxlength="50" placeholder="Nombre del gasto">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Tipo de Gastos:</label><br>
                        <select class="form-control" name="tipo">
                          <option selected></option>
                          @foreach ($tipos as $key => $value)
                            <option value={{$value->id}}>{{$value->tipo}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                        <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Volver</button>
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



          <div class="panel-body" id="listadoregistros">
              <div class="col-lg-12">
                  <table id="tabla_datos"  class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>EDITAR</th>
                      <th>BORRAR</th>
                      <th>BORRAR2</th>
                    </thead>
                  </table>

                    {{-- <thead>
                      <th>EDITAR</th>
                      <th>BORRAR</th>
                      <th>GASTO</th>
                      <th>TIPO DE GASTO</th>
                      <th>CONDICION</th>
                    </thead> --}}
                      {{-- <tbody> --}}
                        {{-- @foreach ($gastos as $key => $value)
                          <tr>
                            <td><a class="btn btn-info" href="{{ route('gasto.edit', $value->id)}}"><i class="fa fa-pencil"></i></a></td>
                            <td><form method="POST" action =" {{route('gasto.destroy', $value->id)}}">
                                  <input type="hidden" name="_method" value="delete" />
                                  {{ csrf_field() }}
                                  <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                </form>

                            </td>
                            <td>{{$value->gasto}}</td>
                            <td>{{$value->tipo_de_gasto->tipo}}</td>
                            <td>{{$value->condicion}}</td>
                          </tr>
                        @endforeach --}}
                      {{-- </tbody> --}}
                      {{-- <tfoot>
                        <th>EDITAR</th>
                        <th>BORRAR</th>
                        <th>GASTO</th>
                        <th>TIPO DE GASTO</th>
                        <th>CONDICION</th>
                      </tfoot> --}}
                  {{-- </table> --}}
              </div>
              <!-- /.col-lg-12 -->
          </div>



          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->
@endsection



  {{-- <script>
  function init(){
    limpiar();
      mostrarform(false);

  }

  //Función mostrar formulario
  function mostrarform(flag)
  {

      if (flag)
      {
          $("#listadoregistros").hide();
          $("#formularioregistros").show();
          $("#btnGuardar").prop("disabled",false);
          $("#btnagregar").hide();
      }
      else
      {
          $("#listadoregistros").show();
          $("#formularioregistros").hide();
          $("#btnagregar").show();
      }
  }

  function limpiar()
  {
      $("#gasto").val("");

  }

  function cancelarform()
  {
      limpiar();
      mostrarform(false);
  }

  init(); --}}





  {{-- $(document).ready(function(){
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
</script> --}}

@section('script')
<script src="{{ asset('/js/gasto/gasto.js')}}"></script>

@endsection
