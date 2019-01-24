@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content_header')
    <h1>Pacientes</h1>
@stop

@section('content')
	<div class="row">
	    <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <div class="container">
              <form action="{{route('adiciona-paciente')}}" method="POST">
                {!! csrf_field() !!}
                <div class="row">
                  <div class="form-group col-md-8">
                    <label for="nome">Nome Paciente</label>
                    <input type="text" name="nome" class="form-control" placeholder="Nome Paciente" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" class="form-control" placeholder="(16) 9999 9999" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="data_nasc">Data de Nascimento</label>
                    <input type="text" name="data_nasc" class="form-control" placeholder="11/04/1987" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-8   ">
                    <label for="descricao">Descrição do atendimento</label>
                    <textarea rows="5" name="descricao" class="form-control" required></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-8   ">
                    <button class="btn btn-success">Cadastrar</button>
                  </div>
                </div>
              </form>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    </div>
@stop