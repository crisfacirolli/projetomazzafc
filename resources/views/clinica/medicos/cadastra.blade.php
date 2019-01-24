@extends('adminlte::page')

@section('title', 'Médicos')

@section('content_header')
    <h1>Médicos</h1>
@stop

@section('content')
	<div class="row">
	    <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <div class="container">
              <form action="{{route('adiciona-medico')}}" method="POST">
                {!! csrf_field() !!}
                <div class="row">
                  <div class="form-group col-md-8">
                    <label for="nome">Nome Médico</label>
                    <input type="text" name="nome" class="form-control" placeholder="Nome Paciente" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" class="form-control" placeholder="(16) 9999 9999" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="especialidade">Especialidade</label>
                    <input type="text" name="especialidade" class="form-control" placeholder="Clínico Geral" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4   ">
                    <label for="descricao">Dias de Atendimento</label>
                    <select class="form-control" name="dias_atendimento" required>
                      <option value="seg,ter,qua,qui,sex">Seg, Ter, Qua, Qui, Sex</option>
                      <option value="seg,ter,qua,qui">Seg, Ter, Qua, Qui</option>
                      <option value="seg,ter,qua">Seg, Ter, Qua</option>
                      <option value="seg,ter">Seg, Ter</option>
                      <option value="seg">Seg</option>
                      <option value="seg,qua,qui,sex">Seg, Qua, Qui, Sex</option>
                      <option value="seg,qui,sex">Seg, Qui, Sex</option>
                      <option value="seg,sex">Seg, Sex</option>
                      <option value="qua,qui,sex">Qua, Qui, Sex</option>
                      <option value="qui,sex">Qui, Sex</option>
                      <option value="sex">Sex</option>
                      <option value="qui">Qui</option>
                    </select>
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
