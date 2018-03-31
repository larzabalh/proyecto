<?php
Route::get('/test', function(){

$user =new App\User;
$user->name='hernan';
$user->email='larzabalh@hotmail.com';
$user->rol='admin';
$user->password=bcrypt('123123');
$user->save();
return $user;
});


/*DB::listen(function($query){

  echo "<pre>{$query->sql}</pre>";
});*/

Route::post('/contactanos/store', 'contactanosController@store')->name('contactanos.store');
Route::get('/contactanos', 'contactanosController@index');


Route::get('/configuracion/egresos/gastos_mensuales/listar/{gasto_filtro}', 'GastosMensualesController@listar');
Route::post('/configuracion/egresos/gastos_mensuales/editar/{id}', 'GastosMensualesController@editar');
Route::post('/configuracion/egresos/gastos_mensuales/eliminar/{id}', 'GastosMensualesController@eliminar');
Route::resource('/configuracion/egresos/gastos_mensuales', 'GastosMensualesController');

Route::get('/configuracion/gasto-listar', 'GastosController@listar');
Route::post('/configuracion/gasto/editar/{id}', 'GastosController@editar');
Route::post('/configuracion/gasto/eliminar/{id}', 'GastosController@eliminar');
Route::post('/configuracion/gasto/eliminar_masivos/{id}','GastosController@eliminar_masivos')->name('gastos.eliminar_masivos');
Route::resource('/configuracion/gasto', 'GastosController');


Route::get('/configuracion/tipos_de_gastos/listar', 'Tipo_de_gastoController@listar');
Route::post('/configuracion/tipos_de_gastos/editar/{id}', 'Tipo_de_gastoController@editar');
Route::post('/configuracion/tipos_de_gastos/eliminar/{id}', 'Tipo_de_gastoController@eliminar');
Route::resource('/configuracion/tipos_de_gastos', 'Tipo_de_gastoController');


Route::get('/configuracion/medios/listar', 'MediosController@listar');
Route::post('/configuracion/medios/editar/{id}', 'MediosController@editar');
Route::post('/configuracion/medios/eliminar/{id}', 'MediosController@eliminar');
Route::resource('/configuracion/medios', 'MediosController');

Route::get('/configuracion/disponibilidades/listar', 'DisponibilidadesController@listar');
Route::post('/configuracion/disponibilidades/editar/{id}', 'DisponibilidadesController@editar');
Route::post('/configuracion/disponibilidades/eliminar/{id}', 'DisponibilidadesController@eliminar');
Route::resource('/configuracion/disponibilidades', 'DisponibilidadesController');

Route::get('/configuracion/forma_pagos/select/{id}', 'Forma_PagoController@selectCuentas');//Busca el select de cuentas, dependiendo el banco
Route::get('/configuracion/forma_pagos/listar', 'Forma_PagoController@listar');
Route::post('/configuracion/forma_pagos/editar/{id}', 'Forma_PagoController@editar');
Route::post('/configuracion/forma_pagos/eliminar/{id}', 'Forma_PagoController@eliminar');
Route::resource('/configuracion/forma_pagos', 'Forma_PagoController');


Route::get('/configuracion/registros/CtaCte/efectivo/listar', 'EfectivoController@listar');
Route::post('/configuracion/registros/CtaCte/efectivo/editar/{id}', 'EfectivoController@editar');
Route::post('/configuracion/registros/CtaCte/efectivo/eliminar/{id}', 'EfectivoController@eliminar');
Route::resource('/configuracion/registros/CtaCte/efectivo', 'EfectivoController');



//Egresos Individuales
Route::get('/registros/registrodegastos/listar/{periodo}/{gasto_filtro}/{pagado}', 'RegistrodeGastosController@listar');
Route::get('/registros/registrodegastos/listar_pasar_pagados/{periodo}/{pagado}', 'RegistrodeGastosController@listar_pasar_pagados');
Route::post('/registros/registrodegastos/editar/{id}', 'RegistrodeGastosController@editar');
Route::post('/registros/registrodegastos/pasar_pagados', 'RegistrodeGastosController@pasar_pagados');
Route::post('/registros/registrodegastos/eliminar/{id}', 'RegistrodeGastosController@eliminar');
Route::resource('/registros/registrodegastos', 'RegistrodeGastosController');

