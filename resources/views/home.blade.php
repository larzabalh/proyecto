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

				<!-- <div class="row">
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
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3><CENTER id="total_egresos"></CENTER></h3>
							</div>
							<div class="panel-body" id="div_egresos">
								<div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12" id="tipos"></div>
								<div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12" id="gastos"></div>
								<div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12" id="bancos"></div>
							</div>	
						</div>
					</div>
				</div> -->
		</div>
		
		<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3><CENTER id="total_egresos"></CENTER></h3>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#gastos_primero" data-toggle="tab">TIPOS</a>
                                </li>
                                <li><a href="#gastos_segundo" data-toggle="tab">GASTOS</a>
                                </li>
                                <li><a href="#gastos_tercero" data-toggle="tab">MEDIOS DE PAGO</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="gastos_primero">
                                    <h4>Tipos de Gastos</h4>
                                    <p id="tipos"></p>
                                </div>
                                <div class="tab-pane fade" id="gastos_segundo">
                                    <h4>Detalle de Gastos</h4>
                                    <p id="gastos"></p>
                                </div>
                                <div class="tab-pane fade" id="gastos_tercero">
                                    <h4>Medios de Pagos</h4>
                                    <p id="bancos"></p>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
	</div>
</div>



@endsection
@section('script')

<script src="{{ asset('/js/home.js')}}"></script>

@endsection