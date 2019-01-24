<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Medico;
use App\Models\Paciente;

class Agendamento extends Model
{
    protected $fillable = ['pacientes_id', 'medicos_id', 'data_hora', 'especialidade'];
    protected $table = 'agendamentos';

   

}
