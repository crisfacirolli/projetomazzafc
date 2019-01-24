@extends('adminlte::page')

@section('title', 'Médicos')

@section('content_header')
    <h1>Médicos</h1>
@stop

@section('style')
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
  <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
  
@endsection
<style type="text/css">
    #medicos_wrapper{
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
              <table id="medicos" class="table table-hover table-condensed" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Especialidade</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <script type="text/javascript">
                $(document).ready(function() {
                    oTable = $('#medicos').DataTable({
                        "language": {"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"},
                        "processing": true,
                        "serverSide": true,
                        "ajax": "{{ route('listaMedicos.getMedicos') }}",
                        "columns": [
                            {data: 'id', name: 'id'},
                            {data: 'nome', name: 'nome'},
                            {data: 'telefone', name: 'telefone'},
                            {data: 'especialidade', name: 'especialidade'},
                            {data: 'action', orderable:false, searchable: false } 
                        ],  
                    });
                    $(document).on('click', '.edit', function(){
                      var id = $(this).attr('id');
                      $.ajax({
                          url: "{{route('ajaxdata.fetchdata')}}",
                          method: 'get',
                          data: {id:id},
                          dataType: 'json',
                          success:function(data){
                            $('#nome').val(data.nome);
                            $('#telefone').val(data.telefone);
                            $('#telefone').val(data.telefone);
                            $('#especialidade').val(data.especialidade);
                            $('#dias_atendimento').val(data.dias_atendimento);
                            $('#medico_id').val(id);
                            $('#medicoModal').modal('show');
                            $('#action').val('Alterar');
                            $('.modal-title').text('Editar Registro');
                          }
                      })
                    })

                    
                    //edição dos registros

                    $('#form_medico').on('submit', function(event){
                      event.preventDefault();
                      var form_data = $(this).serialize();
                      $.ajax({
                          url:"{{ route('ajaxdata.postdata') }}",
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
                                  $('#form_medico')[0].reset();
                                  $('.modal-title').text('Editar');
                                  $('#medicoModal').modal('hide');
                                  $('#form_output').html('');
                                  $('#medicos').DataTable().ajax.reload();
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
                      //Acciones si el usuario confirma

                      var id = $('.apagar').attr('id');

                      $.ajax({
                          url: "{{route('ajaxdata.deletaMedico')}}",
                          method: 'get',
                          data: {id:id},
                          dataType: 'json',
                          success:function(data){
                            $('#medico_id').val(id);
                            $('#medicoModal').modal('show');
                            $('#action').val('delete');
                          }
                      })
                      // $("#result").html("CONFIRMADO");
                    }else{
                      //Acciones si el usuario no confirma
                      $("#result").html("NO CONFIRMADO");
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
<div id="medicoModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="form_medico">
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
                        <label>Especialidade</label>
                        <input type="text" name="especialidade" id="especialidade" class="form-control" />
                    </div>
                     <div class="form-group">
                        <label>Dias de Atendimento</label>
                        <input type="text" name="dias_atendimento" id="dias_atendimento" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                     <input type="hidden" name="medico_id" id="medico_id" value="" />
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
        <button type="button" class="btn btn-default" id="modal-btn-si">Sim</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no">Não</button>
      </div>
    </div>
  </div>
</div>

<div class="alert" role="alert" id="result"></div>
@stop

  
