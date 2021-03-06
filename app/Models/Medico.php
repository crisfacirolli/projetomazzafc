<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = ['nome', 'telefone', 'especialidade', 'dias_atendimento'];
    protected $table = 'medicos';
}
