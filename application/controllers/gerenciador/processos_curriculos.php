<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Processos_curriculos extends CI_Controller {

	var $titulo 		= 'Processos Por Currículo';
	var $dir 			= 'multitools/processos_curriculos/';
	var $controller 	= 'multitools/processos_curriculos';
	var $title_sing 	= 'Processo Por Currículo';
	var $per_page 		= 20;
	var $table 			= 'processo_selecao_curriculos';
	var $join			= array('curriculos' => array('where' => 'curriculos.id_curriculo = curriculos_id_curriculo', 'type' => 'inner'),
								'processo_selecao' => array('where' => 'processo_selecao.id_processo = processo_selecao_id_processo', 'type' => 'inner'),
								'inscritos' => array('where' => 'inscritos.id = curriculos.inscritos_id AND inscritos.tipo_pessoa = "F"', 'type' => 'inner')
							);

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($processo_id = false, $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Filtro por processo, se necessário
		$where = $processo_id ? array('processo_selecao_id_processo' => $processo_id) : NULL;

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome, processo_selecao.titulo'), $offset, $this->per_page, $where, $this->join, $this->table.'.processos_curriculos_id', 'DESC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false, $where);
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

		//Busca Currículos e Processos
		$data['curriculos'] = $this->default_model->listaAssociativa('curriculos', 'nome', array('inscritos' => array('where' => 'inscritos.id = curriculos.inscritos_id AND inscritos.tipo_pessoa = "F"', 'type' => 'inner')), array('inscritos.tipo_pessoa' => 'F'), 'inscritos.nome', 'ASC', false, 'id_curriculo', array('curriculos.*, inscritos.nome as nome'));
		$data['processos'] = $this->default_model->listaAssociativa('processo_selecao', 'titulo', NULL, array(), 'titulo', 'ASC', false, 'id_processo');

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
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'processos_curriculos_id');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca Currículos e Processos
		$data['curriculos'] = $this->default_model->listaAssociativa('curriculos', 'nome', array('inscritos' => array('where' => 'inscritos.id = curriculos.inscritos_id AND inscritos.tipo_pessoa = "F"', 'type' => 'inner')), array('inscritos.tipo_pessoa' => 'F'), 'inscritos.nome', 'ASC', false, 'id_curriculo', array('curriculos.*, inscritos.nome as nome'));
		$data['processos'] = $this->default_model->listaAssociativa('processo_selecao', 'titulo', NULL, array(), 'titulo', 'ASC', false, 'id_processo');

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
		if(!empty($_FILES['arquivo_resultado']['name'])){
			if($this->upload->do_upload('arquivo_resultado')){

				if(isset($data["processos_curriculos_id"]) && $data["processos_curriculos_id"]){
					$registro = $this->default_model->get_by_id($this->table, $data["processos_curriculos_id"], array('*'), NULL, NULL, 'processos_curriculos_id');
					@unlink('./assets/uploads/'.$registro->arquivo_resultado);
				}
				$data_file      = $this->upload->data();
				$data['arquivo_resultado'] = $data_file['file_name'];
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());
				redirect($this->controller);
			}
		}

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["processos_curriculos_id"]) && $data["processos_curriculos_id"])
			$rows_affected = $this->default_model->update($this->table, $_POST['processos_curriculos_id'], $data, 'processos_curriculos_id');
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
		redirect($this->controller.'/index/'.$data['processo_selecao_id_processo']);
	}

	public function excluir($id){

		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'processos_curriculos_id');
		//Exclui registro
		if($this->default_model->delete($this->table, array('processos_curriculos_id'=>$id)))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');

		//Retorno
		redirect($this->controller.'/index/'.$data['registro']->processo_selecao_id_processo);
	}

	private function _pagination($table, $search = FALSE, $where = NULL){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s');
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
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
		$data_busca['processo_selecao.titulo'] = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, inscritos.nome, processo_selecao.titulo'), NULL, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.processos_curriculos_id', 'DESC');
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