<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfissionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profissionais = DB::table('pessoa')
            ->select('pescodigo', 'pesnome', 'servdescricao', 'pessituacao')
            ->where('pessituacao', '!=', 3)
            ->orderBy('servnome')
            ->get();

        return response()->json($profissionais);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cpf = $request->input('pesdoccpf');

        $verificacao = $this->verificarProfissional($cpf);

        if ($verificacao->getStatusCode() == 200) {

            $pessoa = Pessoa::create($request);

            Profissional::create($request->all());

            return response()->json('Profissional Criado');
        } else {

            return $verificacao;
        }
    }

    protected function verificarProfissional($cpf)
    {
        $exists = DB::table('pessoa')
            ->select(DB::raw('count(pescodigo) as count'))
            ->where('pesdoccpf', '=', $cpf)
            ->get();

        if (intval(data_get($exists, '0.count')) > 0) {

            return response(400);
        }

        return response(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        $profissionais = Pessoa::with('profissao.especialidade.servico')->find($id);

        return response()->json($profissionais);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        try {
            $id = request()->input('id');
            $situacao = request()->input('situacao');

            DB::table('pessoa')
                ->where('pescodigo', $id)
                ->update(['pessituacao' =>  $situacao]);

            $response = response()->json(`Profissional Atualizado com a situacao: $situacao`, 200);
            return $response;

        } catch (\Exception $e) {

            $response = response()->json([
                'mensagem' => 'Erro ao atualizar o profissional',
                'erro' => $e->getMessage(),
            ], 500);

            return $response;
        }
    }
}
