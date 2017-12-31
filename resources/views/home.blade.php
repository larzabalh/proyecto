@extends('template.main')
@section('titulo','TABLERO')
@section('content')
<div class="container box">
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<label>SELECCIONAR PERIODO:</label><br>
					<select class="form-control" name="periodo" id="periodo">
						<option selected></option>
						@foreach ($periodos as $value)
						<option value="{{$value->fecha}}">{{$value->fecha}}</option>
						@endforeach
					</select>
				</div>
			</div>

				<div class="row">
					<div class="col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3><CENTER>TOTAL INGRESOS</CENTER></h3>
							</div>
							<div class="panel-body text-center">
								aca estoy
							</div>	
						</div>
					</div>
					<div class="col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3><CENTER>TOTAL EGRESOS</CENTER></h3>
							</div>
							<div class="panel-body">
								<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" id="gastos"></div>
							</div>	
						</div>
					</div>
				</div>
		</div>
	</div>
</div>



@endsection
@section('script')

<script src="{{ asset('/js/home.js')}}"></script>

@endsection