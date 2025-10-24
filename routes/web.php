<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RolesypermisosController as Rolesypermisos;

use App\Http\Controllers\DependenciaController as Dependencia;
use App\Http\Controllers\Usuarios as Usuarios;
use App\Http\Controllers\AsistenciasController;
use App\Http\Controllers\EscalafonController;

use App\Http\Controllers\Firmaperu;
use App\Http\Controllers\BiotimeController;

use App\Http\Controllers\PapeletaspermisosController as Permisos;
use App\Http\Controllers\LicenciaspersonalController as Licencias;
use App\Http\Controllers\ReginicidenciasController as Incidencias;
use App\Http\Controllers\VacacionesController;

// CONSULTA DNI X RENIEC
use App\Http\Controllers\DnipcmController;

use App\Http\Controllers\CatatencionesController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PideController;


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
Route::get('dependencia', [Dependencia::class, 'index']);

// ROLES Y PERMISOS
Route::get('rolesypermisos', [Rolesypermisos::class,'index'])->name('Rolesypermisos');
Route::post('addpermisos', [Rolesypermisos::class,'addpermisos'])->name('addpermisos');
Route::post('updatepermisos', [Rolesypermisos::class,'updatepermisos'])->name('updatepermisos');
Route::get('verpermisos/{idrol}', [Rolesypermisos::class,'verpermisos'])->name('verpermisos');
Route::post('quitarperdelrol', [Rolesypermisos::class,'quitarperdelrol'])->name('quitarperdelrol');
Route::post('agregarperdelrol', [Rolesypermisos::class,'agregarperdelrol'])->name('agregarperdelrol');

// administracion de usuarios
// Route::post('agregarperdelrol', [Rolesypermisos::class,'agregarperdelrol'])->name('agregarperdelrol');
route::post('administracion/usuarios/getListarPermisoByUsuario', [Rolesypermisos::class,'getListarPermisoByUsuario'])->name('getListarPermisoByUsuario');

// USUARIOS

// Route::get('/usuarios/all',[Usuarios::class,'index'])->name('usuarios.all');
Route::get('datosuser/{dni}', [Usuarios::class, 'usuariosdepe']);
Route::get('listausuarios', [Usuarios::class, 'listausuarios']);



// CONSUMO DE DATOS PERSONALES CON FECHA DE NACIMIENTO Y REGIMEN
Route::get('datospersonales', [Usuarios::class, 'datospersonales']);

// REGISTRO DE ASISTENCIAS
Route::get('asistencias',[AsistenciasController::class, 'index'])->name('asistencias');
Route::get('asistencias/pdf',[AsistenciasController::class, 'pdf'])->name('asistencias.pdf');
Route::get('reordenamarcacion',[AsistenciasController::class, 'reordenamarcacion'])->name('reordenamarcacion');
Route::get('asistenciaxdni',[AsistenciasController::class, 'asistenciaxdni'])->name('asistenciaxdni');// para calendario
Route::get('listasistenciaxdni',[AsistenciasController::class, 'listasistenciaxdni'])->name('listasistenciaxdni');// para tablas

//REGISTRO DE VACACIONES
Route::get('vacaciones',[VacacionesController::class,'index'])->name('vacaciones.index');
Route::post('gestvacaciones/add',[VacacionesController::class,'add'])->name('vacaciones.add');
Route::get('gestvacaciones/idvacas',[VacacionesController::class,'buscarid'])->name('vacaciones.buscarid');

