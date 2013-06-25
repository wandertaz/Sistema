<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class busca_site extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	var $join = array();
	var $per_page = 10;

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
                $this->load->model("buscageral_model");
                $this->load->helper('auxiliar_helper');
	}

	public function index($offset = 0){

		//Título
		$data['title'] = 'Pesquisa Conteúdo';
		//$data['url_pagina'] = 'autodiagnosticos';

		//Verifica se existe busca
		$busca = $this->input->get('pesquisar');

		//autodiagnosticos
		if($busca){
			$offset = $this->input->get('per_page');
                        
                        
			$data['pesquisas'] = $this->buscageral_model->resultadobusca($busca,$offset,$this->per_page,1);                   
                        
			$data['paginacao'] = $this->_pagination($busca,$offset);
		}
		/*else{
			$data['autodiagnosticos'] = $this->default_model->get_all('autodiagnosticos', $campos = array('autodiagnosticos.*, nome_tipo'), $offset, $this->per_page, array('autodiagnosticos.ativo'=>'S'), $join = $this->join, $order_by = 'id_autodiagnostico', $dir = 'DESC');
			$data['paginacao'] = $this->_pagination('autodiagnosticos', false, '/autodiagnosticos/index');
		}*/

		

                

                




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
		$this->loadView('listagem-pesquisa', $data);
	}

	

	private function _pagination($busca,$offset=0){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = '';
		$config['first_link'] = '';

		//Parâmetro
		//if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        =$this->buscageral_model->resultadobusca($busca,$offset,$this->per_page,2);
			$config['base_url']          = site_url('busca_site?pesquisar='.$busca);
                        
                    
		/*}
		else{
			$config['uri_segment'] = 3;
			$config['total_rows']  = $this->default_model->count($table, array(), NULL);
			$config['base_url']    = site_url().$url;
		}*/

		//Inicializa e retorna paginação
		$this->pagination->initialize($config);
		return $this->pagination->create_links();

	}
}
