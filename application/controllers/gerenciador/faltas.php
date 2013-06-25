<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faltas extends CI_Controller {

	var $titulo 		= 'Faltas';
	var $dir 			= 'multitools/faltas/';
	var $controller 	= 'multitools/faltas';
	var $title_sing 	= 'Falta';
	var $per_page 		= 20;
	var $table 			= 'faltas';
	var $join			= array('inscritos' => array('where' => 'inscritos.id = inscrito_id', 'type' => 'inner'));
	var $tipos_cursos   = array('AB' => 'Curso Aberto', 'IN' => 'Curso In Company', 'AL' => 'Programa de Alta Performance', 'DE'=> 'Programa de Desenvolvimento');

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
		$where = ($data['tipo'] ? array('tipo_curso' => $data['tipo']) : NULL);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome as inscrito'), $offset, $this->per_page, $where, $this->join, $this->table.'.id', 'DESC');

		//Parâmetros
		$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo']);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($tipo = ''){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Cursos
		$data['tipo'] = $tipo;
		$tabela_cursos = ($tipo == 'AB' ? 'cursos_abertos' : ($tipo == 'IN' ? 'cursos_incompany' : ($tipo == 'AL' ? 'programas_alta_performance' : 'programas_desenvolvimento')));
		$data['cursos'] = array('' => 'Curso') + $this->default_model->listaAssociativa($tabela_cursos, 'titulo');

		//Inscritos
		$data['inscritos'] = array('' => 'Selecione o Curso');

		if($tipo = 'AB'){
			$data['turmas'] = array('' => 'Selecione o Curso');
		}

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Cursos
		$data['tipo'] = $data['registro']->tipo_curso;
		$tabela_cursos = ($data['tipo'] == 'AB' ? 'cursos_abertos' : ($data['tipo'] == 'IN' ? 'cursos_incompany' : ($data['tipo'] == 'AL' ? 'programas_alta_performance' : 'programas_desenvolvimento')));
		$data['cursos'] = array('' => 'Curso') + $this->default_model->listaAssociativa($tabela_cursos, 'titulo');

		//Inscritos
		$join = array('inscricoes' => array('where' => 'inscritos.id = inscrito_id', 'type' => 'inner'));
		$where = $data['registro']->turma_id ? array('inscricoes.curso_id' => $data['registro']->curso_id, 'inscricoes.turma_id' => $data['registro']->turma_id, 'inscricoes.tipo_curso' => $data['tipo']) : array('inscricoes.curso_id' => $data['registro']->curso_id, 'inscricoes.tipo_curso' => $data['tipo']);
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome', $join, $where);

		if($tipo = 'AB'){
			$data['turmas'] = $this->default_model->listaAssociativa('turmas', 'data_inicial', array(), array('tipo_curso' => $data['tipo'] , 'curso_id' => $data['registro']->curso_id), 'data_inicial', 'ASC', true);
		}

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Trata as datas
		$data['data'] = w3c_date($_POST['data']);

		//Valida data do cursos aberto
		if($data['tipo_curso'] == 'AB'){
			$where = array('data_inicio <= ' => $data['data'], 'data_conclusao >= ' => $data['data'], 'id' => $data['curso_id']);
			$rows = $this->default_model->get_all('cursos_abertos', array('*'), 0, NULL, $where, NULL);
			if(!$rows){
				$msg = 'Verificar a data correta da falta!';
				$this->session->set_flashdata('msg', $msg);
				redirect($this->controller.'/index/'.$data['tipo_curso']);
			}
		}

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id'], $data);
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
		redirect($this->controller.'/index/'.$data['tipo_curso']);
	}

	public function excluir($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);
		$tipo = $data['registro']->tipo_curso;

		//Exclui registro
		if($this->default_model->delete($this->table, array('id'=>$id)))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');

		//Retorno
		redirect($this->controller.'/index/'.$tipo);
	}

	private function _pagination($table, $search = FALSE, $tipo){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		$where = ($tipo ? array('tipo_curso' => $tipo) : NULL);

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
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, inscritos.nome as inscrito'), array('tipo_curso' => $data['tipo']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['tipo']);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}


	/**
	 * retorna_inscritos_por_curso
	 *
	 * Retorna uma lista com os inscritos, de acordo com o curso
	 *
	 */
	public function retorna_inscritos_por_curso($tipo = false, $curso_id = false){

		//Valida curso
		if(!$tipo || !$curso_id){
			echo json_encode(array('' => 'Selecione o Curso'));
			exit;
		}

		//Busca cursos
		$join = array('inscricoes' => array('where' => 'inscritos.id = inscrito_id', 'type' => 'inner'));
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome', $join, array('inscricoes.curso_id' => $curso_id, 'inscricoes.tipo_curso' => $tipo));
		$data['inscritos'][''] = 'Selecione';

		//Retorna lista ao javascript
		echo json_encode($data['inscritos']);
	}

	/**
	 * retorna_inscritos_por_curso
	 *
	 * Retorna uma lista com os inscritos, de acordo com a turma
	 *
	 */
	public function retorna_inscritos_por_turma($tipo = false, $turma_id = false){

		//Valida curso
		if(!$tipo || !$turma_id){
			echo json_encode(array('' => 'Selecione a Turma'));
			exit;
		}

		//Busca cursos
		$join = array('inscricoes' => array('where' => 'inscritos.id = inscrito_id', 'type' => 'inner'));
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome', $join, array('inscricoes.turma_id' => $turma_id, 'inscricoes.tipo_curso' => $tipo));
		$data['inscritos'][''] = 'Selecione';

		//Retorna lista ao javascript
		echo json_encode($data['inscritos']);
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */