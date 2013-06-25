<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mensagens extends CI_Controller {

	var $titulo 		= 'Mensagens';
	var $dir 			= 'multitools/mensagens/';
	var $controller 	= 'multitools/mensagens';
	var $title_sing 	= 'Mensagem';
	var $per_page 		= 20;
	var $table 			= 'mensagens';
	var $join			= array('mensagens_destinatarios' => array('where' => 'mensagens.id = mensagens_destinatarios.mensagem_id', 'type' => 'inner'));
	var $tipos_cursos   = array('AB' => 'Curso Aberto', 'IN' => 'Curso In Company', 'AL' => 'Programa de Alta Performance', 'DE'=> 'Programa de Desenvolvimento');
	var $tabelas_cursos = array('AB' => 'cursos_abertos', 'IN' => 'cursos_incompany', 'AL' => 'programas_alta_performance', 'DE'=> 'programas_desenvolvimento', 'EL' => 'elearning');

	public function __construct(){
		parent::__construct();
		$this->load->helper("br_date_helper");
		check_login();
	}

	public function index($tipo = 'EL', $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Tipo de Curso
		$data['tipo'] = $tipo;
		$usuario_id = $this->session->userdata('id');
		$where = 'tipo_curso = "'.$data['tipo'].'" AND mensagens_destinatarios.data_desativacao IS NULL AND mensagens_destinatarios.destinatario_id = "'.$usuario_id.'" AND mensagens_destinatarios.tipo_destinatario = "I"';

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, mensagens_destinatarios.lido as lido'), $offset, $this->per_page, $where, $this->join, array('mensagens_destinatarios.lido' => 'ASC', 'created' => 'DESC'));

		//Parâmetros
		$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo']);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($tipo = 'EL'){

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
		$usuario_id = $this->session->userdata('id');
		$data['cursos'] = array('' => 'Curso') + $this->default_model->listaAssociativa($this->tabelas_cursos[$data['tipo']], 'titulo', NULL, array('instrutor_id' => $usuario_id));

		//Carrega view
		$this->load->view($this->dir.'form_curso', $data);
		get_footer(TRUE);
	}

	public function adicionar_mensagem(){

		//Validação
		if(!isset($_POST['tipo_curso']) || !isset($_POST['curso_id']))
			return $this->adicionar('EL');

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
		$data['tipo']     = $_POST['tipo_curso'];
		$data['curso_id'] = $_POST['curso_id'];

		//Destinatários
		$join = array('inscricoes' => array('where' => 'inscritos.id = inscrito_id', 'type' => 'inner'));
		$data['destinatarios'] = $this->default_model->listaAssociativa('inscritos', 'nome', $join, array('inscricoes.curso_id' => $data['curso_id'], 'inscricoes.tipo_curso' => $data['tipo']));
		unset($data['destinatarios']['']);

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;
		$destinatarios = $data['destinatarios'];
		unset($data['destinatarios']);

		//Salva so dados
		$data['created'] = date('Y-m-d H:i:s');
		$rows_affected = $this->default_model->insert($this->table, $data);
		$mensagem_id = $this->db->insert_id();

		//Salva os destinatários
		$this->default_model->insert('mensagens_destinatarios', array('destinatario_id' => $data['remetente_id'], 'tipo_destinatario' => 'I', 'mensagem_id' => $mensagem_id, 'lido' => 'N'));
		foreach($destinatarios as $destinatario)
			$this->default_model->insert('mensagens_destinatarios', array('destinatario_id' => $destinatario, 'tipo_destinatario' => 'A', 'mensagem_id' => $mensagem_id, 'lido' => 'N'));

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados enviados com sucesso.';
		else
			$msg = 'Não foi possível enviar.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller.'/index/'.$data['tipo_curso']);
	}

	public function ver($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Visualizar '.$this->title_sing;

		//Menu
		get_menu();

		//Busca registro
		$join = array('inscritos' => array('where' => 'inscritos.id = remetente_id', 'type' => 'left'),'usuario' => array('where' => 'usuario.id = remetente_id AND usuario.tipo = "I"', 'type' => 'left'));
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('mensagens.*, inscritos.nome as inscrito, usuario.nome as instrutor '), NULL, $join);

		//Busca respostas
		$join = array('inscritos' => array('where' => 'inscritos.id = remetente_id', 'type' => 'left'),'usuario' => array('where' => 'usuario.id = remetente_id AND usuario.tipo = "I"', 'type' => 'left'));
		$data['respostas'] = $this->default_model->get_all('mensagem_resposta', array('mensagem_resposta.*, inscritos.nome as inscrito, usuario.nome as instrutor'), 0, NULL, array('id_mensagem' => $id), $join, 'created', 'ASC');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Cursos
		$data['tipo'] = $data['registro']->tipo_curso;
		$data['curso'] = $this->default_model->get_by_id($this->tabelas_cursos[$data['tipo']], $data['registro']->curso_id);

		//Salva como lido
		$this->default_model->update_where('mensagens_destinatarios', array('lido' => 'S'), array('mensagem_id' => $data['registro']->id, 'destinatario_id' => $this->session->userdata('id'), 'tipo_destinatario' => 'I'));

		//Carrega view
		$this->load->view($this->dir.'ver', $data);
		get_footer(TRUE);
	}

	public function responder()
	{
		//Recebe Post
		$data = $_POST;
		$tipo_curso = $data['tipo_curso'];
		unset($data['tipo_curso']);

		//Salva so dados
		$data['created'] = date('Y-m-d H:i:s');
		$rows_affected = $this->default_model->insert('mensagem_resposta', $data);

		//Atualiza destinatários
		$this->default_model->update_where('mensagens_destinatarios', array('lido' => 'N', 'data_desativacao' => null), array('mensagem_id' => $data['id_mensagem']));

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados enviados com sucesso.';
		else
			$msg = 'Não foi possível enviar.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller.'/index/'.$tipo_curso);
	}


	public function excluir($id){

		//Registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);

		//Salva data de desativação
		$this->default_model->update_where('mensagens_destinatarios', array('data_desativacao' => date('Y-m-d H:i:s')), array('mensagem_id' => $data['registro']->id, 'destinatario_id' => $this->session->userdata('id'), 'tipo_destinatario' => 'I'));

		//Retorno
		$tipo = $data['registro']->tipo_curso;
		$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
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
		$data_busca['mensagens.assunto']  = $this->input->get('s');
		$data['tipo'] = $this->input->get('tipo');

		//where
		$usuario_id = $this->session->userdata('id');
		$where = 'tipo_curso = "'.$data['tipo'].'" AND mensagens_destinatarios.data_desativacao IS NULL AND mensagens_destinatarios.destinatario_id = "'.$usuario_id.'" AND mensagens_destinatarios.tipo_destinatario = "I"';

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*'), $where, $offset, $this->per_page, $data_busca, $this->join, 'mensagens_destinatarios.lido', 'ASC');
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