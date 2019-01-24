<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Agendamento;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
 
class agendamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $totalAgendamentos = DB::table('agendamentos')
                            ->get();
        $totalAge = $totalAgendamentos->count();

        $dataHoje = date("Y-m-d");

        $agendamentos = DB::table('agendamentos')
                        ->join('medicos','agendamentos.medicos_id','medicos.id', 'medicos.nome')
                        ->join('pacientes','agendamentos.pacientes_id','pacientes.id')
                        ->where('data_hora', 'LIKE', $dataHoje.'%')
                        ->selectRaw('*')
                        ->orderBy('data_hora', 'asc')
                        ->get();

        return view('clinica.agendamentos.index', compact('agendamentos', 'totalAge'));
    }


    public function create()
    {
        return view('clinica.agendamentos.cadastrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Agendamento::create($request->all());
        return redirect()->route('clinica.agendamentos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cadastrar()
    {
        return view('clinica.agendamentos.cadastrar');
    }

    public function cadastraAgenda(request $request)
    {   

        $dados = $request->all();
        $info = new Agendamento;
        $info->pacientes_id = $request->tabela;
        $info->medicos_id = $request->tabela_medico;
        $info->data_hora = $request->data_hora;
        $info->especialidade = $request->sintoma;

        $info->save();

        return redirect()->back();
    }

    public function consultarAgenda(request $request)
    {

        
        $totalAgendamentos = DB::table('agendamentos')
                            ->get();
        $totalAge = $totalAgendamentos->count();

        $dataHoje = $request->data;

        $agendamentos = DB::table('agendamentos')
                        ->join('medicos','agendamentos.medicos_id','medicos.id', 'medicos.nome')
                        ->join('pacientes','agendamentos.pacientes_id','pacientes.id')
                        ->where('data_hora', 'LIKE', $dataHoje.'%')
                        ->selectRaw('*')
                        ->orderBy('data_hora', 'asc')
                        ->get();
                        
        

        return view('clinica.agendamentos.listar_agendamento', compact('agendamentos', 'totalAge'));
    }




}
