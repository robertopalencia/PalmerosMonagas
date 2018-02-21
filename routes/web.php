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
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Palma\Precio;
use Palma\User;
use Palma\Camion;
use Palma\Productor;
use Palma\Pesaje;
use Palma\Banco;
use Palma\Cupos;
//*********************** PRODUCTOR***********************************
Route::get('proagregar','ProductorController@vistaagregar');
Route::get('tablaproductores','ProductorController@listaproductores');
Route::post('/buscarproductor', 'ProductorController@buscarproductor');
Route::post('/agregarproductor', 'ProductorController@agregarproductor');
Route::get('tablaproductores', 'ProductorController@tablaproductores');
Route::delete('/tablaproductores/{id}','ProductorController@delete');
Route::put('/tablaproductores/{id}','ProductorController@update');
Route::get('/editarproductores/{id}','ProductorController@viewupdate');

//***********************VEHICULOS CAMIONES**********************************
Route::get('caagregar','VehiculoController@vistaagregar');
Route::get('tablacamiones','VehiculoController@listacamiones');
Route::post('/buscarcamion','VehiculoController@buscarcamion');
Route::post('/agregarcamion','VehiculoController@agregarcamion');
Route::get('/tablacamiones','VehiculoController@tablacamiones');
Route::delete('/tablacamiones/{id}','VehiculoController@delete');
Route::put('/tablacamiones/{id}','VehiculoController@update');
Route::get('/editarcamiones/{id}', 'VehiculoController@viewupdate');

//***********************VEHICULOS GANDOLAS**********************************
Route::get('tablagandolas','GandolaController@tabla');
Route::get('agregargandola','GandolaController@vistaagregar');
Route::post('/buscargandola','GandolaController@buscargandola');
Route::post('/buscargandolacamino','GandolaController@buscargandolacamino');
Route::post('/buscargandoladestino','GandolaController@buscargandoladestino');
Route::post('/agregargandola','GandolaController@agregargandola');
Route::get('/editargandola/{id}', 'GandolaController@viewupdate');
Route::delete('/tablagandola/{id}','GandolaController@delete');
Route::put('/tablagandolas/{id}','GandolaController@update');
Route::put('/editargandolas/{id}','PesajeController@updatecarga');
Route::get('gandolas', 'GandolaController@gandolas');
Route::get('/pesos/{id}', 'GandolaController@pesos');
Route::put('/pesos/{id}', 'GandolaController@updatepesos');
Route::get('/ubicacion/{id}', 'GandolaController@ubicacion');
Route::put('/ubicacion/{id}', 'GandolaController@updateubicacion');
Route::get('endestino', 'GandolaController@endestino');

//***********************USUARIO**********************************
Route::get('users','UsuarioController@listadousers');
Route::get('uagregar','UsuarioController@vistaagregar');
Route::post('/buscaruser', 'UsuarioController@buscaruser');
Route::post('/agregarusuario', 'UsuarioController@agregarusuario');
Route::delete('/users/{id}','UsuarioController@delete');
Route::put('/users/{id}', 'UsuarioController@update');
Route::get('/editarusuarios/{id}', 'UsuarioController@viewupdate');
Route::get('/users', 'UsuarioController@tablausers');

//***********************BANCOS**********************************
Route::get('agregarcuenta','BancoController@vistaagregar');
Route::post('/buscarbanco', 'BancoController@buscarbanco');
Route::post('/agregarbanco', 'BancoController@agregarbanco');
Route::get('/banco', 'BancoController@tablabancos');
Route::delete('/banco/{id}', 'BancoController@delete');
Route::put('/banco/{id}','BancoController@update');
Route::get('/editarcuenta/{id}','BancoController@updateview');

//***********************CUPOS**********************************
Route::get('cupos','CuposController@listarcupos');
Route::post('/buscarcupos','CuposController@buscarcupos');
Route::post('/agregarcupos', 'CuposController@agregarcupos');
Route::get('/cupos', 'CuposController@tablacupos');

//***********************PESAJE**********************************
Route::get('pagregar','PesajeController@vistaagregar');
Route::post('pdf','PesajeController@pdfrecibo');
Route::post('agregarcarga', 'PesajeController@agregarcarga');
Route::post('pdfcarga','PesajeController@pdfcarga');

//**********************DOCUMENTOS*******************************
Route::get('recibo','DocumentosController@recibo');
Route::get('informe','DocumentosController@listadoinforme');
Route::post('/buscarreciboproductor','DocumentosController@buscarreciboproductor');
Route::put('/recibo/{id}', 'DocumentosController@pagados');
Route::get('/editarrecibo/{id}','DocumentosController@confirmacionpago');      
Route::get('/informe','DocumentosController@informe');
Route::post('/buscarrecibopagados', 'DocumentosController@buscarrecibopago');

//**********************PDF*******************************
Route::get('pdfinforme','PdfController@pdfinforme');
Route::get('pdfinformepagos','PdfController@pdfinformepagos');
Route::post('pdfid','PdfController@pdfid');
Route::post('pdfguia','PdfController@pdfguia');

//**********************MAIN*******************************
Route::get('palma','MainController@index')->name('palma');
Route::get('estadisticas','MainController@estadisticas');
Route::get('precio','MainController@precio');
Route::get('agregarcupos','MainController@agregarcupos');
Route::post('/agregarprecio', 'MainController@agregarprecio');

//**********************AUTH*******************************

Auth::routes();
Route::get('home', 'HomeController@index')->name('home');
Route::get('/','Auth\LoginController@showLoginForm')->middleware('guest');
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@login'])->name('login');

Route::get('register2', 'MainController@register')->name('register2');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');













 
           












Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