// REGISTRO DE EMPLEADOS DE LA BASE DE DATOS ESCALAFON
route::get('empleados',[EscalafonController::class,'index'])->name('empleados.index');
route::get('empleadosid',[EscalafonController::class,'empleadosid'])->name('empleados.empleadosid');
route::get('resuempleado',[EscalafonController::class,'resumen'])->name('empleados.resumen');
route::get('empleadoxdni',[EscalafonController::class,'empleadoxdni'])->name('empleados.empleadoxdni');
route::get('sincronizar',[EscalafonController::class,'sincronizar'])->name('empleados.sincronizar');
route::get('leerjson',[EscalafonController::class,'leerjson'])->name('empleados.leerjson');
route::get('postulantesquefaltan',[EscalafonController::class,'postulantesquefaltan'])->name('empleados.postulantesquefaltan');// para ver postulantes que faltan
route::get('actualizarjs',[EscalafonController::class,'actualizarjs'])->name('empleados.actualizarjs');
route::get('buscadistrito/{id}',[EscalafonController::class,'buscadistrito'])->name('empleados.buscadistrito');
route::get('verpostulante/{idenvio}',[EscalafonController::class,'verpostulante'])->name('empleados.verpostulante');
route::get('regimenpersonal',[EscalafonController::class,'regimenpersonal'])->name('empleados.regimenpersonal');
route::post('escalafon/addescalafon',[EscalafonController::class,'addescalafon'])->name('empleados.addescalafon');
route::post('escalafon/updescalafon',[EscalafonController::class,'updescalafon'])->name('empleados.updescalafon');

// CONSULTA DE DNI SEGUN RENIEC

route::get('dni/{num}',[Permisos::class,'dni'])->name('permisos.dni');
route::post('dni/consultadni',[DnipcmController::class,'consultadni'])->name('consultadni');
route::post('dni/dni_codveri',[DnipcmController::class,'dni_codveri'])->name('dni_codveri');
// get
route::get('dni/getdni/{dni}/{key}',[DnipcmController::class,'getdni'])->name('getdni');

// PAPELETAS DE SALIDAS
route::get('permisos',[Permisos::class,'index'])->name('permisos.index');

route::post('papeletassalidad/addpapaletas',[Permisos::class,'addpapaletas'])->name('permisos.addpapaletas');
route::post('papeletassalidad/updpapaletas',[Permisos::class,'updpapaletas'])->name('permisos.updpapaletas');
route::get('papeletassalidad/idpapeleta',[Permisos::class,'idpapeleta'])->name('permisos.idpapeleta');
route::get('papeletassalidad/updretorno',[Permisos::class,'updretorno'])->name('permisos.updretorno');
route::get('papeletassalidad/busqueda',[Permisos::class,'busqueda'])->name('permisos.busqueda');
route::get('/licenciassalidad/mostrararchivo/{idfile}',[Permisos::class, 'mostrararchivo'])->name('mostrararchivo');
// route::get('/licenciassalidad/eliminapdf/{idfile}',[Permisos::class, 'eliminapdf'])->name('eliminapdf');

// licencias
route::get('licencia',[Licencias::class,'index'])->name('licencia.index');
route::post('licenciassalidad/addpapaletas',[Licencias::class,'addpapaletas'])->name('licencia.addpapaletas');
route::get('licenciassalidad/idpapeleta',[Licencias::class,'idpapeleta'])->name('licencia.idpapeleta');
route::get('licenciassalidad/updretorno',[Licencias::class,'updretorno'])->name('licencia.updretorno');
route::get('licenciassalidad/busqueda',[Licencias::class,'busqueda'])->name('licencia.busqueda');

// REGISTRO DE INICIDENCIAS

route::get('incidencias',[Incidencias::class,'index'])->name('incidencias.index');
Route::get('incidencias/pdf',[Incidencias::class, 'pdf'])->name('incidencias.pdf');


// firmaperu
route::post('firmaperu/parametros',[Firmaperu::class,'parametros'])->name('firmaperu.parametros');
route::get('firmaperu/archivpdf/{idFile?}/{idDocumento?}',[Firmaperu::class,'printPdfR'])->name('firmaperu.printPdfFirma');
route::post('firmaperu/upload',[Firmaperu::class,'upload'])->name('firmaperu.upload');

// biotime
route::get('biotime/marcaciones',[BiotimeController::class,'index'])->name('biotime.index');
route::get('biotime/marcacionxdni',[BiotimeController::class,'marcacion'])->name('biotime.marcacion');

