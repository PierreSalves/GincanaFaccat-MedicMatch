<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profissional;
use App\Models\Pessoa;

class guiaController extends Controller
{
    public function searchAll(Request $request)
    {

        $filtro = $request->all();

        try {

            $pessoas = Pessoa::with('profissao.especialidade.servico')->get();

            return response()->json($pessoas);
        } catch (\Exception $e) {

            $response = response()->json([
                'mensagem' => 'Erro ao Consultar o profissional',
                'erro' => $e->getMessage(),
            ], 500);

            return $response;
        }
    }

    public function search(Request $request)
    {

        $filtro = $request->all();

        try {

            $pessoas = Pessoa::with('profissao.especialidade.servico')->get();

            if (isset($filtro['especialidade']) && $filtro['especialidade']) {
                $especialidades = explode(',', $filtro['especialidade']);
                $pessoas = $pessoas->whereHas('profissao.especialidade', function ($query) use ($especialidades) {
                    $query->whereIn('espcodigo', $especialidades);
                });
            }

            if (isset($filtro['servico']) && $filtro['servico']) {
                $servicos = explode(',', $filtro['servico']);
                $pessoas = $pessoas->whereHas('profissao.especialidade.servico', function ($query) use ($servicos) {
                    $query->whereIn('servcodigo', $servicos);
                });
            }

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
