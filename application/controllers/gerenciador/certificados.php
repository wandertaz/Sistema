<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Certificados extends CI_Controller {

	var $titulo 		= 'Certificados';
	var $dir 			= 'multitools/certificados/';
	var $controller 	= 'multitools/certificados';
	var $title_sing 	= 'Certificado';
	var $per_page 		= 20;
	var $table 			= 'inscricoes';
	var $join			= array('turmas' => array('where' => 'turmas.id = turma_id', 'type' => 'left'),
								'inscritos' => array('where' => 'inscritos.id = inscrito_id', 'type' => 'inner'),
								'cursos_abertos' => array('where' => 'cursos_abertos.id = turmas.curso_id', 'type' => 'left'),
								'programas_alta_performance' => array('where' => 'programas_alta_performance.id = turmas.curso_id', 'type' => 'left'),
								'cursos_incompany' => array('where' => 'cursos_incompany.id = inscricoes.curso_id', 'type' => 'left'),
								'programas_desenvolvimento' => array('where' => 'programas_desenvolvimento.id = inscricoes.curso_id', 'type' => 'left'),
								'elearning' => array('where' => 'elearning.id = inscricoes.curso_id', 'type' => 'left'),
								'notas' => array('where' => 'notas.inscrito_id = inscricoes.inscrito_id AND notas.curso_id = inscricoes.curso_id AND notas.tipo_curso = inscricoes.tipo_curso', 'type' => 'left')
								);

	public function __construct(){
		parent::__construct();
		$this->load->helper("br_date_helper");
		check_login();
	}

	public function index($tipo = 'AB', $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Tipo de Curso
		$data['tipo'] = $tipo;
		$where = array('inscricoes.tipo_curso' => $data['tipo'], 'gerar_certificado' => 'N');

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, SUM(notas.nota) as nota, SUM(notas.valor) as valor, turmas.data_inicial as data_inicial, inscritos.nome as inscrito, cursos_abertos.titulo as titulo_AB, programas_alta_performance.titulo as titulo_AL, cursos_incompany.titulo as titulo_IN, programas_desenvolvimento.titulo as titulo_DE, elearning.titulo as titulo_EL '), $offset, $this->per_page, $where, $this->join, $this->table.'.id', 'DESC', 'inscricoes.id');

		//Parâmetros
		$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo']);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function liberar($id)
	{
		//Atualiza os dados
		$rows_affected = $this->default_model->update($this->table, $id, array('gerar_certificado' => 'S'));
		$inscricao = $this->default_model->get_by_id($this->table, $id);

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Liberado com sucesso.';
		else
			$msg = 'Não foi possível liberar o certificado.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller.'/index/'.$inscricao->tipo_curso);
	}

	private function _pagination($table, $search = FALSE, $tipo){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		$where = ($tipo ? array('inscricoes.tipo_curso' => $tipo) : NULL);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&tipo='.$tipo;
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$tipo;
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
		$data['tipo'] = $this->input->get('tipo');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, SUM(notas.nota) as nota, SUM(notas.valor) as valor, turmas.data_inicial as data_inicial, inscritos.nome as inscrito, cursos_abertos.titulo as titulo_AB, programas_alta_performance.titulo as titulo_AL, cursos_incompany.titulo as titulo_IN, programas_desenvolvimento.titulo as titulo_DE, elearning.titulo as titulo_EL '), array('inscricoes.tipo_curso' => $data['tipo'], 'gerar_certificado' => 'N'), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'DESC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['tipo']);

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