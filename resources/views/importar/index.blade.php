@extends('template.main')
@section('titulo','Configuracion de Gastos')


@section('content')

<form action="prueba_submit" method="get" accept-charset="utf-8">
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_datatable">
<div class="container box">
   <h1 align="center">IMPORTAR</h1><br />
   <input type="text" id="route-importar-liquidador" name="no-use" value="{{ route('importar.liquidador') }}">
   <div class="table-responsive"><br/>
      <div class="row">
        <div class="col-lg-12">
          <form name="" id="formulario" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" />
              {{ csrf_field() }}
            <div class="form-group col-lg-2 col-md-3 col-sm-3 col-xs-12">
              <input type="file" id="csv" name="csv">
              <button type="button" name="importar" id="btnImportar" class="btn btn-info">IMPORTAR</button>
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <h4 id="total"></h4>
            </div>
          </form>
        </div>
      </div>
            <div id="alert_message"></div>
  </div>
</div>
</form>


@endsection

@section('script')

<script src="{{ asset('/js/importar/liquidador.js')}}"></script>

@endsection