Route::get('/registros/egresos/egresosMasivos/listar', 'egresosMasivosController@listar');
Route::get('/registros/egresos/egresosMasivos/verificar', 'egresosMasivosController@verificarUnSoloEgresoMasivo');
Route::resource('/registros/egresos/egresosMasivos', 'egresosMasivosController');


Route::get('/registros/ctacte/clientes/listar/{gasto_filtro}', 'CtaCteClientesController@listar');
Route::get('/registros/ctacte/clientes/listar_impagas/{cliente_id}', 'CtaCteClientesController@listar_impagas');
Route::get('/registros/ctacte/clientes/listar_uno/{id}', 'CtaCteClientesController@listar_uno');
Route::post('/registros/ctacte/clientes/editar/{id}', 'CtaCteClientesController@editar');
Route::post('/registros/ctacte/clientes/eliminar/{id}', 'CtaCteClientesController@eliminar');
Route::post('/registros/ctacte/clientes/grabar', 'CtaCteClientesController@grabar');
Route::resource('/registros/ctacte/clientes', 'CtaCteClientesController');

Route::get('/registros/ctacte/disponibilidades/listar/{gasto_filtro}', 'Cta_Cte_DisponibilidadesController@listar');
Route::get('/registros/ctacte/disponibilidades/listar_uno/{id}', 'Cta_Cte_DisponibilidadesController@listar_uno');
Route::post('/registros/ctacte/disponibilidades/editar/{id}', 'Cta_Cte_DisponibilidadesController@editar');
Route::post('/registros/ctacte/disponibilidades/eliminar/{id}', 'Cta_Cte_DisponibilidadesController@eliminar');
Route::post('/registros/ctacte/disponibilidades/grabar', 'Cta_Cte_DisponibilidadesController@grabar');
Route::resource('/registros/ctacte/disponibilidades', 'Cta_Cte_DisponibilidadesController');


Route::prefix('/registros/ctacte/cheques')->group(function () {

	Route::get('/listar/{estado}', 'ChequeController@listar')->name('cheques.listar');
	Route::get('/listar_uno/{id}', 'ChequeController@listar_uno')->name('cheques.listar_uno');
	Route::post('/editar', 'ChequeController@editar')->name('cheques.editar');
	Route::post('/eliminar/{id}', 'ChequeController@eliminar')->name('cheques.eliminar');
	Route::post('/store', 'ChequeController@store')->name('cheques.store');
	Route::get('/', 'ChequeController@index')->name('cheques.index');
  });



Route::resource('/ingresos/mensual', 'IngresoMensualController');
Route::get('/registros/ingresos/ingresos/listar', 'IngresosController@listar');
Route::get('/registros/ingresos/ingresos/verificar', 'IngresosController@verificarUnSoloIngresoMasivo');
Route::resource('/registros/ingresos/ingresos', 'IngresosController');



Route::get('/pruebas/listar', 'PruebaController@listar');
Route::resource('/pruebas', 'PruebaController');



Route::get('/vistas/egresos/tipo_gasto', 'Vistas\Egresos\Tipo_GastoController@index')->name('vistas.egresos.tipo_gasto');
Route::get('/vistas/egresos/tipo_gasto/select_gasto/{id}', 'Vistas\Egresos\Tipo_GastoController@select_gasto');
Route::get('/vistas/egresos/tipo_gasto/suma_importe/{id}', 'Vistas\Egresos\Tipo_GastoController@suma_importe');
Route::get('/vistas/egresos/tipo_gasto/{periodo}', 'Vistas\Egresos\Tipo_GastoController@periodo');


Route::get('/vistas/egresos/tipo', 'Vistas\Egresos\TipoController@index')->name('vistas.egresos.tipo');
Route::get('/vistas/egresos/tipo/select_tipo/{id}/{periodo}', 'Vistas\Egresos\TipoController@select_tipo');




Route::get('/configuracion/ingresos/clientes/listar', 'ClienteController@listar');
Route::post('/configuracion/ingresos/clientes/editar/{id}', 'ClienteController@editar');
Route::post('/configuracion/ingresos/clientes/eliminar/{id}', 'ClienteController@eliminar');
Route::resource('/configuracion/ingresos/clientes', 'ClienteController');

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home/listar/{periodo}', 'HomeController@listar');
Route::post('/home/actualizar_cajas/{data}', 'HomeController@actualizar_cajas');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@store');