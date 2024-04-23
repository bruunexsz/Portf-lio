<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController; // Importando o controlador
use App\Http\Controllers\HomeController; // Importando o controlador
use App\Http\Controllers\EquipesController; // Importando o controlador
use App\Http\Controllers\AtletasController; // Importando o controlador
use App\Http\Controllers\InstituicoesController; // Importando o controlador
use App\Http\Controllers\CategoriasController; // Importando o controlador
use App\Http\Controllers\FaixasController; // Importando o controlador
use App\Http\Controllers\UsuariosController; // Importando o controlador
use App\Http\Controllers\CompeticoesController; // Importando o controlador
use App\Http\Controllers\InscricoesController; // Importando o controlador
use App\Http\Controllers\ConfrontosController; // Importando o controlador







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

Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/login/{id}', [LoginController::class,'loginById']);


Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
    Route::get('/competicoes',[CompeticoesController::class,'showCompeticoes']);
    Route::get('/competicoes/criar', [CompeticoesController::class, 'showFormCreate'])->name('competicoes.create-form');
    Route::post('/competicoes', [CompeticoesController::class, 'store'])->name('competicoes.store');
    Route::get('/competicoes/relatorio/{competicao}',[CompeticoesController::class, 'showRelatorioComp'])->name('competicoes.relatorio');
    Route::get('/competicoes/{id}/editar', [CompeticoesController::class, 'showFormEdit'])->name('competicoes.edit-form');
    Route::put('/competicoes/{id}', [CompeticoesController::class,'updated'])->name('competicoes.update');


    
    Route::get('/confrontos/{competicao}', [ConfrontosController::class,'showConfrontos']);
    Route::get('/confrontos/pesagem/{id}/competicao/{competicao}',[ConfrontosController::class,'pesagem']);




    Route::get('/equipes',[EquipesController::class,'showEquipes']);
    Route::get('/equipes/criar', [EquipesController::class, 'showFormCreate'])->name('equipes.create-form');
    Route::post('/equipes', [EquipesController::class, 'store'])->name('equipes.store');



    Route::get('/atletas',[AtletasController::class,'showAtletas'])->name('show-atletas');
    Route::get('/atletas/criar', [AtletasController::class, 'showFormCreate'])->name('atletas.create-form');
    Route::post('/atletas', [AtletasController::class, 'store'])->name('atletas.store');
    Route::get('/atletas/{id}/editar', [AtletasController::class, 'showFormEdit'])->name('atletas.edit-form');
    Route::put('/atletas/{id}', [AtletasController::class, 'update'])->name('atletas.update');
    Route::delete('/atletas/{id}', [AtletasController::class, 'destroy'])->name('atletas.destroy');

    
    Route::get('/instituicoes',[InstituicoesController::class,'showInstituicoes']);
    Route::get('/instituicoes/criar',[InstituicoesController::class,'showFormCreate'])->name('instituicoes.create-form');
    Route::post('/instituicoes', [InstituicoesController::class, 'store'])->name('instituicoes.store');
    Route::get('/instituicoes/{id}/editar', [InstituicoesController::class, 'showFormEdit'])->name('instituicoes.edit-form');
    Route::put('/instituicoes/{id}', [InstituicoesController::class, 'update'])->name('instituicoes.update');



    Route::get('/faixas',[FaixasController::class,'showFaixas']);
    Route::get('/faixas/criar',[FaixasController::class,'showFormCreate'])->name('faixas.create-form');
    Route::post('/faixas', [FaixasController::class, 'store'])->name('faixas.store');

    
    Route::get('/usuarios',[UsuariosController::class,'showUsuarios']);
    Route::get('/usuarios/criar',[UsuariosController::class,'showFormCreate'])->name('usuarios.create-form');
    Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
    
    
    
    
    Route::get('/categorias',[CategoriasController::class,'showCategorias']);
    Route::get('/categorias/criar',[CategoriasController::class,'showFormCreate'])->name('categorias.create-form');
    Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{id}/editar', [CategoriasController::class, 'showFormEdit'])->name('categorias.edit-form');
    Route::put('/categorias/{id}', [CategoriasController::class, 'update'])->name('categorias.update');


    Route::post('/inscricoes/busca-categorias', [InscricoesController::class, 'buscaCategorias'])->name('inscricoes.busca-categorias');
    Route::post('/inscricoes', [InscricoesController::class, 'store'])->name('inscricoes.store');

    Route::get('/inscricoes/{competicao}', [InscricoesController::class, 'showInscricoes'])->name('inscricoes.show-inscritos');
    Route::get('/inscricoes/relatorio/{competicao}',[InscricoesController::class, 'showComp'])->name('inscricoes.show');
    Route::get('/inscricoes/criar/{competicao}', [InscricoesController::class, 'criainscricao']);
    Route::post('/inscricoes/{competicao}', [InscricoesController::class, 'store'])->name('inscricoes.store');
    Route::delete('/inscricoes/{id}', [InscricoesController::class, 'destroy'])->name('inscricoes.destroy');

});

