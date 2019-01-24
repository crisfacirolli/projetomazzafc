@extends('adminlte::page')

@section('title', 'Agendamento')

@section('content_header')
    <h1>Cadastrar Agendamento</h1>
@stop
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
@section('content')
	<div class="row">
	    <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <div class="container">
             <form action="{{route('cadastra-agenda')}}" method="POST">
                {!! csrf_field() !!}
                <div class="col-md-4 form-group">
                    <label for="paciente">Paciente</label>
                    <input type="text" name="paciente" class="form-control paciente" placeholder="Nome do Paciente" required>
                    <div id="tabela"></div>
                    <input type="hidden" name="tabela" class="tabela">
                </div>
                <div class="col-md-2 form-group">
                    <label for="medico">Médico</label>
                    <input type="text" name="medico" class="form-control medico" placeholder="Nome do Médico" required>
                    <div id="tabela-medico"></div>
                    <input type="hidden" name="tabela_medico" class="tabela_medico">
                </div>
                <div class="col-md-2 form-group">
                    <label for="sintoma">Sintoma</label>
                    <input type="text" name="sintoma" class="form-control sintoma" placeholder="Nome do Médico" required>
                    
                </div>
                <div cl
                <div class="col-md-2">
                    <label for="data">Data</label>
                    <input type="date" id="data" class="form-control" name="data_hora" required>
                </div>
                <div class="col-md-10 form-group">
                    <button class="btn btn-primary" type="submit">Cadastrar</button>
                </div>

                <script type="text/javascript">

                    // $('.data_hora').datepicker({  
                    //     language: 'pt-BR',
                    //     format: 'dd-mm-yyyy'

                    //  });  

                </script> 
             </form>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    </div>
@stop
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script>

    $(document).ready(function(){
        
        $(".paciente").keyup(function () {
            $('#tabela').empty();
            var nome = $(".paciente").val();
            console.log(nome);
            $.ajax({
            type:'post',        
            dataType: 'json',
            data: {nome : nome},
            url: '../ajax/busca-paciente.php',
            success: function(dados){
                for(var i=0;dados.length>i;i++){
                    $('#tabela').html('<div class="well well-sm" id='+dados[i].id+'>'+dados[i].nome+'</div>');
                    $('.tabela').val(dados[i].id);
                    }
                }
            });
        });

        $(".medico").keyup(function () {
            $('#tabela-medico').empty();
            var nome = $(".medico").val();
            console.log(nome);
            $.ajax({
            type:'post',        
            dataType: 'json',
            data: {nome : nome},
            url: '../ajax/busca-medico.php',
            success: function(dados){
                for(var i=0;dados.length>i;i++){
                    //Adicionando registros retornados na tabela
                    $('#tabela-medico').html('<div class="well well-sm">'+dados[i].nome+'</div>');
                    $('.tabela_medico').val(dados[i].id);
                    }
                }
            });
        });

        
        
    })
</script>

