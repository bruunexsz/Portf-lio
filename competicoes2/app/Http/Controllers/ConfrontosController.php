<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Confrontos;
use App\Models\Categorias;
use App\Models\Competicoes;
use App\Models\Inscricoes;
use App\Models\Atletas;
use App\Models\Equipes;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon; // Importe a classe Carbon para trabalhar com datas

class ConfrontosController extends BaseController
{
    
    public function showConfrontos(Request $request)
    {
        $competicao = Competicoes::latest()->first();
     
        $keyword = $request->get('search');
        $perPage = 25;
        if (!empty($keyword)) {
            $categorias = Categorias::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('idade_minima', 'LIKE', "%$keyword%")
                ->orWhere('idade_maxima', 'LIKE', "%$keyword%")
                ->orWhere('tipo', 'LIKE', "%$keyword%")
                ->orWhere('sistema', 'LIKE', "%$keyword%")
                ->orWhere('altura_minima', 'LIKE', "%$keyword%")
                ->orWhere('altura_maxima', 'LIKE', "%$keyword%")
                ->latest()->get();
        } else {
            $categorias = Categorias::latest()->get();
        }
        return view('confrontos.index', compact('categorias', 'competicao'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $fases =
            collect([
                1 => 2,
                2 => 2,
                3 => 4,
                4 => 4,
                5 => 8,
                6 => 8,
                7 => 8,
                8 => 8,
                9 => 16,
                10 => 16,
                11 => 16,
                12 => 16,
                13 => 16,
                14 => 16,
                15 => 16,
                16 => 16
            ]);
        $competicao = Competicoes::where('id', $request->competicao)->with('categorias')->first();
		Confrontos::where('competicao', $competicao->id)->forceDelete();
		
        foreach ($competicao->categorias as $categoria) {
            $inscricoes = Inscricoes::where('competicao', $competicao->id)
                ->where('categoria', $categoria->categoria)
                ->inRandomOrder()
                ->get();
            $qtd_inscritos = $inscricoes->count();
            if ($qtd_inscritos <= 0) {
                continue;
            }
            $chaves_atletas = (isset($fases[$qtd_inscritos]) ? $fases[$qtd_inscritos] : 32);
            $chaves = $chaves_atletas / 2;
            foreach ($inscricoes as $index => $inscrito) {
                $i = $index + 1;
                if ($i <= $chaves) {
                    $confronto = new Confrontos();
                    $confronto->competicao = $competicao->id;
                    $confronto->categoria = $categoria->categoria;
                    $confronto->atleta1 = $inscrito->atleta;
                    $confronto->atleta2 = 0;
                    $confronto->vencedor = 0;
                    $confronto->confronto_filho_vencedor = 0;
                    $confronto->confronto_filho_perdedor = 0;
                    $confronto->fase = (isset($fases[$qtd_inscritos]) ? $fases[$qtd_inscritos] : 32);
                    $confronto->save();				} else {
                    $confronto = Confrontos::where('atleta2', 0)->where('competicao', $competicao->id)
                        ->where('categoria', $categoria->categoria)->inRandomOrder()->first();
                    $confronto->atleta2 = $inscrito->atleta;
                    $confronto->save();
                }
            }
            $confrontos_chapeu = Confrontos::where('atleta2', 0)->where('competicao', $competicao->id)
                ->where('categoria', $categoria->categoria)->get();
            foreach ($confrontos_chapeu as $chapeu) {
                $chapeu->vencedor = $chapeu->atleta1;
                $chapeu->save();
            }

            $conta_chave = $chaves;
            while($conta_chave > 1) {
                $confronto = new Confrontos();
                $confronto->competicao = $competicao->id;
                $confronto->categoria = $categoria->categoria;
                $confronto->atleta1 = 0;
                $confronto->atleta2 = 0;
                $confronto->vencedor = 0;
                $confronto->confronto_filho_vencedor = 0;
                $confronto->confronto_filho_perdedor = 0;
                $confronto->fase = (isset($fases[$conta_chave]) ? $fases[$conta_chave] : 32);
                $confronto->save();
                $conta_chave--;
            }

            $vencedores = Confrontos::where('competicao', $competicao->id)
                ->where('categoria', $categoria->categoria)
                ->orderBy('fase', 'DESC')
                ->get();
            $fase = (isset($fases[$qtd_inscritos]) ? $fases[$qtd_inscritos] : 32);
            $pre_preenchidos = [];
            $preenchidos = [];
            foreach ($vencedores as $vencedor) {
                if ($fase > 2) {
                    $proxima_fase = Confrontos::where('competicao', $competicao->id)->where('fase', (isset($fases[$fase]) ? $fases[$fase] : 32) / 2)
                        ->whereNotIn('id', $preenchidos)->where('categoria', $categoria->categoria)->inRandomOrder()->first();
                    if (in_array($proxima_fase->id, $pre_preenchidos)) {
                        $preenchidos[] = $proxima_fase->id;
                    } else {
                        $pre_preenchidos[] = $proxima_fase->id;
                    }
                    $vencedor->confronto_filho_vencedor = $proxima_fase->id;
                    $vencedor->save();
                }
                $fase--;
            }
        }
		
		echo "<script>alert('Chaveamento gerado com sucesso.');</script>";
		return redirect('confrontos?competicao=' . $competicao->id)->with('flash_message', 'Confronto added!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Confrontos::create($requestData);

        return redirect('confrontos')->with('flash_message', 'Confronto added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        
        
        
        $categoria = Categorias::find($id);
        $dir = rand(1,2);
        if ($dir == 1) $dir = 'asc';
        if ($dir == 2) $dir = 'desc';
        if ($categoria->equipe == 0) {
            $atletas = Atletas::whereHas('atleta_inscricoes', function ($query) use($id, $request) {
                $query->where('competicao', $request->competicao)->where('categoria', $id);
            })
            ->orderBy('instituicao', $dir)
            ->inRandomOrder()
            ->get();
        } else {
            $atletas = Equipes::whereHas('equipe_inscricoes', function ($query) use($id, $request) {
                $query->where('competicao', $request->competicao)->where('categoria', $id);
            })
            ->orderBy('instituicao', 'asc')
            ->inRandomOrder()
            ->get();
        }
        
        $qtd_inscritos = $atletas->count();
        if ($qtd_inscritos <= 2) {
            $qtd_fase = 2;
        } elseif ($qtd_inscritos > 2 && $qtd_inscritos <= 4) {
            $qtd_fase = 4;
        } elseif ($qtd_inscritos > 4 && $qtd_inscritos <= 8) {
            $qtd_fase = 8;
        } elseif ($qtd_inscritos > 8 && $qtd_inscritos <= 16) {
            $qtd_fase = 16;
        } else {
            $qtd_fase = 32;
        }
        $html = view('confrontos.chave' . $qtd_fase)->with('atletas', $atletas)->render();
        for ($i = 1; $i <= $qtd_inscritos; $i++) {
            if ($categoria->equipe == 0) {
                $nome = '<b>' . substr($atletas[$i - 1]->id . ' ' . strtoupper($atletas[$i - 1]->nome), 0, 30) . '</b><br />' . ucfirst($atletas[$i - 1]->atleta_instituicao->responsavel);
            } else {
                $nome = '<b>' . substr($atletas[$i - 1]->id . ' ' . strtoupper($atletas[$i - 1]->nome), 0, 30) . '</b><br />' . ucfirst($atletas[$i - 1]->equipe_instituicao->responsavel);
            }
            $html = str_replace('##_ATLETA'.$i.'_##', $nome, $html);
        }
        
        for ($i = $qtd_inscritos; $i <= $qtd_fase; $i++) {
            $html = str_replace('##_ATLETA'.$i.'_##', '&nbsp;', $html);
        }

        $competicao = Competicoes::find($request->competicao);
        $html = str_replace('##_COMPETICAO_NOME_##', $competicao->nome, $html);
        $html = str_replace('##_COMPETICAO_INFO_##', $competicao->cidade . ' - ' . date('d/m/Y', strtotime($competicao->data)), $html);

        $html = str_replace('##_CATEGORIA_NOME_##', $categoria->nome . ' - Faixa ' . $categoria->categorias_faixas()->first()->faixas->nome . ' até faixa ' . $categoria->categorias_faixas()->orderBy('id', 'desc')->first()->faixas->nome . ' - ' . $categoria->tipo_descricao, $html);
        echo $html;
    }
    
    public function pesagem($id, $competicao, Request $request) {
       

        $categoria = Categorias::find($id);
        $dir = rand(1,2);
        if ($dir == 1) $dir = 'asc';
        if ($dir == 2) $dir = 'desc';
        if ($categoria->equipe == 0) {
            $atletas = Atletas::whereHas('atleta_inscricoes', function ($query) use($id, $request) {
                $query->where('competicao', $request->competicao)->where('categoria', $id);
            })
            ->orderBy('instituicao', $dir)
            ->inRandomOrder()
            ->get();
        } else {
            $atletas = Equipes::whereHas('equipe_inscricoes', function ($query) use($id, $request) {
                $query->where('competicao', $request->competicao)->where('categoria', $id);
            })
            ->orderBy('instituicao', 'asc')
            ->inRandomOrder()
            ->get();
        }
        
        $qtd_inscritos = $atletas->count();
        if ($qtd_inscritos <= 2) {
            $qtd_fase = 2;
        } elseif ($qtd_inscritos > 2 && $qtd_inscritos <= 4) {
            $qtd_fase = 4;
        } elseif ($qtd_inscritos > 4 && $qtd_inscritos <= 8) {
            $qtd_fase = 8;
        } elseif ($qtd_inscritos > 8 && $qtd_inscritos <= 16) {
            $qtd_fase = 16;
        } else {
            $qtd_fase = 32;
        }
        $html = view('confrontos.pesagem')
        ->with('atletas', $atletas)
        ->render();
    
        $competicao = Competicoes::find($request->competicao);
        $html = str_replace('##_COMPETICAO_NOME_##', $competicao->nome, $html);
        $html = str_replace('##_COMPETICAO_INFO_##', $competicao->cidade . ' - ' . date('d/m/Y', strtotime($competicao->data)), $html);
        $html = str_replace('##_PESO_##', $categoria->peso_minimo . ' kg até ' . $categoria->peso_maximo . ' kg', $html);
        $html = str_replace('##_CATEGORIA_NOME_##', $categoria->nome . ' - Faixa ' . $categoria->categorias_faixas()->first()->faixas->nome . ' até faixa ' . $categoria->categorias_faixas()->orderBy('id', 'desc')->first()->faixas->nome . ' - ' . $categoria->tipo_descricao, $html);
        echo $html;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $confronto = Confrontos::findOrFail($id);

        return view('confrontos.edit', compact('confronto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $confronto = Confrontos::findOrFail($id);
        $confronto->update($requestData);

        return redirect('confrontos')->with('flash_message', 'Confronto updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Confrontos::destroy($id);

        return redirect('confrontos')->with('flash_message', 'Confronto deleted!');
    }
}
