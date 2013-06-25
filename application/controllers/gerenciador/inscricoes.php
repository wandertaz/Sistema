<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscricoes extends CI_Controller {

	var $titulo 		= '- Compras/Inscrições';
	var $dir 			= 'multitools/inscricoes/';
	var $controller 	= 'multitools/inscricoes';
	var $title_sing 	= '- Compra/Inscrição';
	var $per_page 		= 20;
	var $table 			= 'inscricoes';
	var $join			= array('turmas' => array('where' => 'turmas.id = turma_id', 'type' => 'inner'),
								'inscritos' => array('where' => 'inscritos.id = inscrito_id', 'type' => 'inner'),
								'cursos_abertos' => array('where' => 'cursos_abertos.id = turmas.curso_id', 'type' => 'left'),
								'programas_alta_performance' => array('where' => 'programas_alta_performance.id = turmas.curso_id', 'type' => 'left'),

								);

	var $tipos_cursos   = array('AB' => 'Curso Aberto', 'AL' => 'Programa de Alta Performance');
	var $status   	    = array('AN' => 'Em análise', 'AP' => 'Aprovado', 'CA' => 'Cancelado', 'AG' => 'Aguardando Pagamento');

	public function __construct(){
		parent::__construct();
		$this->load->helper("br_date_helper");
		check_login();
	}

	public function index($tipo = 'AB', $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo.' - '.$this->tipos_cursos[$tipo];

		//Menu
		get_menu();

		//Tipo de Curso
		$data['tipo'] = $tipo;
		$where = ($data['tipo'] ? array('inscricoes.tipo_curso' => $data['tipo']) : NULL);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, turmas.data_inicial as data_inicial, inscritos.nome as inscrito, cursos_abertos.titulo as titulo_aberto, programas_alta_performance.titulo as titulo_programa  '), $offset, $this->per_page, $where, $this->join, $this->table.'.id', 'DESC');

		//Parâmetros
		$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo']);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing.' - '.$this->tipos_cursos[$tipo];

		//Status
		$data['status'] = $this->status;

		//Cursos
		$tabela_cursos = ($tipo == 'AB' ? 'cursos_abertos' : 'programas_alta_performance');
		$data['cursos'] = $this->default_model->listaAssociativa($tabela_cursos, 'titulo');
		$data['cursos'][''] = 'Filtrar por curso';

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($tipo = ''){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing.' - '.$this->tipos_cursos[$tipo];

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Cursos
		$data['tipo'] = $tipo;
		$tabela_cursos = ($tipo == 'AB' ? 'cursos_abertos' : 'programas_alta_performance');
		$data['cursos'] = $this->default_model->listaAssociativa($tabela_cursos, 'titulo');

		//Turmas
		$data['turmas'] = array('' => 'Selecione o Curso');

/*
$data['turmas'][''] = '--Selecione--';
		foreach($data['cursos'] as $id_curso => $curso){
			$turmas = $this->default_model->get_all('turmas', array('*'), 0, NULL, array('tipo_curso' => $tipo, 'curso_id' => $id_curso), NULL, 'data_inicial', 'ASC');
			foreach($turmas as $turma)
				$data['turmas'][$turma->id] = $curso.' - '.br_date($turma->data_inicial);
		}
*/
   
		//Inscritos               
		//$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome');
               //$data['inscritos']= $this->default_model->get_all('inscritos', array('inscritos'.'.*'), null,null, array('id'=>$tipo), null, null, null);

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
		

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Cursos
		$data['tipo'] = $data['registro']->tipo_curso;
		$tabela_cursos = ($data['tipo']  == 'AB' ? 'cursos_abertos' : 'programas_alta_performance');
		$data['cursos'] = $this->default_model->listaAssociativa($tabela_cursos, 'titulo');
		$data['turmas'] = $this->default_model->listaAssociativa('turmas', 'data_inicial', array(), array('tipo_curso' => $data['tipo'] , 'curso_id' => $data['registro']->curso_id), 'data_inicial', 'ASC', true);
                
                $data['h1'] = 'Editar '.$this->title_sing.' - '.$this->tipos_cursos[$data['tipo']];
		//Turmas

/*
foreach($data['cursos'] as $id_curso => $curso){
			$turmas = $this->default_model->get_all('turmas', array('*'), 0, NULL, array('tipo_curso' => $data['tipo'] , 'curso_id' => $id_curso), NULL, 'data_inicial', 'ASC');
			foreach($turmas as $turma)
				$data['turmas'][$turma->id] = $curso.' - '.br_date($turma->data_inicial);
		}
*/
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

	private function _pagination($table, $search = FALSE, $tipo, $curso = false){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		$where = ($tipo ? array('inscricoes.tipo_curso' => $tipo) : NULL);
		if($curso)
			$where += array('inscricoes.curso_id' => $curso);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&tipo='.$tipo.'&curso_id='.$curso;
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
                
                
                //Parâmetros de busca
		$data_busca['inscritos.nome']  = $this->input->get('s');
		$data['tipo'] = $this->input->get('tipo');
                
                if($this->input->get('curso_id')>0){
                    $data['curso_id'] = $this->input->get('curso_id'); 
                    $where=array('inscricoes.tipo_curso' => $data['tipo'] , 'inscricoes.curso_id' => $data['curso_id']);
                }else{
                    
                    $where=array('inscricoes.tipo_curso' => $data['tipo']);
                    $data['curso_id']='';
                }
                   
                
		$data['h1'] = $this->titulo.' - '.$data['tipo'];

                
                
                
                
		//Menu
		get_menu();



		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, turmas.data_inicial as data_inicial, inscritos.nome as inscrito, cursos_abertos.titulo as titulo_aberto, programas_alta_performance.titulo as titulo_programa  '), $where, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['tipo'], $data['curso_id']);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Status
		$data['status'] = $this->status;

		//Cursos
		$tabela_cursos = ($data['tipo'] == 'AB' ? 'cursos_abertos' : 'programas_alta_performance');
		$data['cursos'] = $this->default_model->listaAssociativa($tabela_cursos, 'titulo');
		$data['cursos'][''] = 'Filtrar por curso';

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	/**
	 * retorna_turmas_por_curso
	 *
	 * Retorna uma lista com as turmas, de acordo com o curso
	 *
	 */
	public function retorna_turmas_por_curso($tipo = false, $curso_id = false){

		//Valida curso
		if(!$curso_id || !$tipo){
			echo json_encode(array('' => 'Selecione o Curso'));
			exit;
		}

		//Busca cursos
		$data['turmas'] = $this->default_model->listaAssociativa('turmas', 'data_inicial', array(), array('curso_id' => $curso_id, 'tipo_curso' => $tipo), 'data_inicial', 'ASC', true);
		$data['turmas'][''] = 'Selecione';

		//Retorna lista ao javascript
		echo json_encode($data['turmas']);
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */