@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content_header')
    <h1>Pacientes</h1>
@stop

@section('style')
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
  <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
  
@endsection
<style type="text/css">
    #pacientes_wrapper{
      width: 90% !important;
      margin: 20px;
    }
  </style>
<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
@section('content')
	<div class="row">
	    <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <div class="container">
              <table id="pacientes" class="table table-hover table-condensed" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Data de Nascimento</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <script type="text/javascript">
                $(document).ready(function() {
                    oTable = $('#pacientes').DataTable({
                        "language": {"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"},
                        "processing": true,
                        "serverSide": true,
                        "ajax": "{{ route('datatable.getposts') }}",
                        "columns": [
                            {data: 'id', name: 'id'},
                            {data: 'nome', name: 'nome'},
                            {data: 'telefone', name: 'telefone'},
                            {data: 'data_nasc', name: 'data_nasc'},
                            {data: 'action', orderable:false, searchable: false } 
                        ], 
                    });

                    $(document).on('click', '.edit', function(){
                      var id = $(this).attr('id');
                      console.log(id);
                      $.ajax({
                          url: "{{route('ajaxpaciente.editarPaciente')}}",
                          method: 'get',
                          data: {id:id},
                          dataType: 'json',
                          success:function(data){
                            $('#nome').val(data.nome);
                            $('#telefone').val(data.telefone);
                            $('#data_nasc').val(data.data_nasc);
                            $('#descricao').val(data.descricao);
                            $('#paciente_id').val(id);
                            $('#pacienteModal').modal('show');
                            $('#action').val('Alterar');
                            $('.modal-title').text('Editar Registro');
                          }
                      })
                    })

                    
                    //edição dos registros
                    $('#form_paciente').on('submit', function(event){
                      event.preventDefault();
                      var form_data = $(this).serialize();
                      $.ajax({
                          url:"{{ route('ajaxpaciente.postdata') }}",
                          method:"POST",
                          data:form_data,
                          dataType:"json",
                          success:function(data)
                          {
                              if(data.error.length > 0)
                              {
                                  var error_html = '';
                                  for(var count = 0; count < data.error.length; count++)
                                  {
                                      error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                                  }
                                  $('#form_output').html(error_html);
                              }
                              else
                              {
                                  $('#form_output').html(data.success);
                                  $('#form_paciente')[0].reset();
                                  $('.modal-title').text('Editar');
                                  $('#pacienteModal').modal('hide');
                                  $('#form_output').html('');
                                  $('#pacientes').DataTable().ajax.reload();
                              }
                          }
                      })
                    });

                    var modalConfirm = function(callback){
  
                    $(document).on("click", '.apagar', function(){
                      $("#apagarCadastro").modal('show');
                    });

                    $("#modal-btn-si").on("click", function(){
                      callback(true);
                     
                      $("#apagarCadastro").modal('hide');
                    });
                    
                    $("#modal-btn-no").on("click", function(){
                      callback(false);
                      $("#apagarCadastro").modal('hide');
                    });
                  };

                  modalConfirm(function(confirm){
                    if(confirm){

                      var id = $('.apagar').attr('id');
                      $.ajax({
                          url: "{{route('ajaxpaciente.deletaPaciente')}}",
                          method: 'get',
                          data: {id:id},
                          dataType: 'json',
                          success:function(data){
                            $('#paciente_id').val(id);
                            $('#action').val('delete');
                          }
                      })
                      $("#result").html("CONFIRMADO");
                    }else{

                      $("#result").html("");
                    }
                  });

                });
              </script>
              </table>
            </div>
              
         </div>
        
      </div>
      <!-- /.info-box-content -->
    </div>
<div id="pacienteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="form_paciente">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Editar</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" />
                    </div>
                     <div class="form-group">
                        <label>Data de Nascimento</label>
                        <input type="text" name="data_nasc" id="data_nasc" class="form-control" />
                    </div>
                     <div class="form-group">
                        <label>Descrição do Atendimento</label>
                        <textarea rows="3"  name="descricao" id="descricao" class="form-control" ></textarea> 
                    </div>
                </div>
                <div class="modal-footer">
                     <input type="hidden" name="paciente_id" id="paciente_id" value="" />
                    <input type="hidden" name="button_action" id="button_action" value="update" />
                    <input type="submit" name="submit" id="action" value="Editar" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="apagarCadastro">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="alert text-center" id="myModalLabel">Deseja realmente apagar?</h4>
      </div>
      <div class="modal-footer">
        <form method="POST" id="form_paciente">
          <input type="hidden" name="button_action" id="button_action" value="delete" />
          <button type="button" class="btn btn-default" id="modal-btn-si">Sim</button>
          <button type="button" class="btn btn-primary" id="modal-btn-no">Não</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="alert" role="alert" id="result"></div>
@stop


  
   
