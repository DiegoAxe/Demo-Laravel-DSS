<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditorialesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//las rutas deben de colocarse desde las mas especificas hasta las mas generales
Route::get('/', function () {
    return to_route('/routes/mostrarDatos.php');
});

Route::get('/hola', function () {
    return "Hola Mundo";
});

Route::get('/hola/en', function () {
    return "Hello World";
});

Route::get('/hola/{nombre}', function ($nombre) {
    return "Hola $nombre";
});

Route::controller(EditorialesController::class)->group(function (){
/*no se debe de ingresar lo anterior, solamente el metodo a utilizar*/
Route::get('/editoriales', 'index');

Route::get('/editoriales/create', 'create');

Route::get('/editoriales/edit/{id}','edit');

});

//Route::get('/editoriales', [EditorialesController::class,'index']);
//
//Route::get('/editoriales/create', [EditorialesController::class,'create']);
//
//Route::get('/editoriales/edit/{id}', [EditorialesController::class,'edit']);
