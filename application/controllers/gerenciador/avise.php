<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avise extends CI_Controller {

	var $titulo 		= 'Avise-me';
	var $dir 			= 'multitools/avise/';
	var $controller 	= 'multitools/avise';
	var $title_sing 	= 'Avise-me';
	var $per_page 		= 20;
	var $table 			= 'avise_me';
	var $join			= array('cursos_abertos' => array('where' => 'cursos_abertos.id = curso_id', 'type' => 'left'),
								'programas_alta_performance' => array('where' => 'programas_alta_performance.id = curso_id', 'type' => 'left'),
								'disponibilidadehorario' => array('where' => 'disponibilidadehorario.disponibilidadehorario_id = disponibilidadehorario_disponibilidadehorario_id', 'type' => 'left'),
								);

	var $tipos_cursos   = array('AB' => 'Curso Aberto', 'AL' => 'Programa de Alta Performance');

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($tipo_curso='AB',$offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;
                $data['tipo_curso']=$tipo_curso;

		//Menu
		get_menu();

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, disponibilidadehorario.disponibilidadehorario_nome as horario, cursos_abertos.titulo as titulo_aberto, programas_alta_performance.titulo as titulo_programa'), $offset, $this->per_page, array('tipo_curso'=>$tipo_curso), $this->join, $this->table.'.avise_me_id', 'DESC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

/*	public function adicionar(){

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
*/
	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'avise_me_id');

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
		if(isset($data["avise_me_id"]) && $data["avise_me_id"])
			$rows_affected = $this->default_model->update($this->table, $_POST['avise_me_id'], $data, 'avise_me_id');
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
		if($this->default_model->delete($this->table, array('avise_me_id'=>$id)))
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
                $data['tipo_curso']=$this->input->get('tipo_curso');
                 
                 

		//Menu
		get_menu();

		//Parâmetros de busca
		$data_busca[$this->table.'.nome_interessado']  = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, disponibilidadehorario.disponibilidadehorario_nome as horario, cursos_abertos.titulo as titulo_aberto, programas_alta_performance.titulo as titulo_programa'), array('tipo_curso'=>$data['tipo_curso']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.avise_me_id', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
               
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */