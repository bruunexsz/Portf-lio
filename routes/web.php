<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\FiliadoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ForgotController;




Route::get('/', [SiteController::class, 'index']);
Route::get('/karate-do', [SiteController::class, 'karatedo']);
Route::get('/conheca-a-federacao-de-karate-paulista', [SiteController::class, 'fkp']);
Route::get('/noticias', [SiteController::class, 'noticias']);
Route::get('/fotos', [SiteController::class, 'fotos']);
Route::get('/resultados', [SiteController::class, 'resultados']);
Route::get('/eventos', [SiteController::class, 'eventos']);
Route::get('/contato', [SiteController::class, 'contato']);
Route::post('/inscritos-newsletter', [NewsletterController::class, 'store'])->name('armazenar-newsletter');


/* ########################### ÁREA DO FILIADO############################## */
Route::post('/login', [FiliadoController::class, 'login'])->name('login-action');
Route::get('/login', [FiliadoController::class, 'showLogin'])->name('login');

Route::get('/forgot-password', [ForgotController::class, 'show'])->name('password.request');

Route::post('password/email', [ForgotController::class, 'sendResetLinkEmail'])->name('password.email');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [FiliadoController::class, 'logout'])->name('logout');


     /* ########################### ÁREA DO FILIADO ############################## */
     Route::delete('/delete-newsletter/{id}',[NewsletterController::class,'desativar'])->name('deleteNewsletter');
     Route::get('/exportar-emails', [NewsletterController::class, 'exportarEmails'])->name('exportarEmails');


     Route::get('/visualizar-mensagem/{id}', [FiliadoController::class, 'visualizarMensagem'])->name('visualizarMensagem');

    Route::get('/dashboard', [FiliadoController::class, 'dashboard'])->name('painel');
    Route::get('/tabela-de-custos', [FiliadoController::class, 'custos']);
    Route::get('/promocao-de-kuy', [FiliadoController::class, 'kuy']);
    Route::post('/promocao-de-kuy', [FiliadoController::class, 'kuystore'])->name('promocao-de-kuy');
    Route::get('/area-do-filiado-renovacao-de-atleta', [FiliadoController::class, 'renovaFiliado']);
    Route::post('/area-do-filiado-renovacao-de-atleta', [FiliadoController::class, 'renovaFiliadoStore'])->name('renovacao-de-atleta');
    Route::get('/area-do-filiado-filiacao-de-associacao', [FiliadoController::class, 'filiacao']);
    Route::post('/area-do-filiado-filiacao-de-associacao', [FiliadoController::class, 'filiacaoStore'])->name('filiacao-store');
    Route::get('/area-do-filiado-filiacao-de-atleta', [FiliadoController::class, 'filiacaoFiliado']);
    Route::post('/area-do-filiado-filiacao-de-atleta', [FiliadoController::class, 'filiacaoFiliadoStore'])->name('filiacao-filiado-store');
    Route::get('/area-do-filiado-inscricao-para-campeonatos', [FiliadoController::class, 'campInscricao']);
    Route::post('/area-do-filiado-inscricao-para-campeonatos', [FiliadoController::class, 'campInscricaoStore'])->name(('camp-inscricao-store'));


    /* ########################### ÁREA DO ADMINISTRADOR ############################## */
    Route::get('/inscritos-newsletter', [NewsletterController::class, 'show']);


    Route::get('/visualizar-atleta/{id}', [AdminController::class, 'visualizarAtleta'])->name('visualizar-atleta');
    Route::post('/visualizar-atleta/{id}', [AdminController::class, 'visualizarAtleta'])->name('visualizar-atleta');
    
    Route::get('/visualizar-associacao/{id}', [AdminController::class, 'visualizarAssociacao'])->name('visualizar-associacao');
    Route::post('/visualizar-associacao/{id}', [AdminController::class, 'visualizarAssociacao'])->name('visualizar-associacao');

    Route::get('/visualizar-renovacao-atleta/{id}', [AdminController::class, 'visualizarRenovacaoAtletas'])->name('visualizar-renovacao-atleta');
    Route::post('/visualizar-renovacao-atleta/{id}', [AdminController::class, 'visualizarRenovacaoAtletas'])->name('visualizar-renovacao-atleta');



    Route::get('/visualizar-promocao-kyu/{id}', [AdminController::class, 'visualizarPromocaoKyu'])->name('visualizar-promocao-kyu');
    Route::post('/visualizar-promocao-kyu/{id}', [AdminController::class, 'visualizarPromocaoKyu'])->name('visualizar-promocao-kyu');



    Route::get('/filiacao-de-atletas', [AdminController::class, 'showAtletas']);
    Route::get('/filiacao-de-associacao', [AdminController::class, 'showAssociacoes']);
    Route::get('/renovacao-de-atleta', [AdminController::class, 'showRenovacoes']);
    Route::get('/inscricoes-para-promocao-de-kyu', [AdminController::class, 'showPromocoesKyu']);
    Route::get('/delete-adm/{id}', [AdminController::class, 'deleteAdm'])->name('delete-administrador');
    Route::get('/administradores-e-moderadores', [AdminController::class, 'showAdms'])->name('mostraAdms');
    Route::get('/edit-adm/{id}', [AdminController::class, 'editAdm'])->name('edit-administrador');
    Route::put('/update-adm/{id}', [AdminController::class, 'updateAdm'])->name('update-administrador');
    Route::delete('/delete-adm/{id}', [AdminController::class, 'deleteAdm'])->name('delete-administrador');
    Route::get('/edit-filiado/{id}', [FiliadoController::class, 'editFiliado'])->name('edit-filiado');
    Route::put('/update-filiado/{id}', [FiliadoController::class, 'updateFiliado'])->name('update-filiado');
    Route::get('/edita-filiado-adm/{id}', [AdminController::class, 'editFiliadoAdm'])->name('edita-filiado-adm-controll');
    Route::put('/update-filiado-adm/{id}', [AdminController::class, 'updateFiliadoAdm'])->name('update-filiado-controll');
    Route::delete('/delete-filiado-adm/{id}', [AdminController::class, 'deleteFiliadoAdm'])->name('delete-filiado-controll');
    Route::get('/edita-filiado-adm/{id}', [AdminController::class, 'editFiliadoAdm'])->name('edita-filiado-adm-controll');
    Route::put('/update-filiado-adm/{id}', [AdminController::class, 'updateFiliadoAdm'])->name('update-filiado-controll');
    Route::delete('/delete-filiado-adm/{id}', [AdminController::class, 'deleteFiliadoAdm'])->name('delete-filiado-controll');
    Route::get('/edita-mensagem/{id}', [AdminController::class, 'editMensagem'])->name('edita-mensagem-controll');
    Route::put('/update-mensagem/{id}', [AdminController::class, 'updateMensagem'])->name('update-mensagem-controll');
    Route::delete('/delete-mensagem/{id}', [AdminController::class, 'deleteMensagem'])->name('delete-mensagem-controll');
    Route::get('/cadastrar-administrador', [AdminController::class, 'cadastroAdm']);
    Route::post('/cadastrar-administrador', [AdminController::class, 'registerAdmAction'])->name('cadastra-adm');
    Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('/publica-mensagem', [AdminController::class, 'showMensagem']);
    Route::get('/cadastrar-mensagem', [AdminController::class, 'msgAction']);
    Route::post('/cadastrar-mensagem', [AdminController::class, 'registerMsgAction'])->name('cadastrar-mensagem');
    Route::get('/filiados', [AdminController::class, 'showUsers']);
    Route::get('/cadastrar-filiado', [AdminController::class, 'cadastro']);
    Route::post('/cadastrar-filiado', [AdminController::class, 'registerAction'])->name('cadastra-filiado');
});
