<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class educacao_corporativa extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	var $per_page = 4;

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
                $this->load->helper('auxiliar_helper');
	}

	public function index(){

		//Título
		$data['title'] = 'Cursos Abertos';
		$data['url_pagina'] = 'educacao-corporativa';

		//Carrega view
		$this->loadView('educacao_corporativa', $data);
	}


	public function cursos_abertos($offset = 0){




		//Título
      	$data['title'] = 'Cursos Abertos';
		$data['url_pagina'] = 'cursos-abertos';
                
               

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Verifica se existe busca
		$busca = $this->input->get('busca');

		//Cursos
		if($busca){
			$offset = $this->input->get('per_page');
			//$data['cursos'] = $this->default_model->get_by_search('cursos_abertos', array('*'), $where + array('ativo' => 'S'), $offset, $this->per_page, array('titulo' => $busca, 'descricao' => $busca), NULL, 'data_inicio', 'asc');
			$data['cursos'] = ordena_cursos_disponibilidade('cursos_abertos', $offset, $this->per_page, $where + array('ativo' => 'S'), 'data_inicio', 'ASC', array('titulo' => $busca, 'descricao' => $busca));
			$data['paginacao'] = $this->_pagination('cursos_abertos', $busca, '/educacao_corporativa/cursos_abertos?busca='.$busca);
		}
		else{
			//$data['cursos'] = $this->default_model->get_all('cursos_abertos', $campos = array('*'), $offset, $this->per_page, $where + array('ativo' => 'S'), $join = NULL, $order_by = 'data_inicio', $dir = 'asc');
			$data['cursos'] = ordena_cursos_disponibilidade('cursos_abertos', $offset, $this->per_page, $where + array('ativo' => 'S'), 'data_inicio', 'ASC', false);
			$data['paginacao'] = $this->_pagination('cursos_abertos', false, '/educacao_corporativa/cursos_abertos');
		}

		//Lateral: Banner (cursos) e Depoimentos
		$data['banner_lateral'] = $this->default_model->get_all('banners', array('*'),  NULL, 1, $where + array('tipo' => 'L', 'ativo' => 'S'), NULL, 'id', 'DESC');
		$data['depoimentos'] = $this->default_model->get_all('depoimentos', array('*'),  NULL, 2, array('ativo' => 'S', 'tipo' => 'AB'), NULL, 'id', 'DESC');

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'cursos-in-company' OR url = 'programas-de-desenvolvimento' OR url = 'programa-alta-performance'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'id', 'ASC');

		//Busca banner publicitário (depoimento)
		$data['banner_depoimento'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = 1, $where + array('tipo' => 'D', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');

		//Carrega view
		$this->loadView('cursos-abertos', $data);
	}

	public function ver_curso_aberto($id){

		//Título
		$data['title'] = 'Cursos Abertos';
		$data['url_pagina'] = 'cursos-abertos';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Curso
		$data['curso'] = $this->default_model->get_by_id('cursos_abertos', $id, array('*'), $where);

		//Turmas
		$data['turmas'] = $this->default_model->get_all('turmas', array('*'),0, NULL, array('curso_id' => $id, 'tipo_curso' => 'AB', 'data_limite >= ' => date('Y-m-d')), NULL, 'data_inicial', 'ASC');

		//Lateral: Banner (cursos) e Depoimentos
		$data['banner_lateral'] = $this->default_model->get_all('banners', array('*'),  NULL, 1, $where + array('tipo' => 'L', 'ativo' => 'S'), NULL, 'id', 'DESC');
		$data['depoimentos'] = $this->default_model->get_all('depoimentos', array('*'),  NULL, 2, array('ativo' => 'S', 'tipo' => 'AB'), NULL, 'id', 'DESC');

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'cursos-in-company' OR url = 'programas-de-desenvolvimento' OR url = 'programa-alta-performance'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'id', 'ASC');

		//Busca banner publicitário (depoimento)
		$data['banner_depoimento'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = 1, $where + array('tipo' => 'D', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');

		//Carrega view
		$this->loadView('cursos-aberto-detalhe', $data);
	}

   	public function cursos_incompany($offset = 0){

   		//Título
   		$data['title'] = 'Cursos In Company';
   		$data['url_pagina'] = 'cursos-in-company';

   		//Define where com id do idioma
   		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

   		//Verifica se existe busca
   		$busca = $this->input->get('busca');

   		//Cursos
   		if($busca){
   			$offset = $this->input->get('per_page');
   			$data['cursos'] = $this->default_model->get_by_search('cursos_incompany', array('*'), $where + array('ativo' => 'S'), $offset, $this->per_page, array('titulo' => $busca, 'descricao' => $busca), NULL, 'data_inicio', 'asc');
   			$data['paginacao'] = $this->_pagination('cursos_incompany', $busca, '/educacao_corporativa/cursos_incompany?busca='.$busca);
   		}
   		else{
   			$data['cursos'] = $this->default_model->get_all('cursos_incompany', $campos = array('*'), $offset, $this->per_page, $where + array('ativo' => 'S'), $join = NULL, $order_by = 'data_inicio', $dir = 'asc');
   			$data['paginacao'] = $this->_pagination('cursos_incompany', false, '/educacao_corporativa/cursos_incompany');
   		}

   		//Lateral: Banner (cursos) e Depoimentos
   		$data['banner_lateral'] = $this->default_model->get_all('banners', array('*'),  NULL, 1, $where + array('tipo' => 'L', 'ativo' => 'S'), NULL, 'id', 'DESC');
   		$data['depoimentos'] = $this->default_model->get_all('depoimentos', array('*'),  NULL, 2, array('ativo' => 'S', 'tipo' => 'IN'), NULL, 'id', 'DESC');

   		//Box blog e multimidia
   		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
   		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

   		//Veja também- páginas de cursos
   		$where_cursos = "url = 'cursos-abertos' OR url = 'programas-de-desenvolvimento' OR url = 'programa-alta-performance'";
   		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'id', 'ASC');

   		//Busca banner publicitário (depoimento)
   		$data['banner_depoimento'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = 1, $where + array('tipo' => 'D', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');

   		//Carrega view
   		$this->loadView('cursos-in-company', $data);
	}

	public function ver_curso_incompany($id){

		//Título
		$data['title'] = 'Cursos In Company';
		$data['url_pagina'] = 'cursos-in-company';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Curso
		$data['curso'] = $this->default_model->get_by_id('cursos_incompany', $id, array('*'), $where);

		//Lateral: Banner (cursos) e Depoimentos
		$data['banner_lateral'] = $this->default_model->get_all('banners', array('*'),  NULL, 1, $where + array('tipo' => 'L', 'ativo' => 'S'), NULL, 'id', 'DESC');
		$data['depoimentos'] = $this->default_model->get_all('depoimentos', array('*'),  NULL, 2, array('ativo' => 'S', 'tipo' => 'IN'), NULL, 'id', 'DESC');

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'cursos-abertos' OR url = 'programas-de-desenvolvimento' OR url = 'programa-alta-performance'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'id', 'ASC');

		//Busca banner publicitário (depoimento)
		$data['banner_depoimento'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = 1, $where + array('tipo' => 'D', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');

		//Carrega view
		$this->loadView('cursos-incompany-detalhe', $data);
	}

  	public function programas_desenvolvimento($offset = 0){

  		//Título
  		$data['title'] = 'Programas de Desenvolvimento e Universidade Corporativa';
  		$data['url_pagina'] = 'programas-de-desenvolvimento';

  		//Define where com id do idioma
  		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

  		//Verifica se existe busca
  		$busca = $this->input->get('busca');

  		//Cursos
  		if($busca){
  			$offset = $this->input->get('per_page');
  			$data['cursos'] = $this->default_model->get_by_search('programas_desenvolvimento', array('*'), $where + array('ativo' => 'S'), $offset, $this->per_page, array('titulo' => $busca, 'descricao' => $busca), NULL, 'data_inicio', 'asc');
  			$data['paginacao'] = $this->_pagination('programas_desenvolvimento', $busca, '/educacao_corporativa/programas_desenvolvimento?busca='.$busca);
  		}
  		else{
  			$data['cursos'] = $this->default_model->get_all('programas_desenvolvimento', $campos = array('*'), $offset, $this->per_page, $where + array('ativo' => 'S'), $join = NULL, $order_by = 'data_inicio', $dir = 'asc');
  			$data['paginacao'] = $this->_pagination('programas_desenvolvimento', false, '/educacao_corporativa/programas_desenvolvimento');
  		}

  		//Lateral: Banner (cursos) e Depoimentos
  		$data['banner_lateral'] = $this->default_model->get_all('banners', array('*'),  NULL, 1, $where + array('tipo' => 'L', 'ativo' => 'S'), NULL, 'id', 'DESC');
  		$data['depoimentos'] = $this->default_model->get_all('depoimentos', array('*'),  NULL, 2, array('ativo' => 'S', 'tipo' => 'DE'), NULL, 'id', 'DESC');

  		//Box blog e multimidia
  		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
  		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

  		//Veja também- páginas de cursos
  		$where_cursos = "url = 'cursos-abertos' OR url = 'cursos-in-company' OR url = 'programa-alta-performance'";
  		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'id', 'ASC');

  		//Busca banner publicitário (depoimento)
  		$data['banner_depoimento'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = 1, $where + array('tipo' => 'D', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');

  		//Carrega view
  		$this->loadView('programa-desenvolvimento', $data);
	}

	public function ver_programa_desenvolvimento($id){

		//Título
		$data['title'] = 'Programas de Desenvolvimento e Universidade Corporativa';
		$data['url_pagina'] = 'programas-de-desenvolvimento';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Curso
		$data['curso'] = $this->default_model->get_by_id('programas_desenvolvimento', $id, array('*'), $where);

		//Lateral: Banner (cursos) e Depoimentos
		$data['banner_lateral'] = $this->default_model->get_all('banners', array('*'),  NULL, 1, $where + array('tipo' => 'L', 'ativo' => 'S'), NULL, 'id', 'DESC');
		$data['depoimentos'] = $this->default_model->get_all('depoimentos', array('*'),  NULL, 2, array('ativo' => 'S', 'tipo' => 'DE'), NULL, 'id', 'DESC');

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'cursos-abertos' OR url = 'cursos-in-company' OR url = 'programa-alta-performance'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'id', 'ASC');

		//Busca banner publicitário (depoimento)
		$data['banner_depoimento'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = 1, $where + array('tipo' => 'D', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');

		//Carrega view
		$this->loadView('programa-desenvolvimento-detalhe', $data);
	}

	public function alta_performance($offset = 0){

		//Título
		$data['title'] = 'Programa de Alta Performance';
		$data['url_pagina'] = 'programa-alta-performance';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Verifica se existe busca
		$busca = $this->input->get('busca');

		//Cursos
		$data['cursos'] = $this->default_model->get_all('programas_alta_performance', $campos = array('*'), $offset, $this->per_page, $where + array('ativo' => 'S'), $join = NULL, $order_by = 'data_inicio', $dir = 'asc');
		$data['paginacao'] = $this->_pagination('programas_alta_performance', false, '/educacao_corporativa/alta_performance');

		//Lateral
		$data['banner_lateral'] = $this->default_model->get_all('banners', array('*'),  NULL, 1, $where + array('tipo' => 'L', 'ativo' => 'S'), NULL, 'id', 'DESC');
		$data['video_lateral'] = $this->default_model->get_all('videos', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['galerias_lateral'] = $this->default_model->get_all('galerias', array('*'),  NULL, 2, NULL, NULL, 'data', 'DESC');
		$data['depoimentos'] = $this->default_model->get_all('depoimentos', array('*'),  NULL, 2, array('ativo' => 'S', 'tipo' => 'AL'), NULL, 'id', 'DESC');

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'cursos-abertos' OR url = 'cursos-in-company' OR url = 'programas-de-desenvolvimento'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'id', 'ASC');

		//Carrega view
		$this->loadView('programa-alta-performance', $data);
	}

	public function ver_alta_performance($id){

		//Título
		$data['title'] = 'Programa de Alta Performance';
		$data['url_pagina'] = 'programa-alta-performance';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Curso
		$data['curso'] = $this->default_model->get_by_id('programas_alta_performance', $id, array('*'), $where);

		//Turmas
		$data['turmas'] = $this->default_model->get_all('turmas', array('*'),0, NULL, array('curso_id' => $id, 'tipo_curso' => 'AL', 'data_limite >= ' => date('Y-m-d')), NULL, 'data_inicial', 'ASC');

		//Lateral
		$data['banner_lateral'] = $this->default_model->get_all('banners', array('*'),  NULL, 1, $where + array('tipo' => 'L', 'ativo' => 'S'), NULL, 'id', 'DESC');
		$data['video_lateral'] = $this->default_model->get_all('videos', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['galerias_lateral'] = $this->default_model->get_all('galerias', array('*'),  NULL, 2, NULL, NULL, 'data', 'DESC');
		$data['depoimentos'] = $this->default_model->get_all('depoimentos', array('*'),  NULL, 2, array('ativo' => 'S', 'tipo' => 'AL'), NULL, 'id', 'DESC');

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'cursos-abertos' OR url = 'cursos-in-company' OR url = 'programas-de-desenvolvimento'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'id', 'ASC');

		//Carrega view
		$this->loadView('programa-alta-performance-detalhe', $data);
	}

	public function elearning($offset = 0){

		//Título
		$data['title'] = 'E-learning';
		$data['url_pagina'] = 'e-learning';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Verifica se existe busca
		$busca = $this->input->get('busca');

		//Cursos
		if($busca){
			$offset = $this->input->get('per_page');
			$data['cursos'] = $this->default_model->get_by_search('elearning', array('*'), $where + array('ativo' => 'S'), $offset, $this->per_page, array('titulo' => $busca, 'descricao' => $busca), NULL, 'id', 'DESC');
			$data['paginacao'] = $this->_pagination('elearning', $busca, '/educacao_corporativa/elearning?busca='.$busca);
		}
		else{
			$data['cursos'] = $this->default_model->get_all('elearning', $campos = array('*'), $offset, $this->per_page, $where + array('ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');
			$data['paginacao'] = $this->_pagination('elearning', false, '/educacao_corporativa/elearning');
		}

		//Veja também- páginas de cursos
		$where_cursos = "url = 'cursos-abertos' OR url = 'cursos-in-company' OR url = 'programas-de-desenvolvimento' OR url = 'programa-alta-performance'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'id', 'ASC');

		//Carrega view
		$this->loadView('elearning', $data);
	}

	public function ver_elearning($id){

		//Título
		$data['title'] = 'E-learning';
		$data['url_pagina'] = 'e-learning';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Curso
		$data['curso'] = $this->default_model->get_by_id('elearning', $id, array('*'), $where);

		//Lateral: Banner (cursos) e Depoimentos
		$data['banner_lateral'] = $this->default_model->get_all('banners', array('*'),  NULL, 1, $where + array('tipo' => 'L', 'ativo' => 'S'), NULL, 'id', 'DESC');
		$data['depoimentos'] = $this->default_model->get_all('depoimentos', array('*'),  NULL, 2, array('ativo' => 'S', 'tipo' => 'AB'), NULL, 'id', 'DESC');

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'cursos-abertos' OR url = 'cursos-in-company' OR url = 'programas-de-desenvolvimento' OR url = 'programa-alta-performance'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'id', 'ASC');

		//Busca banner publicitário (depoimento)
		$data['banner_depoimento'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = 1, $where + array('tipo' => 'D', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');

		//Carrega view
		$this->loadView('elearning-aberto', $data);
	}

	public function salvar_email(){

		//Título
		$data['title'] = 'Educação Corporativa';

		//dados do post
		$nome = $this->input->post('nome');
		$email = $this->input->post('email');

		//Insere voto
		$this->default_model->insert('emails_news', array('nome' => $nome, 'email' => $email));

		//Retorno
		$this->session->set_flashdata('msg', '<script>alert("Registrado com sucesso!");</script>');
		redirect(site_url().'educacao_corporativa/cursos_abertos');
	}

	private function _pagination($table, $search = FALSE, $url){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = '';
		$config['first_link'] = '';

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($table, array('titulo' => $search, 'descricao' => $search), array(), NULL);
			$config['base_url']          = site_url().$url;
		}
		else{
			$config['uri_segment'] = 3;
			$config['total_rows']  = $this->default_model->count($table, array(), NULL);
			$config['base_url']    = site_url().$url;
		}

		//Inicializa e retorna paginação
		$this->pagination->initialize($config);
		return $this->pagination->create_links();

	}

	public function solicitar_proposta($tipo_curso, $curso_id){

		//Dados
		$data['curso'] = $this->default_model->get_by_id($tipo_curso == 'IN' ? 'cursos_incompany' : 'programas_desenvolvimento', $curso_id);
		$data['tipo_curso'] = $tipo_curso;
		$data['id_curso'] = $curso_id;

		//Carrega view
		$this->loadView('contato-cursos-in-company', $data);

	}

	public function enviar_solicitacao(){

		//Conteúdo
		$data['post'] = $_POST;
		$conteudo = $this->load->view('includes/email_solicitacao_proposta', $data, true);

               /* print_r($conteudo);
                exit();*/

		//carrega library de email
		$this->load->library('email');
		$config['protocol'] = 'mail';
		$config['mailtype'] = 'html';

		//Parâmetros
		$this->email->initialize($config);
		$this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
		//$this->email->to('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
		$this->email->to('adriana@netmb.com.br', 'MB CONSULTORIA');
		$this->email->reply_to($data['post']['email']);
		$this->email->cc(array('matheus@multiwebdigital.com.br'));
		$this->email->subject('MB CONSULTORIA - SOLICITAÇÃO DE PROPOSTA');
		$this->email->message($conteudo);
		if($this->email->send())
			$data['mensagem'] = 'Sua solicita&ccedil;&atilde;o foi encaminhada para nossa &aacute;rea comercial. Entraremos em contato em breve.';
		else
			$data['mensagem'] = 'Não foi possível enviar solicitação. Tente novamente.';

		//Carrega view
		//$this->loadView('contato-cursos-in-company', $data);
                $this->loadView('includes/contato-cursos-in-company-sucesso', $data);

	}

}
