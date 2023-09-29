<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Profissional;
use App\Models\ServicoXProfissional;
use Illuminate\Support\Facades\DB;

class PessoaProfissionalController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $pessoa = new Pessoa;

            $pessoa->pesnome = $request->pesnome;
            $pessoa->pessexo = $request->pessexo;
            $pessoa->pesdatanascimento = $request->pesdatanascimento;
            $pessoa->pesdocrg = $request->pesdocrg;
            $pessoa->pesdoccpf = $request->pesdoccpf;
            $pessoa->pescontatotel1 = $request->pescontatotel1;
            $pessoa->pescontatotel2 = $request->pescontatotel2;
            $pessoa->pescontatoemail1 = $request->pescontatoemail1;
            $pessoa->pescontatoemail2 = $request->pescontatoemail2;
            $pessoa->pesendrua = $request->pesendrua;
            $pessoa->pesendnumero = $request->pesendnumero;
            $pessoa->pesendbairro = $request->pesendbairro;
            $pessoa->pesendcidcod = $request->pesendcidcod;
            $pessoa->pesendestcod = $request->pesendestcod;
            $pessoa->pessituacao = $request->pessituacao;
            $pessoa->pesprodescricao = $request->pesprodescricao;
            $pessoa->pesprodescricaoservicos = $request->pesprodescricaoservicos;
            $pessoa->save();

            $profissional = new Profissional;
            $profissional->propescodigofk = $pessoa->pescodigo;
            $profissional->proespcodigofk = $request->proespcodigofk;
            $profissional->prosituacao = $request->prosituacao;
            $profissional->save();

            $servicoXprofissional = new ServicoXProfissional;
            $servicoXprofissional->idprofissional = $profissional->procodigo;
            $servicoXprofissional->idservico = $request->idservico;
            $servicoXprofissional->save();

            DB::commit();

            return response()->json(['message' => 'Dados inseridos com sucesso!'], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Erro ao inserir dados', 'error' => $e->getMessage()], 500);
        }
    }
}
