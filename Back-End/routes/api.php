<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\PessoaProfissionalController;
use App\Http\Controllers\guiaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('Estado',[homeController::class, 'getEstados']);
Route::get('Cidade/{id}',[homeController::class, 'getCidades']);
Route::get('Especialidade',[homeController::class, 'getEspecialidade']);
Route::get('Servico/{id}',[homeController::class, 'getServico']);
Route::get('Servico',[homeController::class, 'getAllServico']);

Route::get('Profissional/{id}',[ProfissionalController::class, 'show']);

Route::post('Profissional/create',[PessoaProfissionalController::class, 'store']);

Route::post('Profissional',[ProfissionalController::class, 'update']);
Route::get('GuiaMedico',[guiaController::class, 'searchAll']);
Route::get('GuiaMedico/Pesquisa',[guiaController::class, 'search']);
