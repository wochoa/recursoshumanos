<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RolesypermisosController as Rolesypermisos;

use App\Http\Controllers\DependenciaController as Dependencia;
use App\Http\Controllers\Usuarios as Usuarios;
use App\Http\Controllers\AsistenciasController;

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


// Auth::routes();

// Route::get('datosuser/{dni}', [Dependencia::class, 'usuariosdepe']);
// Route::get('listausuarios', [Dependencia::class, 'listausuarios']);

// ROLES Y PERMISOS
Route::get('rolesypermisos', [Rolesypermisos::class,'index'])->name('Rolesypermisos');
Route::post('addpermisos', [Rolesypermisos::class,'addpermisos'])->name('addpermisos');
Route::post('updatepermisos', [Rolesypermisos::class,'updatepermisos'])->name('updatepermisos');
Route::get('verpermisos/{idrol}', [Rolesypermisos::class,'verpermisos'])->name('verpermisos');
Route::post('quitarperdelrol', [Rolesypermisos::class,'quitarperdelrol'])->name('quitarperdelrol');
Route::post('agregarperdelrol', [Rolesypermisos::class,'agregarperdelrol'])->name('agregarperdelrol');

// USUARIOS

// Route::get('/usuarios/all',[Usuarios::class,'index'])->name('usuarios.all');
Route::get('datosuser/{dni}', [Usuarios::class, 'usuariosdepe']);
Route::get('listausuarios', [Usuarios::class, 'listausuarios']);


// CONSUMO DE DATOS PERSONALES CON FECHA DE NACIMIENTO Y REGIMEN
Route::get('datospersonales', [Usuarios::class, 'datospersonales']);

// REGISTRO DE ASISTENCIAS
Route::get('aistencias',[AsistenciasController::class, 'index'])->name('asistencias');



Route::get('/{any?}', [HomeController::class, 'show'])->where('any', '^(?!api\/)[\/\w\.-]*');
