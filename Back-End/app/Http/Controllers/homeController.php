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

        return response()->json($estados, 200);
    }

    function homeCidades($coduf)
    {

        $cidades = DB::table('cidade')
            ->select('cidcoduf', 'cidcodibge', 'cidnome')
            ->where('cidcoduf', '=', $coduf)
            ->orderBy('cidnome')
            ->get();

        return  response()->json($cidades);
    }
}
