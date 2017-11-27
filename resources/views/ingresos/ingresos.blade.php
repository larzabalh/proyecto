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
              </div>
          </div>
      </div>


          <div class="panel-body">
              <div class="col-lg-12">
                <form method="post" action =" {{route('ingresos.asignar', $value->id)}}">
                  <input type="hidden" name="_method" value="" />
                  {{ csrf_field() }}
                  {{ method_field('POST') }}
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>PERIODO:</label><br>
                      <select class="form-control" name="periodo">
                        <option selected></option>
                        @foreach ($periodos as $key => $value)
                          <option value={{$value->id}}>{{$value->periodo}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('periodo_id'))
                         {{$errors->first('periodo_id')}}
                      @endif
                      <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
                      </div>
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
                      <input type="decimal" class="form-control" name="honorario[{{$value->id}}]" value="{{$value->honorario}}">
                    </td>
                  </tr>
                    @endforeach

                  </tbody>
                </table>
                <div class="">

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


@section('java')

{{-- <script>
  $(document).ready(function(){
      $('#mitabla').DataTable()
    });
</script> --}}
@endsection
