<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();


Route::get('/painel', 'HomeController@index')->name('home');


$this->group(['middleware' => ['auth'], 'namespace' => 'Painel' ], function(){
	

	/*
	* MÉDICOS
	*
	*/

	$this->get('painel/medicos', 'clinicaController@medicos')->name('medicos');
	

	$this->get('painel/cadastro-medico', 'clinicaController@formCadastraMedico')->name('cadastro-medico');

	$this->post('painel/cadastro-medico', 'clinicaController@cadastraMedico')->name('adiciona-medico');

	$this->get('painel/lista-medicos', 'clinicaController@listaMedicos')->name('lista-medicos');
	$this->get('painel/lista/getmedicos', ['as'=>'listaMedicos.getMedicos','uses'=>'clinicaController@getMedicos']);

	$this->post('painel/lista-medicos/postdata', 'AjaxDataController@postdata')->name('ajaxdata.postdata');

	$this->get('painel/lista-medicos/fetchdata', 'AjaxDataController@fetchdata')->name('ajaxdata.fetchdata');

	$this->post('painel/lista-medicos', 'AjaxDataController@deletaMedico')->name('ajaxdata.deletaMedico');

	/*
	* PACIENTES
	*
	*/

	$this->get('painel/pacientes', 'clinicaController@index')->name('pacientes');

	$this->get('painel/cadastro-paciente', 'clinicaController@formCadatraPaciente')->name('cadastro-paciente');

	$this->post('painel/cadastro-paciente', 'clinicaController@cadastraPaciente')->name('adiciona-paciente');

	$this->get('painel/lista-paciente', 'clinicaController@datatable')->name('lista');

	$this->get('painel/lista/getposts', ['as'=>'datatable.getposts','uses'=>'clinicaController@getPosts']);

	/*
	* edição e exclusão
	*/

	$this->post('painel/lista-paciente/postdata', 'AjaxPacientesController@postdata')->name('ajaxpaciente.postdata');

	$this->get('painel/lista-paciente/fetchdata', 'AjaxPacientesController@fetchdata')->name('ajaxpaciente.editarPaciente');

	$this->post('painel/lista-paciente/deletaPaciente', 'AjaxPacientesController@deletaPaciente')->name('ajaxpaciente.deletaPaciente');


	/*
	* agendamentos
	*/

	$this->get('painel/agendamentos', 'agendamentosController@index')->name('agendamentos');
	$this->resource('painel/agendamentos', 'agendamentosController');

	$this->get('painel/cadastrar-agendamento', 'agendamentosController@cadastrar')->name('cadastrar-agendamento');

	$this->post('painel/cadastrar-agendamento', 'agendamentosController@cadastraAgenda')->name('cadastra-agenda');

	$this->get('painel/listar-agendamentos', 'agendamentosController@consultarAgenda')->name('consulta-agenda');


	/*
	* gerar json
	*/

	$this->get('painel/json', 'geraJsonController@geraJson')->name('gera-json');
});	
