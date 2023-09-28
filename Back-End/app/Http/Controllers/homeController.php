<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class homeController extends Controller
{
    function getEstados()
    {
        $estados = DB::table('estado')
            ->select('estcodibge', 'estnome')
            ->orderBy('estnome')
            ->get();

        return response()->json($estados);
    }

    function getCidades($id)
    {
        $cidades = DB::table('cidade')
            ->select('cidcoduf', 'cidcodibge', 'cidnome')
            ->where('cidcoduf', '=', $id)
            ->orderBy('cidnome')
            ->get();

        return response()->json($cidades);
    }

    function getEspecialidade()
    {
        $Esp = DB::table('especialidade')
            ->select('espcodigo', 'espnome', 'espdescricao', 'espsituacao')
            ->orderBy('espnome')
            ->get();

        return response()->json($Esp);
    }

    function getServico($id)
    {
        $estados = DB::table('servico')
            ->select('servcodigo', 'servnome', 'servdescricao', 'servsituacao')
            ->where('servespcodigofk', '=', $id)
            ->orderBy('servnome')
            ->get();

        return response()->json($estados);
    }

    function submitFormProfissional()
    {

    }

    function verificarProfissional($cpf)
    {
        $exists = DB::table('pessoa')
            ->select(DB::raw('count(pescodigo) as count'))
            ->where('pesdoccpf', '=', $cpf)
            ->get();

        if (intval(data_get($exists, '0.count')) > 0) {

            return response('Este Profissional ja possui um cadastro');
        }

        return response('Não Existe');
    }
}
