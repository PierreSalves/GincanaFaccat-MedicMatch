<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profissional;
use App\Models\Pessoa;

class guiaController extends Controller
{
    public function search(Request $request)
    {

        $filtro = $request->json()->all();

        try {

            $pessoas = Pessoa::whereHas('profissao', function ($query) use ($filtro) {
                $query->whereIn('propescodigo', $filtro['profissao']);
            })
                ->whereHas('profissao.especialidades', function ($query) use ($filtro) {
                    $query->whereIn('especialidade_id', $filtro['especialidades']);
                })
                ->whereHas('profissao.especialidades.servicos', function ($query) use ($filtro) {
                    $query->whereIn('servico_id', $filtro['servicos']);
                })
                ->where(function ($query) use ($filtro) {
                    if (isset($filtro['endereco'])) {
                        $query->whereHas('endereco', function ($subquery) use ($filtro) {
                            $subquery->where('endereco', 'LIKE', '%' . $filtro['endereco'] . '%');
                        });
                    }
                })
                ->get();

            return response()->json($pessoas);
        } catch (\Exception $e) {

            $response = response()->json([
                'mensagem' => 'Erro ao Consultar o profissional',
                'erro' => $e->getMessage(),
            ], 500);

            return $response;
        }
    }
}
