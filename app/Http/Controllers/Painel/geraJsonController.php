<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Medico;
use DB;


class geraJsonController extends Controller
{
    function geraJson()
    {
    	$dados = DB::table('medicos')->get();
		return response()->json($dados);
    }
}
