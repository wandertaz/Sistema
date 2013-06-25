<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Turmas extends CI_Controller {

	var $titulo 		= 'Turmas';
	var $dir 			= 'multitools/turmas/';
	var $controller 	= 'multitools/turmas';
	var $title_sing 	= 'Turma';
	var $per_page 		= 20;
	var $table 			= 'turmas';
	var $join			= array('cursos_abertos' => array('where' => 'cursos_abertos.id = curso_id', 'type' => 'left'),
								'programas_alta_performance' => array('where' => 'programas_alta_performance.id = curso_id', 'type' => 'left')
								);
	//var $tipos_cursos   = array('AB' => 'Curso Aberto', 'IN' => 'Curso In Company', 'AL' => 'Programa de Alta Performance', 'DE'=> 'Programa de Desenvolvimento');
	var $tipos_cursos   = array('AB' => 'Curso Aberto', 'AL' => 'Programa de Alta Performance');

	public function __construct(){
		parent::__construct();
		$this->load->helper("br_date_helper");
		check_login();
	}

	public function index($tipo = 'AB', $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Tipo de Curso
		$data['tipo'] = $tipo;
		$where = ($data['tipo'] ? array('tipo_curso' => $data['tipo']) : NULL);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, cursos_abertos.titulo as titulo_aberto, programas_alta_performance.titulo as titulo_programa '), $offset, $this->per_page, $where, $this->join, $this->table.'.id', 'DESC');

		//Parâmetros
		$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo']);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($tipo = ''){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Cursos
		$data['tipo'] = $tipo;
		$tabela_cursos = ($tipo == 'AB' ? 'cursos_abertos' : 'programas_alta_performance');
		$data['cursos'] = array('' => 'Curso') + $this->default_model->listaAssociativa($tabela_cursos, 'titulo');

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Cursos
		$data['tipo'] = $data['registro']->tipo_curso;
		$tabela_cursos = ($data['registro']->tipo_curso == 'AB' ? 'cursos_abertos' : 'programas_alta_performance');
		$data['cursos'] = array('' => 'Selecione o Tipo de Curso') + $this->default_model->listaAssociativa($tabela_cursos, 'titulo');

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Trata as datas
		$data['data_inicial'] = w3c_date($_POST['data_inicial']);
		$data['data_final']   = w3c_date($_POST['data_final']);
		$data['data_limite']  = w3c_date($_POST['data_limite']);

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id'], $data);
		else{
			$rows_affected = $this->default_model->insert($this->table, $data);
		}

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller.'/index/'.$data['tipo_curso']);
	}

	public function excluir($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);
		$tipo = $data['registro']->tipo_curso;

		//Exclui registro
		if($this->default_model->delete($this->table, array('id'=>$id)))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');

		//Retorno
		redirect($this->controller.'/index/'.$tipo);
	}

	private function _pagination($table, $search = FALSE, $tipo){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		$where = ($tipo ? array('tipo_curso' => $tipo) : NULL);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&tipo='.$tipo;
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$tipo;
		}

		//Inicializa e retorna paginação
		$this->pagination->initialize($config);
		return $this->pagination->create_links();

	}

	public function buscar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Parâmetros de busca
		$data_busca['cursos_abertos.titulo']  = $this->input->get('s');
		$data_busca['programas_alta_performance.titulo'] = $this->input->get('s');
		$data['tipo'] = $this->input->get('tipo');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, cursos_abertos.titulo as titulo_aberto, programas_alta_performance.titulo as titulo_programa '), array('tipo_curso' => $data['tipo']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['tipo']);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */