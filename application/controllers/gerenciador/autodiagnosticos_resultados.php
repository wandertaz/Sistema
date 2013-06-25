<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autodiagnosticos_resultados extends CI_Controller {

	var $titulo 		= 'Resultados de Autodiagnósticos';
	var $dir 			= 'multitools/autodiagnosticos_resultados/';
	var $controller 	= 'multitools/autodiagnosticos_resultados';
	var $title_sing 	= 'Resultado';
	var $per_page 		= 20;
	var $table 			= 'autodiagnostico_resultados';
	var $join			= array('autodiagnosticos' => array('where' => 'autodiagnosticos.id_autodiagnostico = autodiagnosticos_id_autodiagnostico', 'type' => 'inner'));

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($autodiagnostico_id, $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//autodiagnóstico
		$data['autodiagnosticos_id_autodiagnostico'] = $autodiagnostico_id;
		$where = array('autodiagnosticos_id_autodiagnostico' => $data['autodiagnosticos_id_autodiagnostico']);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, nome as autodiagnostico'), $offset, $this->per_page, $where, $this->join, $this->table.'.id_resultado', 'DESC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false, $data['autodiagnosticos_id_autodiagnostico']);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($autodiagnostico_id){

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
		$data['autodiagnosticos_id_autodiagnostico'] = $autodiagnostico_id;
		$data['autodiagnosticos'] = $this->default_model->listaAssociativa('autodiagnosticos', 'nome', NULL, array('id_autodiagnostico' => $data['autodiagnosticos_id_autodiagnostico']), NULL, NULL, false, 'id_autodiagnostico');
		unset($data['autodiagnosticos']['']);

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
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_resultado');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca lista de autodiagnósticos
		$data['autodiagnosticos'] = $this->default_model->listaAssociativa('autodiagnosticos', 'nome', NULL, array('id_autodiagnostico' => $data['registro']->autodiagnosticos_id_autodiagnostico), NULL, NULL, false, 'id_autodiagnostico');
		unset($data['autodiagnosticos']['']);

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_resultado"]) && $data["id_resultado"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id_resultado'], $data, 'id_resultado');
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
		redirect($this->controller.'/index/'.$data['autodiagnosticos_id_autodiagnostico']);
	}

	public function excluir($id){

		//Exclui registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_resultado');
		if($this->default_model->delete($this->table, array('id_resultado'=>$id)))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');

		//Retorno
		redirect($this->controller.'/index/'.$data['registro']->autodiagnosticos_id_autodiagnostico);
	}

	private function _pagination($table, $search = FALSE, $autodiagnostico_id){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//where
		$where = array('autodiagnosticos_id_autodiagnostico' => $autodiagnostico_id);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&autodiagnostico_id='.$autodiagnostico_id;
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$autodiagnostico_id;
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
		$data_busca[$this->table.'.texto']  = $this->input->get('s');
		$data['autodiagnosticos_id_autodiagnostico'] = $this->input->get('autodiagnostico_id');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, nome as autodiagnostico'), array('autodiagnosticos_id_autodiagnostico' => $data['autodiagnosticos_id_autodiagnostico']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id_resultado', 'DESC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['autodiagnosticos_id_autodiagnostico']);

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