<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exercicios extends CI_Controller {

	var $titulo 		= 'Exercícios/Provas';
	var $dir 			= 'multitools/exercicios/';
	var $controller 	= 'multitools/exercicios';
	var $title_sing 	= 'Exercício/Prova';
	var $per_page 		= 20;
	var $table 			= 'exercicios';
	var $join			= array('aulas' => array('where' => 'aulas.id = aula_id', 'type' => 'inner'));
	var $tipos_cursos   = array('AB' => 'Curso Aberto', 'IN' => 'Curso In Company', 'AL' => 'Programa de Alta Performance', 'DE'=> 'Programa de Desenvolvimento');

	public function __construct(){
		parent::__construct();
		$this->load->helper("br_date_helper");
		check_login();
	}

	public function index($tipo = 'EL', $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Tipo de Curso
		$data['tipo'] = $tipo;
		$where = ($data['tipo'] ? array('aulas.tipo_curso' => $data['tipo']) : NULL);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, aulas.titulo as aula'), $offset, $this->per_page, $where, $this->join, $this->table.'.id', 'DESC');

		//Parâmetros
		$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo']);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($tipo = 'EL'){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//aulas
		$data['tipo']  = $tipo;
		$data['aulas'] = array('' => 'Selecionar Aula') + $this->default_model->listaAssociativa('aulas', 'titulo', NULL, array('aulas.tipo_curso' => $data['tipo']));

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
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('exercicios.*, aulas.tipo_curso as tipo_curso'), NULL, $this->join);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Aulas
		$data['tipo'] = $data['registro']->tipo_curso;
		$data['aulas'] = array('' => 'Selecionar Aula') + $this->default_model->listaAssociativa('aulas', 'titulo', NULL, array('aulas.tipo_curso' => $data['tipo']));

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;
		$tipo_curso = $data['tipo_curso'];
		unset($data['tipo_curso']);

		//Busca aula referente
		$aula = $this->default_model->get_by_id('aulas', $data['aula_id']);

		$where = $data['id'] ? array('exercicios.id <>' => $data['id']) : array();
		$join = array('aulas' => array('where' => 'aulas.id = aula_id', 'type' => 'left'), 'elearning' => array('where' => 'elearning.id = aulas.curso_id AND aulas.tipo_curso = "EL"', 'type' => 'left'));
		$exercicios = $this->default_model->get_all('exercicios', array('SUM(exercicios.valor) as total'), 0, NULL, $where + array('exercicios.ativo' =>  'S', 'tipo' => $data['tipo'], 'curso_id' => $aula->curso_id), $join, 'exercicios.id', 'ASC');

		if($exercicios && ($exercicios[0]->total + $data['valor'] > 100) && $data['ativo'] == 'S')
			$msg = 'Não foi possível salvar. A pontuação máxima foi atingida para este curso.';

		if(!isset($msg)){
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
			redirect($this->controller.'/index/'.$tipo_curso);
		}
		else{
			//Retorno
			$this->session->set_flashdata('msg_erro', $msg);
			redirect($this->controller.'/index/'.$tipo_curso);
		}
	}

	public function excluir($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), null, $this->join);
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

		$where = ($tipo ? array('aulas.tipo_curso' => $tipo) : NULL);

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
		$data_busca['aulas.titulo']  = $this->input->get('s');
		$data_busca['exercicios.titulo']  = $this->input->get('s');
		$data['tipo'] = $this->input->get('tipo');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, aulas.titulo as aula'), array('aulas.tipo_curso' => $data['tipo']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'DESC');
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