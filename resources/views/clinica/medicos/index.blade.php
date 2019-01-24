@extends('adminlte::page')

@section('title', 'Médicos')

@section('content_header')
    <h1>Médicos</h1>
@stop

@section('content')
	<div class="row">
	    <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
          	<a href="{{ route('lista-medicos') }}" alt="Listar Médicos" title="Listar Médicos">
	            <span class="info-box-icon bg-aqua">
	            	<i class="ion ion-ios-medkit"></i>
	            </span>
	        </a>

            <div class="info-box-content">
              <span class="info-box-text">Médicos Cadastrados</span>
              <span class="info-box-number">{{$totalMed}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
	    <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
          	<a href="{{route('cadastro-medico')}}" alt="Adicionar Médicos" title="Adicionar Médicos" >
	            <span class="info-box-icon bg-green">
	            	<i class="ion ion-android-add"></i>
	            </span>
	        </a>
            <div class="info-box-content">
              <span class="info-box-text">Cadastrar Médico</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    </div>
@stop