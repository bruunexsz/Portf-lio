<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipes;
use App\Models\Instituicoes;
use App\Models\Atletas;
use App\Models\Faixas;
use App\Models\Competicoes;
use App\Models\Inscricao;
use App\Models\CompeticoesCategorias;
use App\Models\Categorias;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class InscricoesController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showInscricoes(Request $request, $competicaoId)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $compId = $competicaoId; // Definindo $compId fora do bloco else


        if (!empty($keyword)) {
            $inscricoes = Inscricao::where('atleta', 'LIKE', "%$keyword%")
                ->orWhere('competicao', 'LIKE', "%$keyword%")
                ->orWhere('categoria', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $competicao = $request['competicao'];
            $user = auth()->user();



            if ($user->isAdmin()) {
                $inscricoes = Inscricao::where('competicao', $request['competicao'])->latest()->get();
                $competicaoAtual = Competicoes::latest('id')->first();
            } else {
                $user = auth()->user();
                $competicaoId = $competicaoId; // Adicione esta linha

                $inscricoes = Inscricao::whereHas('competicao_inscrito', function ($query) use ($competicaoId) {
                    $query->where('id', $competicaoId);
                })
                    ->where(function ($query) use ($user) {
                        $query->whereHas('atleta_inscrito', function ($query) use ($user) {
                            $query->whereHas('atleta_instituicao', function ($query) use ($user) {
                                $query->where('usuario', $user->id);
                            });
                        })
                            ->orWhereHas('equipe_inscrito', function ($query) use ($user) {
                                $query->whereHas('equipe_instituicao', function ($query) use ($user) {
                                    $query->where('usuario', $user->id);
                                });
                            });
                    })
                    ->latest()
                    ->get();
            }
        }

        return view('inscricoes.show', compact('inscricoes', 'competicao', 'compId'));
    }


    public function store(Request $request)
    {
        if (!empty($request->equipe)) {
            $this->validate($request, [
                'equipe' => 'required',
                'competicao' => 'required',
                'categoria' => 'required',
                'status' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'atleta' => 'required',
                'competicao' => 'required',
                'categoria' => 'required',
                'status' => 'required'
            ]);
        }
        $requestData = $request->all();
        foreach ($requestData['categoria'] as $categoria) {
            Inscricao::create(['atleta' => $requestData['atleta'], 'equipe' => $requestData['equipe'], 'competicao' => $requestData['competicao'], 'categoria' => $categoria, 'status' => 1]);
        }

        return redirect()->route('inscricoes.show-inscritos', ['competicao' => $requestData['competicao']])->with('success', 'Inscrição efetuada');
    }

    public function showComp(Request $request, $competicao)
    {
        $user = auth()->user();
        if (!$user->isAdmin()) {
            $inscricoes_collect = Inscricao::whereHas('competicao_inscrito', function ($query) use ($competicao) {
                $query->where('id', $competicao);
            })
                ->where(function ($query) use ($user) {
                    $query->whereHas('atleta_inscrito', function ($query) use ($user) {
                        $query->whereHas('atleta_instituicao', function ($query) use ($user) {
                            $query->where('usuario', $user->id);
                        });
                    })
                        ->orWhereHas('equipe_inscrito', function ($query) use ($user) {
                            $query->whereHas('equipe_instituicao', function ($query) use ($user) {
                                $query->where('usuario', $user->id);
                            });
                        });
                })
                ->get();
        } else {
            $inscricoes_collect = Inscricao::where('competicao', $competicao)->get();
        }


        $inscricoes = [];
        $instituicoes = [];
        
        foreach ($inscricoes_collect as $inscricao) {
            $instituicao = null;
            if ($inscricao->atleta_inscrito && $inscricao->atleta_inscrito->instituicao) {
                $instituicao = $inscricao->atleta_inscrito->instituicao;
            } elseif ($inscricao->equipe_inscrito && $inscricao->equipe_inscrito->instituicao) {
                $instituicao = $inscricao->equipe_inscrito->instituicao;
            }
        
            // Certifique-se de que a instituição não seja nula antes de acessá-la
            if ($instituicao !== null) {
                if (!isset($instituicoes[$instituicao])) {
                    $instituicoes[$instituicao] = Instituicoes::find($instituicao);
                }
                $inscricoes[$instituicao][] = $inscricao;
            }
        }
        
        $inscricoes = collect($inscricoes);
        $instituicoes = collect($instituicoes);
        
        return view('inscricoes.relatorio', compact('inscricoes', 'instituicoes'));
    }

    public function destroy($id)
    {
        $inscricao = Inscricao::find($id);
    
        // Verifique se a inscrição existe antes de tentar excluí-la
        if ($inscricao) {
            $competicao = $inscricao->competicao;
            $inscricao->delete();
            return redirect()->route('inscricoes.show-inscritos', ['competicao' => $competicao])->with('success', 'Inscrição do Atleta excluída com sucesso');
        } else {
            // Se a inscrição não for encontrada, redirecione com uma mensagem de erro
            return redirect()->route('inscricoes.show')->with('error', 'Inscrição não encontrada');
        }
    }
    public function criainscricao(Request $request)
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $atletas = Atletas::get()->pluck('nome', 'id');
            $equipes = Equipes::get()->pluck('nome', 'id');
        } else {
            $atletas = Atletas::whereHas('atleta_instituicao', function ($query) use ($user) {
                $query->where('usuario', $user->id);
            })->get()->pluck('nome', 'id');
            $equipes = Equipes::whereHas('equipe_instituicao', function ($query) use ($user) {
                $query->where('usuario', $user->id);
            })->get()->pluck('nome', 'id');
        }
        $atletas = collect(['' => 'Selecione um atleta'] + $atletas->all());
        $equipes = collect(['' => 'Selecione uma equipe'] + $equipes->all());

        $competicoes = Competicoes::where('inicio_inscricao', '<=', date("Y-m-d"))->where('fim_inscricao', '>=', date("Y-m-d"))->where('status', 0)->get()->pluck('nome', 'id');
        $competicoes = collect(['' => 'Selecione uma competição'] + $competicoes->all());
        $competicaoId = $request->competicao;
        $competicao = Competicoes::find($competicaoId);

        return view('inscricoes.create-form', compact('atletas', 'equipes', 'competicoes', 'competicao'));
    }

    public function buscaCategorias(Request $request)
    {
        $atleta = Atletas::find($request->atleta);
        $equipe = Equipes::find($request->equipe);

        $categorias_competicao = []; // Inicialização da variável

        if ($atleta) {
            $categorias_competicao = CompeticoesCategorias::categoriasHabilitadas($atleta)
                ->where('competicao', $request->competicao)
                ->whereHas('competicoes_categorias', function ($query) {
                    $query->where('equipe', '0');
                })->get();
        } elseif ($equipe) {
            $categorias_competicao = CompeticoesCategorias::where('competicao', $request->competicao)
                ->whereHas('competicoes_categorias', function ($query) {
                    $query->where('equipe', '1');
                })->get();
        }

        $categorias = [];
        foreach ($categorias_competicao as $categoria_competicao) {
            $categorias[] = Categorias::find($categoria_competicao->categoria);
        }

        return response()->json($categorias);
    }
}
