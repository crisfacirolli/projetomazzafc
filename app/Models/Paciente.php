<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{


    protected $fillable = ['nome', 'telefone', 'data_nasc', 'descricao'];
    protected $table = 'pacientes';


    public $rules = [
    	'nome' 		=> 'required|min:3|max:100',
    	'telefone' 	=> 'required|numeric',
    	'descricao' => 'min:3|max:1000',
    ];
}
