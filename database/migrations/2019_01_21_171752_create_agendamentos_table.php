<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pacientes_id')->unsigned();
            $table->foreign('pacientes_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->integer('medicos_id')->unsigned();
            $table->foreign('medicos_id')->references('id')->on('medicos')->onDelete('cascade');
            $table->string('data_hora');
            $table->text('especialidade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
