<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidaturas_vagas extends CI_Controller {

	var $titulo 		= 'Candidaturas';
	var $dir 			= 'multitools/candidaturas_vagas/';
	var $controller 	= 'multitools/candidaturas_vagas';
	var $title_sing 	= 'Candidatura';
	var $per_page 		= 20;
	var $table 			= 'candidaturas_vagas';
	var $join			= array('curriculos' => array('where' => 'curriculos.id_curriculo = curriculos_id_curriculo', 'type' => 'inner'),
								'vagas' => array('where' => 'vagas.id_vaga = vaga_id_vaga', 'type' => 'inner'),
								'inscritos as candidato' => array('where' => 'candidato.id = curriculos.inscritos_id AND candidato.tipo_pessoa = "F"', 'type' => 'inner'),
								'inscritos as empresa' => array('where' => 'empresa.id = vagas.inscritos_id AND empresa.tipo_pessoa = "J"', 'type' => 'inner'),
							);

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
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, candidato.nome as nome_candidato, empresa.nome as nome_empresa, vagas.titulo_cargo as cargo'), $offset, $this->per_page, array(), $this->join, $this->table.'.created', 'DESC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Curriculos
		$join = array('inscritos' => array('where' => 'inscritos.id = curriculos.inscritos_id AND inscritos.tipo_pessoa = "F"', 'type' => 'inner'));
		$data['curriculos'] = $this->default_model->listaAssociativa('curriculos', 'nome_candidato', $join, array('inscritos.tipo_pessoa' => 'F', 'inscritos.ativo' => 'S'), 'inscritos.nome', 'ASC', false, 'id_curriculo', array('curriculos.*, inscritos.nome as nome_candidato'));

		//Vagas
		$join = array('inscritos' => array('where' => 'inscritos.id = vagas.inscritos_id AND inscritos.tipo_pessoa = "J"', 'type' => 'inner'));
		$dados = $this->default_model->get_all('vagas', array('*'), NULL, NULL, array('inscritos.tipo_pessoa' => 'J', 'inscritos.ativo' => 'S'), $join, 'inscritos.nome', 'ASC');
		if($dados) {
			foreach($dados as $value)
				$_ret[$value->id_vaga] = $value->titulo_cargo.' - '.$value->nome;
		}
		$data['vagas'] = $_ret;

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

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

		//Curriculos
		$join = array('inscritos' => array('where' => 'inscritos.id = curriculos.inscritos_id AND inscritos.tipo_pessoa = "F"', 'type' => 'inner'));
		$data['curriculos'] = $this->default_model->listaAssociativa('curriculos', 'nome_candidato', $join, array('inscritos.tipo_pessoa' => 'F', 'inscritos.ativo' => 'S'), 'inscritos.nome', 'ASC', false, 'id_curriculo', array('curriculos.*, inscritos.nome as nome_candidato'));

		//Vagas
		$join = array('inscritos' => array('where' => 'inscritos.id = vagas.inscritos_id AND inscritos.tipo_pessoa = "J"', 'type' => 'inner'));
		$dados = $this->default_model->get_all('vagas', array('*'), NULL, NULL, array('inscritos.tipo_pessoa' => 'J', 'inscritos.ativo' => 'S'), $join, 'inscritos.nome', 'ASC');
		if($dados) {
			foreach($dados as $value)
				$_ret[$value->id_vaga] = $value->titulo_cargo.' - '.$value->nome;
		}
		$data['vagas'] = $_ret;

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_candidatura');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_candidatura"]) && $data["id_candidatura"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id_candidatura'], $data, 'id_candidatura');
		else{
			$data['created'] = date('Y-m-d H:i:s');
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

	public function excluir($id){

		//Exclui registro
		if($this->default_model->delete($this->table, array('id_candidatura'=>$id)))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');


		//Retorno
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
		$data_busca['candidato.nome']  = $this->input->get('s');
		$data_busca['empresa.nome']  = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, candidato.nome as nome_candidato, empresa.nome as nome_empresa, vagas.titulo_cargo as cargo'), NULL, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.created', 'DESC');
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