// ticket
route::get('categoriaticket',[CatatencionesController::class,'index'])->name('ticket.index');// categoria de atenciones
route::get('ticket/pendientes',[TicketController::class,'pendientes'])->name('ticket.pendientes');// listar atenciones segun la dependencia del usuario y los que se atendio ya no va figurar
route::get('ticket/tipoayuda',[TicketController::class,'tipoayuda'])->name('ticket.tipoayuda');// listar atenciones segun la dependencia del usuario y los que se atendio ya no va figurar
route::get('ticket/soporte/users',[TicketController::class,'userssoporte'])->name('ticket.userssoporte');
route::get('ticket/porcentajeatencion',[TicketController::class,'porcentajeatencion'])->name('ticket.porcentajeatencion');
route::get('ticket/misticket',[TicketController::class,'misticket'])->name('ticket.misticket');

// DEPENDENCIA
Route::get('dependencia/usuariosoficina', [Dependencia::class, 'usuariosoficina'])->name('dependencia.usuariosoficina');
Route::get('dependencia/soporteinformatico', [Dependencia::class, 'soporteinformatico'])->name('dependencia.soporteinformatico');
Route::get('dependencia/soportedj', [Dependencia::class, 'soportedj'])->name('dependencia.soportedj');

// PIDE
Route::get('sis/{dni}', [PideController::class, 'sis'])->name('pide.sis');
Route::get('essalud/{dni}', [PideController::class, 'essalud'])->name('pide.essalud');
Route::get('sunat/{ruc}', [PideController::class, 'sunat'])->name('pide.sunat');
Route::get('antecedentejudicial/{pat}/{mat}/{nom}', [PideController::class, 'antecedentejudicial'])->name('pide.antecedentejudicial');
Route::get('proveedorsancionado/{ruc}', [PideController::class, 'proveedorsancionado'])->name('pide.proveedorsancionado');
Route::get('busprocselxexpediente/{exp}', [PideController::class, 'busprocselxexpediente'])->name('pide.busprocselxexpediente');
Route::get('busprocselxrucaniomes/{ruc}/{anio}/{mes}', [PideController::class, 'busprocselxrucaniomes'])->name('pide.busprocselxrucaniomes');
Route::get('proveedoradjudicadoxexpediente/{exp}', [PideController::class, 'proveedoradjudicadoxexpediente'])->name('pide.proveedoradjudicadoxexpediente');
Route::get('proveeadjxrucyanio/{ruc}/{anio}', [PideController::class, 'proveeadjxrucyanio'])->name('pide.proveeadjxrucyanio');
Route::get('sunedu/{dni}', [PideController::class, 'sunedu'])->name('pide.sunedu');
Route::get('gradoinstituto/{dni}', [PideController::class, 'gradoinstituto'])->name('pide.gradoinstituto');
Route::get('infocolnacioparticular/{id}', [PideController::class, 'infocolnacioparticular'])->name('pide.infocolnacioparticular');
Route::get('conadis/{dni}', [PideController::class, 'conadis'])->name('pide.conadis');
Route::get('juntos/{dni}', [PideController::class, 'juntos'])->name('pide.juntos');
Route::get('pension/{dni}', [PideController::class, 'pension'])->name('pide.pension');
Route::get('toke_qaliwarma', [PideController::class, 'toke_qaliwarma'])->name('pide.toke_qaliwarma');

// pide sunarp
Route::get('sunarp/perjuridica/{ruc}', [PideController::class, 'perjuridica'])->name('pide.sunarp.perjuridica');
Route::get('sunarp/oficinas', [PideController::class, 'sunarpoficinas'])->name('pide.sunarpoficinas');
Route::get('sunarp/propiedaddni/{dni}', [PideController::class, 'sunarpropiedaddni'])->name('pide.propiedaddni');
Route::get('sunarp/propiedadruc/{ruc}', [PideController::class, 'sunarpropiedadruc'])->name('pide.sunarpropiedadruc');

Route::get('/{any?}', [HomeController::class, 'show'])->where('any', '^(?!api\/)[\/\w\.-]*');
// Route::get('/', [HomeController::class, 'index']);
