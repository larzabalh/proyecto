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



Route::get('/registros/registrodegastos/listar/{periodo}/{gasto_filtro}', 'RegistrodeGastosController@listar');
Route::post('/registros/registrodegastos/editar/{id}', 'RegistrodeGastosController@editar');
Route::post('/registros/registrodegastos/eliminar/{id}', 'RegistrodeGastosController@eliminar');
Route::resource('/registros/registrodegastos', 'RegistrodeGastosController');


Route::get('/registros/ctacte/clientes/listar/{gasto_filtro}', 'CtaCteClientesController@listar');
Route::post('/registros/ctacte/clientes/editar/{id}', 'CtaCteClientesController@editar');
Route::post('/registros/ctacte/clientes/eliminar/{id}', 'CtaCteClientesController@eliminar');
Route::resource('/registros/ctacte/clientes', 'CtaCteClientesController');


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
Route::get('/home', 'HomeController@index')->name('home');