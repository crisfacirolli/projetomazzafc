<?php

namespace App\Http\Controllers\Painel;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Datatables;
use Validator;

class AjaxPacientesController extends Controller
{
    function fetchdata(Request $request)
    {
        $id = $request->input('id');
        $medico = Paciente::find($id);
        $output = array(
            'nome'    =>  $medico->nome,
            'telefone'     =>  $medico->telefone,
            'data_nasc' => $medico->data_nasc,
            'descricao' => $medico->descricao
        );
        echo json_encode($output);
    }

    function postdata(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'nome' => 'required',
            'telefone'  => 'required',
            'descricao' => 'required'
        ]);
        
        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach ($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages; 
            }
        }
        else
        {
            if($request->get('button_action') == 'delete')
            {	
            	dd('teste');
                $paciente = Paciente::find($id);
                $delete = $paciente->delete();

                if($delete)
                    $success_output = '<div class="alert alert-success">Registro Apagado</div>';
            }

            if($request->get('button_action') == 'update')
            {
                $paciente = Paciente::find($request->get('paciente_id'));
                $paciente->nome = $request->get('nome');
                $paciente->telefone = $request->get('telefone');
                $paciente->data_nasc = $request->get('data_nasc');
                $paciente->descricao = $request->get('descricao');
                $paciente->save();
                $success_output = '<div class="alert alert-success">Registro Atualizado</div>';
            }
            
        }
        
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function deletaPaciente($id)
    {
       $paciente = Paciente::find($id);

       $delete = $paciente->delete();

       if($delete)
            return redirect()->back();
    }
}
