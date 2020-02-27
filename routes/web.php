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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('solicitantes','SolicitantesController');
Route::post('solicitantes/cambiar_status','SolicitantesController@cambiar_status')->name('solicitantes.cambiar_status');
Route::resource('insumos','InsumosController');
Route::resource('gerencias','GerenciasController');
Route::resource('areas','AreasController');
Route::resource('prestamos','PrestamosController');
Route::get('insumos/{id_gerencia}/buscar','PrestamosController@buscar_insumos');

/*Route::get('inventario/insumos', function () {
    return view('inventario/insumos/index');
});
Route::get('inventario/insumos/create', function () {
    return view('inventario/insumos/create');
});
*/
/*Route::get('inventario/prestamos', function () {
    return view('inventario/prestamos/index');
});
Route::get('inventario/prestamos/create', function () {
    return view('inventario/prestamos/create');
});
*/

Route::get('inventario/incidencias', function () {
    return view('inventario/incidencias/index');
});
Route::get('inventario/incidencias/create', function () {
    return view('inventario/incidencias/create');
});

/*Route::get('solicitantes', function () {
    return view('solicitantes/index');
});
Route::get('solicitantes/create', function () {
    return view('solicitantes/create');
});*/

Route::get('graficas', function () {
    return view('graficas/index');
});