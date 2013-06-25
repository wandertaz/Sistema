<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autodiagnosticos_perguntas extends CI_Controller {

	var $titulo 		= 'Perguntas';
	var $dir 			= 'multitools/autodiagnosticos_perguntas/';
	var $controller 	= 'multitools/autodiagnosticos_perguntas';
	var $title_sing 	= 'Pergunta';
	var $per_page 		= 20;
	var $table 			= 'autodiagnostico_perguntas';
	var $join			= array('autodiagnosticos_grupos_perguntas' => array('where' => 'autodiagnosticos_grupos_perguntas.id_grupo_pergunta = autodiagnosticos_grupos_perguntas_id_grupo_pergunta', 'type' => 'inner'));

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($grupo_id, $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//autodiagnóstico
		$data['autodiagnosticos_grupos_perguntas_id_grupo_pergunta'] = $grupo_id;
		$where = array('autodiagnosticos_grupos_perguntas_id_grupo_pergunta' => $data['autodiagnosticos_grupos_perguntas_id_grupo_pergunta']);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, nome_grupo'), $offset, $this->per_page, $where, $this->join, $this->table.'.id_pergunta', 'DESC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false, $data['autodiagnosticos_grupos_perguntas_id_grupo_pergunta']);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($grupo_id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca lista de autodiagnósticos
		$data['autodiagnosticos_grupos_perguntas_id_grupo_pergunta'] = $grupo_id;
		$data['grupos'] = $this->default_model->listaAssociativa('autodiagnosticos_grupos_perguntas', 'nome_grupo', NULL, array('id_grupo_pergunta' => $data['autodiagnosticos_grupos_perguntas_id_grupo_pergunta']), NULL, NULL, false, 'id_grupo_pergunta');
		unset($data['grupos']['']);

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
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pergunta');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca lista de autodiagnósticos
		$data['grupos'] = $this->default_model->listaAssociativa('autodiagnosticos_grupos_perguntas', 'nome_grupo', NULL, array('id_grupo_pergunta' => $data['registro']->autodiagnosticos_grupos_perguntas_id_grupo_pergunta), NULL, NULL, false, 'id_grupo_pergunta');
		unset($data['grupos']['']);

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_pergunta"]) && $data["id_pergunta"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id_pergunta'], $data, 'id_pergunta');
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
		redirect($this->controller.'/index/'.$data['autodiagnosticos_grupos_perguntas_id_grupo_pergunta']);
	}

	public function excluir($id){

		//Exclui registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pergunta');
		if(!$this->default_model->get_all('autodiagnostico_respostas', array('*'), 0, NULL, array('autodiagnostico_perguntas_id_pergunta' => $id))){
			if($this->default_model->delete($this->table, array('id_pergunta'=>$id)))
				$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
			else
				$this->session->set_flashdata('msg', 'Registro não foi excluído!');
		}
		else
			$this->session->set_flashdata('msg', 'Esse registro possui relação com alguma RESPOSTA.');

		//Retorno
		redirect($this->controller.'/index/'.$data['registro']->autodiagnosticos_grupos_perguntas_id_grupo_pergunta);
	}

	private function _pagination($table, $search = FALSE, $grupo_id){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//where
		$where = array('autodiagnosticos_grupos_perguntas_id_grupo_pergunta' => $grupo_id);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&grupo_id='.$grupo_id;
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$grupo_id;
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
		$data['autodiagnosticos_grupos_perguntas_id_grupo_pergunta'] = $this->input->get('grupo_id');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, nome_grupo'), array('autodiagnosticos_grupos_perguntas_id_grupo_pergunta' => $data['autodiagnosticos_grupos_perguntas_id_grupo_pergunta']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id_pergunta', 'DESC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['autodiagnosticos_grupos_perguntas_id_grupo_pergunta']);

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