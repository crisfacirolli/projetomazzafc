<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Medico;
use DB;
use DataTables;

class clinicaController extends Controller
{	
    public function index()
    {

    	$totalPacientes = DB::table('pacientes')
    						->get();
    	$totalPac = $totalPacientes->count();

    	return view('clinica.pacientes.index', compact('totalPac'));
    }

    public function medicos()
    {

    	$totalMedicos = DB::table('medicos')
    						->get();
    	$totalMed = $totalMedicos->count();

    	return view('clinica.medicos.index', compact('totalMed'));
    }

    public function formCadatraPaciente()
    {
    	return view('clinica.pacientes.cadastra');
    }

    public function cadastraPaciente(request $request)
    {


    	$dadosPaciente = new Paciente;

    	$dadosPaciente->nome = $request->nome;
    	$dadosPaciente->telefone = $request->telefone;
    	$dadosPaciente->data_nasc = $request->data_nasc;
    	$dadosPaciente->descricao = $request->descricao;
    	$dadosPaciente->save();

        
        
    	return redirect()->route('pacientes');;
    }

    public function datatable()
    {
        return view('clinica.pacientes.lista_pacientes');
    }

    public function getPosts()
    {
    	$paciente = DB::table('pacientes')->select('*');
    
        return Datatables::of($paciente)
        ->addColumn('action', function($paciente){
                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$paciente->id.'"><i class="glyphicon glyphicon-edit"></i> Editar </a>'." ".
        			'<a href="#" class="btn btn-xs btn-danger apagar" id="'.$paciente->id.'"><i class="fa fa-eraser"></i> Excluir </a>';
            })
         ->editColumn('id', '{{$id}}')
        ->make(true);
    }


    public function formCadastraMedico()
    {
    	return view('clinica.medicos.cadastra');
    }

    public function cadastraMedico(request $request)
    {
    	$dadosPaciente = new Medico;

    	$dadosPaciente->nome = $request->nome;
    	$dadosPaciente->telefone = $request->telefone;
    	$dadosPaciente->especialidade = $request->especialidade;
    	$dadosPaciente->dias_atendimento = $request->dias_atendimento;
    	$dadosPaciente->save();

    	return redirect()->route('medicos');;
    }

    public function listaMedicos()
    {
        return view('clinica.medicos.lista_medicos');
    }

    public function getMedicos()
    {
    	$medico = DB::table('medicos')->select('*');
    
        return Datatables::of($medico)
        ->addColumn('action', function($medico){
                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$medico->id.'"><i class="glyphicon glyphicon-edit"></i> Editar </a>'." ".
        			'<a href="#/id='.$medico->id.'" class="btn btn-xs btn-danger apagar" id="'.$medico->id.'"><i class="fa fa-eraser"></i> Excluir </a>';
            })
         ->editColumn('id', '{{$id}}')
        ->make(true);
    }

    
}
