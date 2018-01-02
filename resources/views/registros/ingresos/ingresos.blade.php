@extends('template.main')
@section('title','titulo')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">

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
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" id="fecha">
                        <label>FECHA</label>
                        <input type="date" class="form-control" name="gasto" id="fecha_alta">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" id="fecha">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> ASIGNAR</button>
                      </div>
                  </div>
              </div>
          </div>


          <div class="panel-body">
              <div class="col-lg-12">
                <form method="post" action =" {{route('ingresos.asignar', $value->id)}}">
                  <input type="hidden" name="_method" value="" />
                  {{ csrf_field() }}
                  {{ method_field('POST') }}
                <table class="table table-hover">
                  <tbody>
                  <tr>
                     <th>Nº</th>
                     <th>CLIENTE</th>
                     <th>HONORARIO</th>
                  </tr>
                  <tr>
                    @php $i=1;@endphp
                    @foreach ($clientes as $value)

                    <td>{{$i++}}</td>
                    <td>{{$value->cliente}}</td>
                    <td>
                      <input type="hidden" name="cliente[{{$value->id}}]" value="{{$value->id}}">
                      <input type="decimal" class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" name="honorario[{{$value->id}}]" value="{{$value->honorario}}">
                    </td>
                  </tr>
                    @endforeach

                  </tbody>
                </table>
                </form>
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

<script src="{{ asset('/js/registros/egresos/egresos.js')}}"></script>

@endsection