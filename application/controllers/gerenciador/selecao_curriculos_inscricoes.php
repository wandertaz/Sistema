<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Selecao_curriculos_inscricoes extends CI_Controller {

	var $titulo 		= 'Seleção de Currículos Contratados';
	var $dir 			= 'multitools/selecao_curriculos_inscricoes/';
	var $controller 	= 'multitools/selecao_curriculos_inscricoes';
	var $title_sing 	= 'Seleção de Currículos';
	var $per_page 		= 20;
	var $table 			= 'selecao_curriculos_inscricoes';
	var $join			= array('inscritos' => array('where' => 'inscritos.id = inscritos_id AND tipo_pessoa = "J"', 'type' => 'inner'));

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome as inscrito'), $offset, $this->per_page, array(), $this->join, $this->table.'.id_inscricao', 'DESC', 'id_inscricao');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function ver($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Ver '.$this->title_sing;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, $this->join, 'id_inscricao');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Currículos
		$join = array('inscritos' => array('where' => 'inscritos.id = curriculos.inscritos_id AND tipo_pessoa = "F"', 'type' => 'inner'));
		$data['curriculos'] = $this->default_model->get_all('curriculos', array('curriculos.*, inscritos.nome as inscrito'), 0, NULL, 'id_curriculo IN ('.$data['registro']->curriculos_ids.')', $join, 'curriculos.id_curriculo', 'DESC');

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_inscricao"]) && $data["id_inscricao"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id_inscricao'], $data, 'id_inscricao');
		else{
			$data['data_inscricao'] = date('Y-m-d H:i:s');
			$rows_affected = $this->default_model->insert($this->table, $data);
		}

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller);
	}

	private function _pagination($table, $search = FALSE){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, array(), $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s');
		}
		else{
			$config['uri_segment'] = 4;
			$config['total_rows']  = $this->default_model->count($this->table, array(), $this->join);
			$config['base_url']    = base_url().$this->controller.'/index';
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
		$data_busca['inscritos.nome']  = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, inscritos.nome as inscrito'), NULL, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id_inscricao', 'DESC', 'id_inscricao');
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