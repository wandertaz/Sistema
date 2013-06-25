<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arquivos extends CI_Controller {

	var $titulo 		= 'Arquivos';
	var $dir 			= 'multitools/arquivos/';
	var $controller 	= 'multitools/arquivos';
	var $title_sing 	= 'Arquivo';
	var $per_page 		= 20;
	var $table 			= 'arquivos';
	var $join			= array('aulas' => array('where' => 'aulas.id = aula_id', 'type' => 'inner'));
	var $tipos_cursos   = array('AB' => 'Curso Aberto', 'IN' => 'Curso In Company', 'AL' => 'Programa de Alta Performance', 'DE'=> 'Programa de Desenvolvimento');
	var $tabelas_cursos   = array('AB' => 'cursos_abertos', 'IN' => 'cursos_incompany', 'AL' => 'programas_alta_performance', 'DE'=> 'programas_desenvolvimento', 'EL' => 'elearning');

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
		$where = ($data['tipo'] ? array('aulas.tipo_curso' => $data['tipo']) : NULL);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*'), $offset, $this->per_page, $where, $this->join, $this->table.'.id', 'DESC');

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

		//Aulas
		$data['tipo'] = $tipo;
		$data['aulas'] = array('' => 'Aula') + $this->default_model->listaAssociativa('aulas', 'titulo', NULL, array('aulas.tipo_curso' => $data['tipo']));

		//Inscritos
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome');

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
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('arquivos.*, aulas.tipo_curso as tipo_curso'), NULL, $this->join);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Aulas
		$data['tipo'] = $data['registro']->tipo_curso;
		$data['aulas'] = array('' => 'Aula') + $this->default_model->listaAssociativa('aulas', 'titulo', NULL, array('aulas.tipo_curso' => $data['tipo']));

		//Inscritos
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome');

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;
		$tipo_curso = $data['tipo_curso'];
		unset($data['tipo_curso']);

		//Library de Upload
		$config['upload_path']   = './assets/uploads/';
		$config['allowed_types'] = 'jpeg|jpg|gif|png|doc|pdf|zip';
		$this->load->library('upload', $config);

		//Upload da imagem
		if(!empty($_FILES['arquivo']['name'])){
			if($this->upload->do_upload('arquivo')){

				if(isset($data["id"]) && $data["id"]){
					$registro = $this->default_model->get_by_id($this->table, $data["id"]);
					@unlink('./assets/uploads/'.$registro->arquivo);
				}
				$data_file      = $this->upload->data();
				$data['arquivo'] = $data_file['file_name'];
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());
				redirect($this->controller);
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
		redirect($this->controller.'/index/'.$tipo_curso);
	}

	public function excluir($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, $this->join);
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
			$config['uri_segment'] = 4;
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
		$data_busca['arquivos.titulo']  = $this->input->get('s');
		$data['tipo'] = $this->input->get('tipo');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*'), array('tipo_curso' => $data['tipo']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'ASC');
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