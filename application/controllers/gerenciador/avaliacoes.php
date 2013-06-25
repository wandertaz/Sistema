<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avaliacoes extends CI_Controller {

	var $titulo 		= 'Avaliações';
	var $dir 			= 'multitools/avaliacoes/';
	var $controller 	= 'multitools/avaliacoes';
	var $title_sing 	= 'Avaliação';
	var $per_page 		= 20;
	var $table 			= 'avaliacoes';
	var $join			= array('inscritos' => array('where' => 'inscritos.id = inscrito_id', 'type' => 'inner'), 'avaliacoes_perguntas' => array('where' => 'avaliacoes_perguntas.id = pergunta_id', 'type' => 'inner'));
	var $tipos_cursos   = array('AB' => 'Curso Aberto', 'IN' => 'Curso In Company', 'AL' => 'Programa de Alta Performance', 'DE'=> 'Programa de Desenvolvimento');
	var $tabelas_cursos   = array('AB' => 'cursos_abertos', 'IN' => 'cursos_incompany', 'AL' => 'programas_alta_performance', 'DE'=> 'programas_desenvolvimento', 'EL' => 'elearning');

	public function __construct(){
		parent::__construct();
		$this->load->helper("br_date_helper");
		check_login();
	}
        
        
        	public function index($tipo = 'AB',$curso_id=''){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Tipo de Curso
		$data['tipo'] = $tipo;
                $data['curso_id'] = $curso_id;
		$where = array('tipo_curso' => $data['tipo'],'curso_id'=>$curso_id);

		//Registros
                $offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome as inscrito, avaliacoes_perguntas.titulo as pergunta'), $offset, $this->per_page, $where, $this->join, $this->table.'.id', 'DESC');

		//Parâmetros
		$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo'],$curso_id);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'avaliadores', $data);
		get_footer(TRUE);
	}

         public function ver_avaliacao($tipo = 'AB',$curso_id='', $inscrito_id = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Tipo de Curso
		$data['tipo'] = $tipo;
		$where = array('tipo_curso' => $data['tipo'],'curso_id'=>$curso_id,'inscrito_id'=>$inscrito_id);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome as inscrito, avaliacoes_perguntas.titulo as pergunta'),null, $this->per_page, $where, $this->join, $this->table.'.id', 'DESC');

		//Parâmetros
		//$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo']);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'resultado', $data);
		get_footer(TRUE);
	}
        
        
        
        
        
        
        
        
        
        
        
        
     
        
        
	public function index2($tipo = 'AB', $offset = 0){

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
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome as inscrito, avaliacoes_perguntas.titulo as pergunta'), $offset, $this->per_page, $where, $this->join, $this->table.'.id', 'DESC');

		//Parâmetros
		$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo']);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

        public function ver($id){

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
		$data['cursos'] = array('' => 'Curso') + $this->default_model->listaAssociativa($this->tabelas_cursos[$data['tipo']], 'titulo');

		//Inscritos e Perguntas
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome');
		$data['perguntas'] = $this->default_model->listaAssociativa('avaliacoes_perguntas', 'titulo');

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

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

	private function _pagination($table, $search = FALSE, $tipo,$curso_id){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		$where = array('tipo_curso' => $tipo,'curso_id'=>$curso_id);
                
                $config['page_query_string'] = TRUE;
		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&tipo='.$tipo.'&curso_id='.$curso_id;
		}
		else{
                        $config['page_query_string'] = TRUE;
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$tipo.'/'.$curso_id.'?';
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
                $data['curso_id'] = $this->input->get('curso_id');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, inscritos.nome as inscrito, avaliacoes_perguntas.titulo as pergunta'), array('tipo_curso' => $data['tipo'],'curso_id'=>$data['curso_id']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['tipo'],$data['curso_id']);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'avaliadores', $data);
		get_footer(TRUE);
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */