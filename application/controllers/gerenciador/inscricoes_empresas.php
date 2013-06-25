<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscricoes_empresas extends CI_Controller {

	var $titulo 		= 'Compras/Inscrições';
	var $dir 			= 'multitools/inscricoes_empresas/';
	var $controller 	= 'multitools/inscricoes_empresas';
	var $title_sing 	= '- Compra/Inscrição';
	var $per_page 		= 20;
	var $table 			= 'inscricoes';
	var $join			= array('inscritos' => array('where' => 'inscritos.id = inscrito_id', 'type' => 'inner'),
								'cursos_incompany' => array('where' => 'cursos_incompany.id = inscricoes.curso_id', 'type' => 'left'),
								'programas_desenvolvimento' => array('where' => 'programas_desenvolvimento.id = inscricoes.curso_id', 'type' => 'left'),
								'elearning' => array('where' => 'elearning.id = inscricoes.curso_id', 'type' => 'left')
								);

	var $tipos_cursos   = array('IN' => 'Curso In Company', 'DE' => 'Programa de Desenvolvimento', 'EL' => 'E-learning');
	var $status   	    = array('AG' => 'Aguardando Pagamento', 'AP' => 'Aprovado', 'RE' => 'Reprovado', 'CA' => 'Cancelado');

	public function __construct(){
		parent::__construct();
		$this->load->helper("br_date_helper");
		check_login();
	}

	public function index($tipo = 'IN', $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo.' - '.$this->tipos_cursos[$tipo];
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo.' - '.$this->tipos_cursos[$tipo];

		//Menu
		get_menu();

		//Tipo de Curso
		$data['tipo'] = $tipo;
		$where = ($data['tipo'] ? array('inscricoes.tipo_curso' => $data['tipo']) : NULL);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome as inscrito, cursos_incompany.titulo as titulo_curso, programas_desenvolvimento.titulo as titulo_programa, elearning.titulo as titulo_elearning  '), $offset, $this->per_page, $where, $this->join, $this->table.'.id', 'DESC');

		//Parâmetros
		$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo']);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing.' - '.$this->tipos_cursos[$tipo];

		//Status
		$data['status'] = $this->status;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($tipo = ''){

		//Cabeçalho
		$titulo = $this->titulo.' - '.$this->tipos_cursos[$tipo];
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing.' - '.$this->tipos_cursos[$tipo];

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Cursos
		$data['tipo'] = $tipo;
		$tabela_cursos = ($tipo == 'IN' ? 'cursos_incompany' : ($tipo =='EL' ? 'elearning' : 'programas_desenvolvimento'));
		$data['cursos'] = $this->default_model->listaAssociativa($tabela_cursos, 'titulo');

		//Inscritos
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome');

		//Status
		$data['status'] = $this->status;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing.' - '.$this->tipos_cursos[$tipo];

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Cursos
		$data['tipo'] = $data['registro']->tipo_curso;
		$tabela_cursos = ($data['tipo'] == 'IN' ? 'cursos_incompany' : ($data['tipo'] =='EL' ? 'elearning' : 'programas_desenvolvimento'));
		$data['cursos'] = $this->default_model->listaAssociativa($tabela_cursos, 'titulo');

		//Inscritos
		//$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome');
                
                $id_inscrito= count($data['registro'])>0 ? $data['registro']->inscrito_id : '';
                $data['inscritos']= $this->default_model->get_all('inscritos', array('inscritos'.'.*'), null,null, array('id'=>$id_inscrito), null, null, null);
                

		//Status
		$data['status'] = $this->status;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;
                unset($data['inscrito_nome']);

		//Trata as datas
		$data['data_aquisicao'] = w3c_date($_POST['data_aquisicao']);
		$data['data_conclusao'] = w3c_date($_POST['data_conclusao']);

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id'], $data);
		else{
			$data['created']  = date('Y-m-d H:i:s');
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
		$data['h1'] = $this->titulo.' - '.$this->tipos_cursos[$tipo];

		//Menu
		get_menu();

		//Parâmetros de busca
		$data_busca['inscritos.nome']  = $this->input->get('s');
		$data['tipo'] = $this->input->get('tipo');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, inscritos.nome as inscrito, cursos_incompany.titulo as titulo_curso, programas_desenvolvimento.titulo as titulo_programa, elearning.titulo as titulo_elearning  '), array('tipo_curso' => $data['tipo']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'DESC');
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