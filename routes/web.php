<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/configuracion/bank','BankController@directory')->name('bank');
// Route::post('/configuracion/bank','BankController@alta')->name('bank-alta-post');
//
// Route::get('/configuracion/bank-editar/{id}', 'BankController@editar')->name('editarbank');
// Route::delete('/configuracion/bank-editar/{id}', 'BankController@delete')->name('borrarbank');
// Route::post('/configuracion/bank-editar/{id}', 'BankController@editar_grabar')->name('editarbank-post');

// DB::listen(function($query){
//
//   echo "<pre>{$query->sql}</pre>";
// });

Route::resource('/configuracion/gasto', 'GastosController');
Route::get('/configuracion/gasto-listar', 'GastosController@listar');
Route::resource('/configuracion/tipos_de_gastos', 'Tipo_de_gastoController');
Route::resource('/registros/registrodegastos', 'RegistrodeGastosController');
Route::resource('/clientes', 'ClienteController');
Route::resource('/ingresos/mensual', 'IngresoMensualController');
Route::resource('/ingresos', 'IngresosController');
  Route::post('/ingresos/ingresos', 'IngresosController@asignar')->name('ingresos.asignar');
Route::resource('/pruebas', 'PruebaController');
Route::get('/pruebas/select/{id}', 'PruebaController@select_tipo');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
