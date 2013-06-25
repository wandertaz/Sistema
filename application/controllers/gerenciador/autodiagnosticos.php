<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autodiagnosticos extends CI_Controller {

	var $titulo 		= 'Autodiagnósticos';
	var $dir 			= 'multitools/autodiagnosticos/';
	var $controller 	= 'multitools/autodiagnosticos';
	var $title_sing 	= 'Autodiagnóstico';
	var $per_page 		= 20;
	var $table 			= 'autodiagnosticos';
	var $join			= array('tipos_autodiagnosticos' => array('where' => 'tipos_autodiagnosticos.id_tipo_autodiagnostico = tipos_autodiagnosticos_id_tipo_autodiagnostico', 'type' => 'inner'));

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
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, nome_tipo'), $offset, $this->per_page, array($this->table.'.ativo'=>'S'), $this->join, $this->table.'.id_autodiagnostico', 'DESC');

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

		//Busca Tipos
		$data['tipos'] = $this->default_model->listaAssociativa('tipos_autodiagnosticos', 'nome_tipo', NULL, NULL, NULL, NULL, false, 'id_tipo_autodiagnostico');

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
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_autodiagnostico');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca Tipos
		$data['tipos'] = $this->default_model->listaAssociativa('tipos_autodiagnosticos', 'nome_tipo', NULL, NULL, NULL, NULL, false, 'id_tipo_autodiagnostico');

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;
		$data['preco'] = numero_pt_para_mysql($data['preco']);

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_autodiagnostico"]) && $data["id_autodiagnostico"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id_autodiagnostico'], $data, 'id_autodiagnostico');
		else{
			$data['url']   = sanitize_title_with_dashes($data['nome']);
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

		/*if(!$this->default_model->get_all('autodiagnosticos_grupos_perguntas', array('*'), 0, NULL, array('autodiagnosticos_id_autodiagnostico' => $id)) &&
		   !$this->default_model->get_all('autodiagnostico_inscricoes', array('*'), 0, NULL, array('autodiagnosticos_id_autodiagnostico' => $id)) &&
		   !$this->default_model->get_all('autodiagnostico_resultados', array('*'), 0, NULL, array('autodiagnosticos_id_autodiagnostico' => $id))  ){

			//Exclui registro
			if($this->default_model->delete($this->table, array('id_autodiagnostico'=>$id)))
				$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
			else
				$this->session->set_flashdata('msg', 'Registro não foi excluído!');
		}
		else
			$this->session->set_flashdata('msg', 'Esse registro possui relação com algum GRUPO, INSCRIÇÂO OU RESULTADO.');
                */
		//Retorno
            
           // $this->table
           // $this->default_model->update_where('tabela',array('ativo'=>'N'),array('id_autodiagnostico'=>$id));
            
                if($this->default_model->update_where($this->table,array('ativo'=>'N'),array('id_autodiagnostico'=>$id)))
                    $this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
                else
                    $this->session->set_flashdata('msg', 'Registro não foi excluído!');
            
            
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
		$data_busca[$this->table.'.nome']  = $this->input->get('s');
		$data_busca[$this->table.'.breve_descricao'] = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, nome_tipo'), NULL, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id_autodiagnostico', 'DESC');
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