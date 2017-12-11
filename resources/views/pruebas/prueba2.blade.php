@extends('template.main')
@extends('template.nav')
@section('title','titulo')

@section('content')

  <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="abrir">ABRIR</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ALTA DE GENEROS</h4>
      </div>
      <div class="modal-body">

        <form name="" id="form" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" />
            {{ csrf_field() }}
          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <label>TIPO de GASTOS:</label><br>
            <select class="form-control" name="tipo" id="tipo">
              <option selected></option>
              @foreach ($tipos as $key => $value)
                <option value={{$value->id}}>{{$value->tipo}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <label>GASTOS:</label><br>
            <select class="form-control" name="gasto" id="gasto">
            </select>
          </div>
          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" style="display:none" id="div_suma">
            <label>TOTAL:</label><br>
            <input type="text" value="" class="form-control" name="suma_importe" id="suma_importe" disabled>
          </div>


          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <button type="submit"  class="btn btn-primary" id="registro"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  <div id="page-wrapper">
      <div class="row"><br>
        <div id="exito" class="alert alert-success alert-dismissible" role="alert" style="display:none">
          <strong> AGREGADO CORRECTAMENTE.</strong>
        </div>


            <div class="col-lg-8">
              <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Cuidado!</strong> Es muy importante que leas este mensaje de alerta.
              </div>
            </div>


        {{-- <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ALTA DE GENEROS
                </div>
                <div class="panel-body"> --}}
                    {{-- <form name="" id="" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" />
                        {{ csrf_field() }}
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Gastos:</label><br>
                        <select class="form-control" name="gasto" id="gasto">
                          <option selected></option>
                          @foreach ($gastos as $key => $value)
                            <option value={{$value->id}}>{{$value->gasto}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>TIPO:</label><br>
                        <select class="form-control" name="tipo" id="tipo">

                        </select>
                      </div>


                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button type="submit"  class="btn btn-primary" id="registro"><i class="fa fa-save"></i> Guardar</button>
                        <a href="" class="btn btn-primary" id="registro"></i> Guardar</a>
                      </div>
                    </form> --}}


                {{-- </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div> --}}



          <div class="panel-body">
              <div class="col-lg-12">
                  <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">

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

@section('script')
<script src="{{ asset('/js/prueba.js')}}"></script>

@endsection
