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
                
                @foreach ($forma_pagos as $value)
                <div class="row">{{$value->nombre}}
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
                            @foreach ($gastos as $value)
                            <tr>
                              <td></td>
                              <td>{{$value->gasto}}</td>
                              <td>
                                <select class="form-control" name="periodo" id="periodo">
                                    <option selected></option>
                                    @foreach ($tipos_de_gastos as $value)
                                    <option value="{{$value->id}}">{{$value->tipo}}</option>
                                    @endforeach
                                </select>
                              </td>
                              <td>                   
                                <input type="number" class="sumar form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" name="honorarios[]" value="">
                              </td>
                              <td><input type="decimal" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" name="comentarios[]" value="Honorario Mensual">
                              </td>
                            </tr>
                            @endforeach  
                            </tbody>
                          </table>
                  </form>
                </div>
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