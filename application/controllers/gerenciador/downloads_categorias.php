<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads_categorias extends CI_Controller {

	var $titulo 		= 'Linhas de Negócios';
	var $dir 			= 'multitools/downloads_categorias/';
	var $controller 	= 'multitools/downloads_categorias';
	var $title_sing 	= 'Linha de Negócio';
	var $per_page 		= 20;
	var $table 			= 'downloads_categorias';
	var $join			= array('downloads_categorias AS categorias' => array('where' => 'categorias.id_downloads_categorias = downloads_categorias.downloads_categorias_id_downloads_categorias', 'type' => 'left'));

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
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, categorias.nome_categoria as categoria_principal'), $offset, $this->per_page, array(), $this->join, $this->table.'.nome_categoria', 'ASC');

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

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Categorias
		$data['categorias'] = $this->default_model->listaAssociativa('downloads_categorias', 'nome_categoria', NULL, array('downloads_categorias_id_downloads_categorias' => NULL), NULL, NULL, false, 'id_downloads_categorias');

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
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_downloads_categorias');

		//Categorias
		$data['categorias'] = $this->default_model->listaAssociativa('downloads_categorias', 'nome_categoria', NULL, array('downloads_categorias_id_downloads_categorias' => NULL), NULL, NULL, false, 'id_downloads_categorias');

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
		$data['downloads_categorias_id_downloads_categorias'] = $data['downloads_categorias_id_downloads_categorias'] ? $data['downloads_categorias_id_downloads_categorias'] : NULL;

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_downloads_categorias"]) && $data["id_downloads_categorias"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id_downloads_categorias'], $data, 'id_downloads_categorias');
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
		if(!$this->default_model->get_all('downloads', array('*'), 0, NULL, array('downloads_categorias_id_downloads_categorias' => $id))){
			if($this->default_model->delete($this->table, array('id_downloads_categorias'=>$id)))
				$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
			else
				$this->session->set_flashdata('msg', 'Registro não foi excluído!');
		}
		else
			$this->session->set_flashdata('msg', 'Esse registro possui relação com algum DOWNLOAD cadastrado.');

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
		$data_busca[$this->table.'.nome_categoria']  = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, categorias.nome_categoria as categoria_principal'), NULL, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.nome_categoria', 'ASC');
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