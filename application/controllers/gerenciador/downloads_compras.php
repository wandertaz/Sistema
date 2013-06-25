<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads_compras extends CI_Controller {

	var $titulo 		= 'Compras';
	var $dir 			= 'multitools/downloads_compras/';
	var $controller 	= 'multitools/downloads_compras';
	var $title_sing 	= 'Compra';
	var $per_page 		= 20;
	var $table 			= 'downloads_compras';
	var $join			= array('downloads_versoes' => array('where' => 'downloads_versoes.id_download_versoes = downloads_compras.downloads_versoes_id_download_versoes', 'type' => 'inner'),
							    'downloads' => array('where' => 'downloads.id_downloads = downloads_versoes.downloads_id_downloads', 'type' => 'inner'),
							    'inscritos' => array('where' => 'inscritos.id = downloads_compras.inscritos_id', 'type' => 'inner'),
							    'compras' => array('where' => 'compras.id = downloads_compras.compras_id', 'type' => 'inner')
							);
	var $status   	    = array('AN' => 'Em análise', 'AP' => 'Aprovado', 'CA' => 'Cancelado', 'AG' => 'Aguardando Pagamento');

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
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, downloads.titulo, inscritos.nome, compras.status'), $offset, $this->per_page, array(), $this->join, $this->table.'.id_downloads_compras', 'DESC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		$data['status'] = $this->status;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}
/*
	public function adicionar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

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

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_downloads_compras');

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
		if(isset($data["id_downloads_compras"]) && $data["id_downloads_compras"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id_downloads_compras'], $data, 'id_downloads_compras');
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
		redirect($this->controller);
	}

	public function excluir($id){

		//Exclui registro
		if($this->default_model->update($this->table, $id, array('ativo' => 'N'), 'id_downloads'))
			$this->session->set_flashdata('msg', 'Registro desativado com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi desativado!');

		//Retorno
		redirect($this->controller);
	}
*/
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
		$data_busca['downloads.titulo']  = $this->input->get('s');
		$data_busca['downloads.descricao']  = $this->input->get('s');
		$data_busca['inscritos.nome']  = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, downloads.titulo, inscritos.nome, compras.status'), NULL, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id_downloads_compras', 'DESC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		$data['status'] = $this->status;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */