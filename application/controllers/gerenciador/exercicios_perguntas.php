<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exercicios_perguntas extends CI_Controller {

	var $titulo 		= 'Perguntas';
	var $dir 			= 'multitools/exercicios_perguntas/';
	var $controller 	= 'multitools/exercicios_perguntas';
	var $title_sing 	= 'Perguntas';
	var $per_page 		= 20;
	var $table 			= 'exercicios_perguntas';
	var $join			= array('exercicios' => array('where' => 'exercicios.id = exercicio_id', 'type' => 'inner'));

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($exercico_id, $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		$data['exercicio_id'] = $exercico_id;
		$where = array('exercicio_id' => $data['exercicio_id']);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, exercicios.titulo as exercicio'), $offset, $this->per_page, $where, $this->join, $this->table.'.exercicio_id', 'ASC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false, $data['exercicio_id']);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($exercico_id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca Exercicios
		$data['exercicio_id'] = $exercico_id;
		$data['exercicios'] = $this->default_model->listaAssociativa('exercicios', 'titulo', NULL, array('id' => $data['exercicio_id']));
		unset($data['exercicios']['']);

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

		//Busca exercicios
		$data['exercicios'] = $this->default_model->listaAssociativa('exercicios', 'titulo', NULL, array('id' => $data['registro']->exercicio_id));
		unset($data['exercicios']['']);

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

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
		redirect($this->controller.'/index/'.$data['exercicio_id']);
	}

	public function excluir($id){

		//Registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);

		//Exclui registro
		if($this->default_model->delete($this->table, array('id'=>$id)))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');

		//Retorno
		redirect($this->controller.'/index/'.$data['registro']->exercicio_id);
	}

	private function _pagination($table, $search = FALSE, $exercicio_id){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, array('exercicio_id' => $exercicio_id), $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&exercicio_id='.$exercicio_id;
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, array('exercicio_id' => $exercicio_id), $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$exercicio_id;
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
		$data_busca[$this->table.'.pergunta']  = $this->input->get('s');
		$data['exercicio_id'] = $this->input->get('exercicio_id');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, exercicios.titulo as exercicio'), array('exercicio_id' => $data['exercicio_id']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.exercicio_id', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['exercicio_id']);

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