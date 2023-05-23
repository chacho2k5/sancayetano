<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\Reportes\ClienteOts;
use App\Http\Livewire\Estado\EstadoIndex;
use App\Http\Livewire\Ot\OtCreate;
use App\Http\Livewire\Ot\OtIndex;
use App\Http\Livewire\Articulo\ArticuloIndex;
use App\Http\Livewire\Cliente\ClienteIndex;
use App\Http\Livewire\Categoria\CategoriaIndex;
use App\Http\Livewire\Empleado\EmpleadoIndex;
use App\Http\Livewire\Usuario\UsuarioIndex;
//use App\Http\Livewire\Articulos;
use App\Http\Livewire\Cambiarestado\CambiarEstado;
use App\Http\Livewire\Cambiarestado\CambiarEstadoIndex;
use App\Http\Livewire\Cambiarestado\CerrarOt;
use App\Http\Livewire\Global\OtEdit;
use App\Http\Livewire\Global\OtHeaderEdit;
use App\Http\Livewire\Global\OtShow;
use App\Http\Livewire\Panel\PanelIndex;
use Illuminate\Support\Facades\Route;


/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

 return view('welcome');
*/

Route::redirect('/', 'login');

// Route::get('/', function () {
//     return view('dashboard');
// })->name('home');

Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/', function () {
//     return view('livewire.panel.panel-index');
// })->name('dashboard');

// Route::get('/',PanelIndex::class)->name('dashboard');


//Route::get('/alpine', function () {
 //   return view('alpine');
//})->name('alpine');
//
// Esto es del Jetstream
//
// Route::get('/dashboard', function () {
 // return view('dashboard');
// })->name('dashboard');

Route::middleware([
     'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
],)->group(function () {

   Route::get('/dashboard', function () {
        return view('dashboard');
   })->name('dashboard');

    // Route::get('/dashboard',PanelIndex::class)->name('dashboard');

    Route::get('/estados/index',EstadoIndex::class)->name('estados.index');
    Route::get('/ots/index',OtIndex::class)->name('ots.index');
    Route::get('/ots/create',OtCreate::class)->name('ots.create');

    Route::get('/cambiarestados',CambiarEstadoIndex::class)->name('cambiarestados.index');
    Route::get('/articulo/articulo-index',ArticuloIndex::class)->name('articulos.index');
    Route::get('/categoria/categoria-index',CategoriaIndex::class)->name('categorias.index');
    Route::get('/cliente/cliente-index',ClienteIndex::class)->name('clientes.index');
    Route::get('/empleado/empleado-index',EmpleadoIndex::class)->name('empleados.index');
    Route::get('/usuario/usuario-index',UsuarioIndex::class)->name('usuarios.index');
    
    // Se terminan de cargar los datos de la OT y alguna modificacion en el cuerpo
    Route::get('/cerrarots/{id}',CerrarOt::class)->name('cerrarots.index');
    // Se puede editar el encabezado de la OT
    Route::get('/editots/{id}',OtHeaderEdit::class)->name('editots.index');
    // Se muestra toda la OT
    Route::get('/showots/{id}',OtShow::class)->name('showots.index');
    // Reportes
    Route::get('reportes/clienteots',[ClienteOts::class,'index'])->name('clienteots.index');

    Route::get('/ots/ot', function () {
       return view('ot');
    })->name('ots.ot');
     
    Route::get('/planchado', function () {
        return view('planchado');
    })->name('planchado');
    
});

// Route::get('/estados/index',EstadoIndex::class)->name('estados.index');

//Route::resource('clientes',ClienteController::class);
//Route::resource('categorias',CategoriaController::class);
//Route::resource('articulos',ArticuloController::class);

// Rutas para el DATATABLE
// Esta ruta en realidad podria ser un metodo del ArticuloController
//Route::get('dt/clientes',[DatatableController::class,'clientes'])->name('dt.clientes');
//Route::get('dt/categorias',[DatatableController::class,'categorias'])->name('dt.categorias');
//Route::get('dt/articulos',[DatatableController::class,'articulos'])->name('dt.articulos');

// *** Ver cambiar / Revisar
// Aca cargo las rutas para los crud en livewire. cargo una plantilla previa para poder cargar cosas que
// solo se usarian en esta vista, estilos, componentes, etc


//
// LIVEWIRE
//
// Revisar xq no se si ya hacen falta ***

// Esta ruta en realidad podria ser un metodo del ArticuloController
//Route::get('dt/clientes',[DatatableController::class,'clientes'])->name('dt.clientes');
//Route::get('dt/categorias',[DatatableController::class,'categorias'])->name('dt.categorias');
//Route::get('dt/articulos',[DatatableController::class,'articulos'])->name('dt.articulos');

//exportar a excel / pdf
//Route::get('/cliente/export', ClienteIndex::class)-> name('exportExcel');



//Route::resource('cliente/excel',ClienteIndex::class);

// Route::get('categorias',Categorias::class)->name('categorias');
// Route::get('categorias/create',CategoriaShow::class)->name('categorias.create');
// Route::get('categorias/edit',CategoriaShow::class)->name('categorias.edit');
// Route::get('categorias',CategoriaShow::class)->name('categorias');
// Route::get('/articulos/index',Articulos::class)->name('articulos.index');

