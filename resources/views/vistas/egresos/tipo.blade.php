@extends('template.main')

@section('title','titulo')

@section('content')

  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">

<!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3><CENTER>VISTA SEGUN LOS TIPOS DE GASTOS</CENTER></h3>
                </div>
                <div class="panel-body text-center">

                  <form name="" id="form" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" />
                      {{ csrf_field() }}
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>FECHA:</label><br>
                        <select class="form-control" name="periodo" id="periodo">
                            <option selected></option>
                            @foreach ($periodos as $value)
                            <option value="{{$value->periodo}}">{{$value->periodo}}</option>
                            @endforeach
                        </select>
                      </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>TIPO de GASTOS:</label><br>
                      <select class="form-control" name="tipo" id="tipo">
                        <option selected></option>
                        @foreach ($tipos as $key => $value)
                          <option value={{$value->id}}>{{$value->tipo}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" style="display:none" id="gastos">
                      <tbody>
                      <tr>
                         <th>Nº</th>
                         <th>GASTO</th>
                         <th>IMPORTE</th>
                      </tr>



                      </tbody>
                    </table>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      {{-- <button type="submit"  class="btn btn-primary" id="registro"><i class="fa fa-save"></i> Guardar</button> --}}
                    </div>
                  </form>
                </div>
            </div>
        </div>



        <!-- /.col-lg-12 -->
      </div>
    <!-- /.row -->
    </div>
<!-- /#page-wrapper -->
  </div>
@endsection

@section('script')
<script src="{{ asset('/js/vistas/egresos/tipo.js')}}"></script>

@endsection
