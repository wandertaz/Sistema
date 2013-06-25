<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exercicios_alternativas extends CI_Controller {

	var $titulo 		= 'Alternativas';
	var $dir 			= 'multitools/exercicios_alternativas/';
	var $controller 	= 'multitools/exercicios_alternativas';
	var $title_sing 	= 'Alternativa';
	var $per_page 		= 20;
	var $table 			= 'exercicios_alternativas';
	var $join			= array('exercicios_perguntas' => array('where' => 'exercicios_perguntas.id = pergunta_id', 'type' => 'inner'));

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($pergunta_id, $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		$data['pergunta_id'] = $pergunta_id;
		$where = array('pergunta_id' => $data['pergunta_id']);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, exercicios_perguntas.pergunta as pergunta'), $offset, $this->per_page, $where, $this->join, $this->table.'.pergunta_id', 'ASC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false, $data['pergunta_id']);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($pergunta_id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca Perguntas
		$data['pergunta_id'] = $pergunta_id;
		$data['perguntas'] = $this->default_model->listaAssociativa('exercicios_perguntas', 'pergunta', null, array('id' => $data['pergunta_id']));
		unset($data['perguntas']['']);

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca perguntas
		$data['perguntas'] = $this->default_model->listaAssociativa('exercicios_perguntas', 'pergunta', null, array('id' => $data['registro']->pergunta_id));
		unset($data['perguntas']['']);

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Flag correta
		$where = $data['id'] ? array('id <>' => $data['id']) : array();
		$respostas = $this->default_model->get_all($this->table, array('*'), 0, NULL, $where + array('pergunta_id' => $data['pergunta_id'], 'correta' => 'S'));
		if($respostas && $data['correta'] == 'S')
			$msg = 'Já existe uma alternativa correta para esta pergunta.';
		else if(!$respostas && $data['correta'] == 'N')
			$msg = 'A alternativa que você está tentando salvar precisa estar correta.';

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
			redirect($this->controller.'/index/'.$data['pergunta_id']);
		}
		else{
			//Retorno
			$this->session->set_flashdata('msg_erro', $msg);
			redirect($this->controller.'/index/'.$data['pergunta_id']);
		}
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
		redirect($this->controller.'/index/'.$data['registro']->pergunta_id);
	}

	private function _pagination($table, $search = FALSE, $pergunta_id){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		$where = array('pergunta_id' => $pergunta_id);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&pergunta_id='.$pergunta_id;
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$pergunta_id;
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
		$data_busca[$this->table.'.resposta']  = $this->input->get('s');
		$data['pergunta_id'] = $this->input->get('pergunta_id');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, exercicios_perguntas.pergunta as pergunta'), array('pergunta_id' => $data['pergunta_id']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.pergunta_id', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca);

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