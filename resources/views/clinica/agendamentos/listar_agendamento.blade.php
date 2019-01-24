@extends('adminlte::page')

@section('title', 'Agendamentos')

@section('content_header')
    <h1>Agendamentos</h1>
@stop

@section('content')

    <div class="row">
      <div class="col-md-12">
        <div class="info-box">
          <h3 class="text-center" style="padding-top: 20px;">Agendamentos para o dia</h3>
          <div class="row">
            <form method="get" action="{{ route('consulta-agenda')}}">
              {!! csrf_field() !!}
              <div class="col-md-2 col-md-offset-8">
                <input type="date" name="data_agendamento" class="form-control">
              </div>
               <div class="col-md-2">
                <button class="btn btn-primary">Verificar</button>
              </div>
            </form>
          </div>
          <div class="row">
            <div class="col-md-12">
              @foreach($agendamentos as $medico)
                  <div class="row margin-20">
                    <div class="col-md-8">
                      <div class="alert alert-success"> 
                         {{ $medico->nome }} - {{ $medico->especialidade}}
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="alert alert-success"> 
                        {{ date('d-m-Y - H:i', strtotime($medico->data_hora)) }}
                      </div>
                    </div>
                  </div>
                
              @endforeach
              
            </div>
          </div>
        </div>     
      </div>
    </div>
@stop
