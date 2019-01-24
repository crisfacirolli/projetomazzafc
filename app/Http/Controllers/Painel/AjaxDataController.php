<?php

namespace App\Http\Controllers\Painel;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Medico;
use Datatables;
use Validator;

class AjaxDataController extends Controller
{
    function fetchdata(Request $request)
    {
        $id = $request->input('id');
        $medico = Medico::find($id);
        $output = array(
            'nome'    =>  $medico->nome,
            'telefone'     =>  $medico->telefone,
            'especialidade' => $medico->especialidade,
            'dias_atendimento' => $medico->dias_atendimento
        );
        echo json_encode($output);
    }

    function postdata(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'nome' => 'required',
            'telefone'  => 'required',
            'especialidade' => 'required'
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
                $medico = Medico::find($id);
                $delete = $medico->delete();

                if($delete)
                    $success_output = '<div class="alert alert-success">Registro Apagado</div>';
            }

            if($request->get('button_action') == 'update')
            {
                $medico = Medico::find($request->get('medico_id'));
                $medico->nome = $request->get('nome');
                $medico->telefone = $request->get('telefone');
                $medico->especialidade = $request->get('especialidade');
                $medico->dias_atendimento = $request->get('dias_atendimento');
                $medico->save();
                $success_output = '<div class="alert alert-success">Registro Atualizado</div>';
            }
            
        }
        
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function deletaMedico($id)
    {
       $medico = Medico::find($id);

       $delete = $medico->delete();

       if($delete)
            return redirect()->back();
    }
}
