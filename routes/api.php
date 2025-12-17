<?php

// use App\Http\Controllers\APIController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PideController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/login', [APIController::class, 'login']);
// Route::post('/register', [APIController::class, 'register']);
// Route::post('/forget-password', [APIController::class, 'forget_pass']);
// Route::post('/reset-password', [APIController::class, 'reset_pass']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

// routes/api.php
// Route::post('/ticket/crear', [TicketController::class, 'crear']);
route::post('ticket/crear',[TicketController::class,'crear'])->name('ticket.crear');// listar atenciones segun la dependencia del usuario y los que se atendio ya no va figurar
route::post('ticket/atender',[TicketController::class,'atender'])->name('ticket.atender');
route::post('ticket/finalizar',[TicketController::class,'finalizar'])->name('ticket.finalizar');
route::post('ticket/Reporte',[TicketController::class,'Reporte'])->name('ticket.reporte');

Route::post('qaliwarma', [PideController::class, 'qaliwarma'])->name('pide.qaliwarma');


