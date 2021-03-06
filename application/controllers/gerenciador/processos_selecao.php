<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Processos_selecao extends CI_Controller {

	var $titulo 		= 'Processos de Seleção';
	var $dir 			= 'multitools/processos_selecao/';
	var $controller 	= 'multitools/processos_selecao';
	var $title_sing 	= 'Processo de Seleção';
	var $per_page 		= 20;
	var $table 			= 'processo_selecao';
	var $join			= array('inscritos' => array('where' => 'inscritos.id = inscritos_id AND inscritos.tipo_pessoa = "J"', 'type' => 'inner'));

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
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome'), $offset, $this->per_page, array(), $this->join, $this->table.'.id_processo', 'DESC');

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

		//Busca Inscritos
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome', NULL, array('tipo_pessoa' => 'J', 'ativo' => 'S'), NULL, NULL, false, 'id');

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
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_processo');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca Inscritos
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome', NULL, array('tipo_pessoa' => 'J', 'ativo' => 'S'), NULL, NULL, false, 'id');

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Library de Upload
		$config['upload_path']   = './assets/uploads/';
		$config['allowed_types'] = 'pdf|doc|zip';
		$this->load->library('upload', $config);

		//Upload da imagem
		if(!empty($_FILES['arquivo']['name'])){
			if($this->upload->do_upload('arquivo')){

				if(isset($data["id_processo"]) && $data["id_processo"]){
					$registro = $this->default_model->get_by_id($this->table, $data["id_processo"], array('*'), NULL, NULL, 'id_processo');
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
		if(isset($data["id_processo"]) && $data["id_processo"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id_processo'], $data, 'id_processo');
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
		if($this->default_model->delete($this->table, array('id_processo'=>$id)))
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
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, inscritos.nome'), NULL, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id_processo', 'DESC');
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