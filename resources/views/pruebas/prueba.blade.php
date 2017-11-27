@extends('template.main')

@section('title','titulo')

@section('content')




  <div id="page-wrapper">
      <div class="row"><br>
        <div id="exito" class="alert alert-success alert-dismissible" role="alert" style="display:none">
          <strong> AGREGADO CORRECTAMENTE.</strong>
        </div>
        <div id="error" class="alert alert-danger alert-danger" role="alert" style="display:none">
          <strong> ALGO SALIO MAL.</strong>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ALTA DE GENEROS
                </div>
                <div class="panel-body">
                    <form name="" id="" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" />
                        {{ csrf_field() }}

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" id="genero"name="genero" maxlength="50" placeholder="Tipo del Gasto">
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {{-- <button type="submit"  class="btn btn-primary" id="registro"><i class="fa fa-save"></i> Guardar</button> --}}
                        <a href="" class="btn btn-primary" id="registro"></i> Guardar</a>
                      </div>
                    </form>


                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>



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
