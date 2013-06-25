<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autodiagnosticos extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	var $join = array('tipos_autodiagnosticos' => array('where' => 'tipos_autodiagnosticos.id_tipo_autodiagnostico = tipos_autodiagnosticos_id_tipo_autodiagnostico', 'type' => 'inner'));
	var $per_page = 8;

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
                $this->load->helper('auxiliar_helper');
	}

	public function index($offset = 0){

		//Título
		$data['title'] = 'Autodiagnósticos';
		$data['url_pagina'] = 'autodiagnosticos';

		//Verifica se existe busca
		$busca = $this->input->get('busca');

		//autodiagnosticos
		if($busca){
			$offset = $this->input->get('per_page');
			$data['autodiagnosticos'] = $this->default_model->get_by_search('autodiagnosticos', array('autodiagnosticos.*, nome_tipo'), array('autodiagnosticos.ativo'=>'S'), $offset, $this->per_page, array('nome' => $busca, 'breve_descricao' => $busca), $this->join, 'id_autodiagnostico', 'DESC');
			$data['paginacao'] = $this->_pagination('autodiagnosticos', $busca, '/autodiagnosticos/index?busca='.$busca);
		}
		else{
			$data['autodiagnosticos'] = $this->default_model->get_all('autodiagnosticos', $campos = array('autodiagnosticos.*, nome_tipo'), $offset, $this->per_page, array('autodiagnosticos.ativo'=>'S'), $join = $this->join, $order_by = 'id_autodiagnostico', $dir = 'DESC');
			$data['paginacao'] = $this->_pagination('autodiagnosticos', false, '/autodiagnosticos/index');
		}

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
                $where_cursos = "url = 'central-de-downloads' or url = 'autodiagnosticos' or url = 'banco-de-talentos' or url = 'modulo-de-pesquisa'";   
		//$where_cursos = "url = 'cursos-in-company' OR url = 'programas-de-desenvolvimento' OR url = 'programa-alta-performance'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'RAND()', '');

		//Carrega view
		$this->loadView('auto_diagnostico/listagem-autodiagnostico', $data);
	}

	public function ver_autodiagnostico($id){

		//Título
		$data['title'] = 'Autodiagnósticos';
		$data['url_pagina'] = 'autodiagnosticos';

		//Autodiagnóstico
		$data['autodiagnostico'] = $this->default_model->get_by_id('autodiagnosticos', $id, array('autodiagnosticos.*, nome_tipo'), NULL, $this->join, 'id_autodiagnostico');

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'cursos-in-company' OR url = 'programas-de-desenvolvimento' OR url = 'programa-alta-performance'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'id', 'ASC');

		//Carrega view
		$this->loadView('auto_diagnostico/autodiagnostico-detalhe', $data);
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
			$config['total_rows']        = $this->default_model->count_by_search($table, array('nome' => $search, 'breve_descricao' => $search), array(), NULL);
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
}
