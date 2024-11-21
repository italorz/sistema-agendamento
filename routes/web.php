<?php

use App\Http\Controllers\AdmController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AutController;
use App\Http\Controllers\CriarUsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicoController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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

Route::prefix('adm')->group(function () {
    Route::get('/agendamentos', [AdmController::class, 'agendamentos'])->middleware('auth.usuario')->name('adm.agendamentos');
    Route::get('/agendamentos/atendimento', [AdmController::class, 'create'])->middleware('auth.usuario')->name('adm.atendimento');
    Route::post('/agendamentos/atendimento/post', [AdmController::class, 'post'])->middleware('auth.usuario')->name('adm.agendamento.post');
    Route::get('/agendamentos/atendimento/edit/{id?}', [AdmController::class, 'edit'])->middleware('auth.usuario');
    Route::put('/agendamento/update/{id}', [AdmController::class, 'update'])->name('adm.agendamento.update');


    Route::resource('/servicos', ServicoController::class)->middleware('auth.usuario');
    Route::get('/servicos/create', [ServicoController::class, 'create'])->name('servicos.create');
    Route::post('/servicos', [ServicoController::class, 'store'])->name('servicos.store');
    Route::delete('/servicos/{id}', [ServicoController::class, 'delete'])->name('servicos.destroy');
});


Route::prefix('/agenda')->group(function () {
    Route::get('/data', [AgendaController::class, 'data'])->middleware('auth.usuario')->name('agenda.data');
    Route::post('/datahora', [AgendaController::class, 'datahora'])->middleware('auth.usuario')->name('agenda.datahora');
    Route::get('/hora', [AgendaController::class, 'hora'])->middleware('auth.usuario')->name('agenda.hora');
    Route::post('/horaservico', [AgendaController::class, 'horaservico'])->middleware('auth.usuario')->name('agenda.horaservico');
    Route::get('/servico', [AgendaController::class, 'servico'])->middleware('auth.usuario')->name('agenda.servico');
    Route::post('/servicoconcluido', [AgendaController::class, 'servicoconcluido'])->middleware('auth.usuario')->name('agenda.servicoconcluido');
    Route::post('/offadm', [AgendaController::class, 'offadm'])->middleware('auth.usuario')->name('agenda.offadm');
    Route::get('/adm/usuario', [AgendaController::class, 'admusuario'])->middleware('auth.usuario')->name('agenda.admusuario');
    Route::get('/concluido', [AgendaController::class, 'concluido'])->middleware('auth.usuario')->name('agenda.concluido');
});


Route::prefix('usuario')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('pages.login');
    Route::post('aut', [LoginController::class, 'aut'])->name('aut.usuario.post');
    Route::get('criar', [LoginController::class, 'create'])->name('criar.usuario.post');
    Route::post('autCreate', [LoginController::class, 'autCreate'])->middleware('auth.usuario')->name('criar.aut');
    Route::get('historico', [LoginController::class, 'historico'])->middleware('auth.usuario')->name('usuario.historico');
    Route::get('completo', [LoginController::class, 'completo'])->middleware('auth.usuario')->name('historico.completo');
    Route::get('historico/{id?}', [LoginController::class, 'historicoId'])->middleware('auth.usuario')->name('usuario.historicoId');
    Route::post('completo/data', [LoginController::class, 'historicodata'])->middleware('auth.usuario')->name('historico.completo.data');
    Route::get('completo/resultado', [LoginController::class, 'historicoresultado'])->middleware('auth.usuario')->name('historico.completo.resultado');
});

Route::redirect('/', 'usuario/login');
