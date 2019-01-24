@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content_header')
    <h1>Pacientes</h1>
@stop

@section('content')
	<div class="row">
	    <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
          	<a href="{{route('lista')}}" alt="Listar Pacientes" title="Listar Pacientes">
	            <span class="info-box-icon bg-aqua">
	            	<i class="ion ion-android-person"></i>
	            </span>
	        </a>

            <div class="info-box-content">
              <span class="info-box-text">Pacientes Cadastrados</span>
              <span class="info-box-number">{{$totalPac}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
	    <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
          	<a href="{{route('cadastro-paciente')}}" alt="Cadastrar Pacientes" title="Cadastrar Pacientes">
	            <span class="info-box-icon bg-green">
	            	<i class="ion ion-android-add"></i>
	            </span>
	        </a>
            <div class="info-box-content">
              <span class="info-box-text">Cadastrar Paciente</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    </div>
@stop

