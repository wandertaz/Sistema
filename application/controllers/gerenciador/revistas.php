<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Revistas extends CI_Controller {

	var $titulo 		= 'Revistas';
	var $dir 			= 'multitools/revistas/';
	var $controller 	= 'multitools/revistas';
	var $title_sing 	= 'Revistas';
	var $per_page 		= 20;
	var $table 			= 'revistas';
	var $join			= array('idiomas' => array('where' => 'idiomas.id = idioma_id', 'type' => 'inner'));

	public function __construct(){
		parent::__construct();
		check_login();
		$this->load->helper("br_date_helper");
	}

	public function index($offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, idiomas.nome as idioma'), $offset, $this->per_page, array(), $this->join, $this->table.'.id', 'DESC');

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

		//Busca Idiomas
		$data['idiomas'] = $this->default_model->listaAssociativa('idiomas', 'nome');

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

		//Busca Idiomas
		$data['idiomas'] = $this->default_model->listaAssociativa('idiomas', 'nome');

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Trata o link, inserindo 'http://' se necessário
		$data['link'] = prep_url($data['link']);

		//Library de Upload
		$config['upload_path']   = './assets/uploads/';
		$config['allowed_types'] = 'jpeg|jpg|gif|png|doc|pdf|zip';
		$this->load->library('upload', $config);

		//Upload da imagem
		if(!empty($_FILES['imagem']['name'])){
			if($this->upload->do_upload('imagem')){

				if(isset($data["id"]) && $data["id"]){
					$registro = $this->default_model->get_by_id($this->table, $data["id"]);
					@unlink('./assets/uploads/'.$registro->imagem);
				}
				$data_file      = $this->upload->data();
				$data['imagem'] = $data_file['file_name'];
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());
				redirect($this->controller);
			}
		}

		//Library de Upload
		$config['upload_path']   = './assets/uploads/';
		$config['allowed_types'] = 'doc|pdf|zip';
		$this->load->library('upload', $config);

		//Upload da imagem
		if(!empty($_FILES['arquivo']['name'])){
			if($this->upload->do_upload('arquivo')){

				if(isset($data["id"]) && $data["id"]){
					$registro = $this->default_model->get_by_id($this->table, $data["id"]);
					@unlink('./assets/uploads/'.$registro->arquivo);
				}
				$data_file      = $this->upload->data();
				$data['arquivo'] = $data_file['file_name'];
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());
				redirect($this->controller);
			}
		}

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id'], $data);
		else{
			$data['url']   = sanitize_title_with_dashes($data['titulo']);
			$data['created'] = date('Y-m-d');
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
		if($this->default_model->delete($this->table, array('id'=>$id)))
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
		$data_busca[$this->table.'.titulo']  = $this->input->get('s');
		$data_busca[$this->table.'.descricao'] = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, idiomas.nome as idioma'), NULL, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'ASC');
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