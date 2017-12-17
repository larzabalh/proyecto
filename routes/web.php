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

Route::get('/configuracion/gasto-listar', 'GastosController@listar');
Route::post('/configuracion/gasto/editar/{id}', 'GastosController@editar');
Route::post('/configuracion/gasto/eliminar/{id}', 'GastosController@eliminar');
Route::post('/configuracion/gasto/eliminar_masivos/{id}','GastosController@eliminar_masivos')->name('gastos.eliminar_masivos');
Route::resource('/configuracion/gasto', 'GastosController');


Route::get('/configuracion/tipos_de_gastos/listar', 'Tipo_de_gastoController@listar');
Route::post('/configuracion/tipos_de_gastos/editar/{id}', 'Tipo_de_gastoController@editar');
Route::post('/configuracion/tipos_de_gastos/eliminar/{id}', 'Tipo_de_gastoController@eliminar');
Route::resource('/configuracion/tipos_de_gastos', 'Tipo_de_gastoController');



Route::resource('/registros/registrodegastos', 'RegistrodeGastosController');
Route::resource('/clientes', 'ClienteController');
Route::resource('/ingresos/mensual', 'IngresoMensualController');
Route::resource('/ingresos', 'IngresosController');
  Route::post('/ingresos/ingresos', 'IngresosController@asignar')->name('ingresos.asignar');


Route::get('/pruebas/listar', 'PruebaController@listar');
Route::resource('/pruebas', 'PruebaController');



Route::get('/vistas/egresos/tipo_gasto', 'Vistas\Egresos\Tipo_GastoController@index')->name('vistas.egresos.tipo_gasto');
Route::get('/vistas/egresos/tipo_gasto/select_gasto/{id}', 'Vistas\Egresos\Tipo_GastoController@select_gasto');
Route::get('/vistas/egresos/tipo_gasto/suma_importe/{id}', 'Vistas\Egresos\Tipo_GastoController@suma_importe');
Route::get('/vistas/egresos/tipo_gasto/{periodo}', 'Vistas\Egresos\Tipo_GastoController@periodo');


Route::get('/vistas/egresos/tipo', 'Vistas\Egresos\TipoController@index')->name('vistas.egresos.tipo');
Route::get('/vistas/egresos/tipo/select_tipo/{id}/{periodo}', 'Vistas\Egresos\TipoController@select_tipo');




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
