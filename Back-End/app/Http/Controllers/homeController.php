<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class homeController extends Controller
{
    function homeEstados()
    {
        $estados = DB::table('estado')
            ->select('estcodibge', 'estnome')
            ->orderBy('estnome')
            ->get();

        return response()->json($estados);
    }

    function homeCidades($coduf)
    {
        $cidades = DB::table('cidade')
            ->select('cidcoduf', 'cidcodibge', 'cidnome')
            ->where('cidcoduf', '=', $coduf)
            ->orderBy('cidnome')
            ->get();

        return response()->json($cidades);
    }

    function homeProfissional($cpf)
    {
        $exists = DB::table('pessoa')
            ->select(DB::raw('count(pescodigo)'))
            ->where('pesdoccpf', '=', $cpf)
            ->get();

        if ($exists > 0) {
            return response('Este Profissional ja possui um cadastro');
        }
    }
}
