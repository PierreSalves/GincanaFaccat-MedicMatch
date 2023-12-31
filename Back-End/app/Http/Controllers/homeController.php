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
        $id = explode(',', $id);

        $servico = DB::table('servico')
            ->select('servcodigo', 'servnome', 'servdescricao', 'servsituacao')
            ->whereIn('servespcodigofk', $id)
            ->orderBy('servnome')
            ->get();

        return response()->json($servico);
    }

    function getAllServico()
    {

        $servico = DB::table('servico')
            ->select('servcodigo', 'servnome', 'servdescricao', 'servsituacao')
            ->orderBy('servnome')
            ->get();

        return response()->json($servico);
    }
}
