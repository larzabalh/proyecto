@extends('template.main')
@section('titulo','TABLERO')
@section('content')
<div class="container box">
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<label>SELECCIONAR PERIODO:</label><br>
					<select class="form-control selectpicker" data-live-search="true" name="periodo" id="periodo">
						<option selected></option>
						@foreach ($periodos as $value)
						<option value="{{$value->fecha}}">{{$value->fecha}}</option>
						@endforeach
					</select>
				</div>
				<div class="panel panel-default">
                        <div class="panel-heading">
                            <h3><CENTER id="resultado"></CENTER></h3>
                        </div>
                </div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="panel panel-default">
                <div class="panel-heading">
                    <h3><CENTER id="total_ingresos">INGRESOS</CENTER></h3>
                </div>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#home">TODOS</a></li>
						<li><a data-toggle="tab" href="#menu1">IMPAGOS</a></li>
						<li><a data-toggle="tab" href="#menu2">COBRADOS</a></li>
					</ul>
					<div class="tab-content">
						<div id="home" class="tab-pane fade in active">
							<h3 id="titulo_ingresos_todos"></h3>
							<p id="ingresos_todos"></p>
						</div>
						<div id="menu1" class="tab-pane fade">
							<h3 id="titulo_ingresos_impagos"></h3>
							<p id="ingresos_impagos"></p>
						</div>
						<div id="menu2" class="tab-pane fade">
							<h3 id="titulo_ingresos_cobrados"></h3>
							<p id="ingresos_cobrados"></p>
						</div>
					</div>
			</div>
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