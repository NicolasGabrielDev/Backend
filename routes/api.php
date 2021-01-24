<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticadorControlador;
use App\Http\Controllers\PerguntaController;
use App\Http\Controllers\RespostaController;
use App\Http\Controllers\SessaoController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function() {
    Route::post('registro', [AutenticadorControlador::class, 'registro']);
    Route::post('login', [AutenticadorControlador::class, 'login']);
    Route::middleware('auth:api')->group(function() {
        Route::post('logout', [AutenticadorControlador::class, 'logout']);
    });
});

Route::post('sessao', [SessaoController::class, 'store'])->middleware('auth:api');
Route::post('entrar-sessao', [SessaoController::class, 'login'])->middleware('auth:api');
Route::get('perguntas', [PerguntaController::class, 'index'])->middleware('auth:api');
Route::post('criar-pergunta', [PerguntaController::class, 'store'])->middleware('auth:api');
Route::post('criar-resposta', [RespostaController::class, 'store'])->middleware('auth:api');
Route::get('respostas', [RespostaController::class, 'admin_respostas'])->middleware('auth:api');