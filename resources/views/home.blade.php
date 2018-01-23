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

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#reales">REALES</a></li>
            <li><a data-toggle="tab" href="#menuprincipal1">PROYECTADO</a></li>
            <li><a data-toggle="tab" href="#menuprincipal2">OTRO</a></li>
        </ul>
        <div class="tab-content">
            <!-- Aca arranca la primer solapa!! -->
            <div id="reales" class="tab-pane fade in active">                    
            		<div class="col-lg-6"><br>
            			<div class="panel panel-default"> 
                            <div class="panel-heading">
                                <h3><CENTER id="total_ingresos">INGRESOS</CENTER></h3>
                            </div>
            					<ul class="nav nav-tabs">
            						<li class="active"><a data-toggle="tab" href="#home">TODOS</a></li>
            						<li><a data-toggle="tab" href="#menu1">IMPAGOS</a></li>
            						<li><a data-toggle="tab" href="#menu2">BANCOS</a></li>
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
            							<h3 id="titulo_saldosBancarios"></h3>
            							<p id="saldosBancarios"></p>
            						</div>
            					</div>
            			</div>
            		</div>
            		<div class="col-lg-6"><br>
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
                                            <li><a href="#gastos_cuarto" data-toggle="tab">PAGADOS</a>
                                            </li>
                                            <li><a href="#gastos_quinto" data-toggle="tab">IMPAGOS</a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="gastos_primero">
                                                <h4>Tipos de Gastos</h4>
                                                <p id="tiposGastos"></p>
                                            </div>
                                            <div class="tab-pane fade" id="gastos_segundo">
                                                <h4>Detalle de Gastos</h4>
                                                <p id="detalleGastos"></p>
                                            </div>
                                            <div class="tab-pane fade" id="gastos_tercero">
                                                <h4>Medios de Pagos</h4>
                                                <p id="mediosdepagosGastos"></p>
                                            </div>
                                            <div class="tab-pane fade" id="gastos_cuarto">
                                                <h4 id="titulo_GastosPagados">Pagados</h4>
                                                <p id="GastosPagados"></p>
                                            </div>
                                            <div class="tab-pane fade" id="gastos_quinto">
                                                <h4 id="titulo_GastosImpagos">Impagos</h4>
                                                <p id="GastosImpagos"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                    </div>
            </div>
            
            <!-- Aca arranca la otro solapa!! -->
            <div id="menuprincipal1" class="tab-pane fade">                    
                    <div class="col-lg-6"><br>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3><CENTER id="total_ingresos">INGRESOS</CENTER></h3>
                            </div>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home2">TODOS</a></li>
                                    <li><a data-toggle="tab" href="#menu21">IMPAGOS</a></li>
                                    <li><a data-toggle="tab" href="#menu22">BANCOS</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home2" class="tab-pane fade in active">
                                        <h3 id="titulo_ingresos_todos"></h3>
                                        <p id="ingresos_todos"></p>
                                    </div>
                                    <div id="menu21" class="tab-pane fade">
                                        <h3 id="titulo_ingresos_impagos"></h3>
                                        <p id="ingresos_impagos"></p>
                                    </div>
                                    <div id="menu22" class="tab-pane fade">
                                        <h3 id="titulo_saldosBancarios"></h3>
                                        <p id="saldosBancarios"></p>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-6"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3><CENTER id="total_egresos">EGRESOS 2</CENTER></h3>
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-pills">
                                            <li class="active"><a href="#gastos_primero_2" data-toggle="tab">TIPOS</a>
                                            </li>
                                            <li><a href="#gastos_segundo_2" data-toggle="tab">GASTOS</a>
                                            </li>
                                            <li><a href="#gastos_tercero_2" data-toggle="tab">MEDIOS DE PAGO</a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="gastos_primero_2">
                                                <h4>Tipos de Gastos</h4>
                                                <p id="tipos"></p>
                                            </div>
                                            <div class="tab-pane fade" id="gastos_segundo_2">
                                                <h4>Detalle de Gastos</h4>
                                                <p id="gastos"></p>
                                            </div>
                                            <div class="tab-pane fade" id="gastos_tercero_2">
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
            
            <!-- Aca arranca la otro solapa!! -->
            <div id="menuprincipal2" class="tab-pane fade">                    
                    <div class="col-lg-6"><br>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3><CENTER id="total_ingresos">OTRA COSA</CENTER></h3>
                            </div>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home3">TODOS</a></li>
                                    <li><a data-toggle="tab" href="#menu31">IMPAGOS</a></li>
                                    <li><a data-toggle="tab" href="#menu32">BANCOS</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home3" class="tab-pane fade in active">
                                        <h3 id="titulo_ingresos_todos"></h3>
                                        <p id="ingresos_todos"></p>
                                    </div>
                                    <div id="menu31" class="tab-pane fade">
                                        <h3 id="titulo_ingresos_impagos"></h3>
                                        <p id="ingresos_impagos"></p>
                                    </div>
                                    <div id="menu32" class="tab-pane fade">
                                        <h3 id="titulo_saldosBancarios"></h3>
                                        <p id="saldosBancarios"></p>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-6"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3><CENTER id="total_egresos">OTRA COSA</CENTER></h3>
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-pills">
                                            <li class="active"><a href="#gastos_primero_3" data-toggle="tab">otro</a>
                                            </li>
                                            <li><a href="#gastos_segundo_3" data-toggle="tab">otro 2</a>
                                            </li>
                                            <li><a href="#gastos_tercero_3" data-toggle="tab">OTRO 3</a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="gastos_primero_3">
                                                <h4>Tipos de Gastos</h4>
                                                <p id="tipos"></p>
                                            </div>
                                            <div class="tab-pane fade" id="gastos_segundo_2">
                                                <h4>Detalle de Gastos</h4>
                                                <p id="gastos"></p>
                                            </div>
                                            <div class="tab-pane fade" id="gastos_tercero_3">
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
            
        </div><!-- aca termina la pantalla de solapas -->
	</div>
</div>



@endsection
@section('script')

<script src="{{ asset('/js/home.js')}}"></script>

@endsection