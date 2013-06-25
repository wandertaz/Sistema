<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class publicacoes extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	var $per_page = 4;

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('auxiliar_helper');
	}

	public function index(){

		//Título
    	$data['title'] = 'Home';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Busca os banners
		$data['banners'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = NULL, $where, $join = NULL, $order_by = NULL, $dir = 'ASC');

		//Carrega view
		$this->loadView('index', $data);

        }

	public function revistas(){

		//Título
    	$data['title'] = 'Revista MB';
		$data['url_pagina'] = 'revistas';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Listagem das últimas edições
		$data['ultimas_revistas'] = $this->default_model->get_all('revistas', array('*'),  NULL, 12, $where, NULL, $order_by = 'created', $dir = 'DESC');

		//Verifica se existe busca
		$revista_id = $this->input->post('cmbRevista');

		//Busca última revista
		$where_revista = ($revista_id ? $where + array('id' => $revista_id) : $where);
		$data['revista'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where_revista, NULL, $order_by = 'created', $dir = 'DESC');

		//Últimos artigos
		$data['ultimos_artigos'] = $this->default_model->get_all('artigos', array('*'),  NULL, 2, $where, NULL, $order_by = 'id', $dir = 'DESC');

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Veja também
		$data['artigo_mb'] = $this->default_model->get_all('artigos', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
		$data['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');

		//Carrega view
		$this->loadView('publicacoes-revista', $data);

	}

	public function artigos($offset = 0){

		//Título
    	$data['title'] = 'Artigos';
		$data['url_pagina'] = 'artigos';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Verifica se existe busca
		$busca_artigo = $this->input->get('busca_artigo');

		//Artigos
		if($busca_artigo){
			$offset = $this->input->get('per_page');
			$data['artigos'] = $this->default_model->get_by_search('artigos', array('*'), $where, $offset, $this->per_page, array('titulo' => $busca_artigo, 'descricao' => $busca_artigo), NULL, 'data_publicacao', 'DESC');
			$data['paginacao'] = $this->_pagination('artigos', $busca_artigo, '/publicacoes/artigos?busca_artigo='.$busca_artigo);
		}
		else{
			$data['artigos'] = $this->default_model->get_all('artigos', $campos = array('*'), $offset, $this->per_page, $where, $join = NULL, $order_by = 'data_publicacao', $dir = 'DESC');
			$data['paginacao'] = $this->_pagination('artigos', false, '/publicacoes/artigos');
		}

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Coluna últimas publicações
		$data['ultimos_artigos']   = $this->default_model->get_all('artigos', array('*'),  NULL, 2, $where, NULL, 'id', 'DESC');
		$data['ultimas_pesquisas'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 2, $where + array('tipo' => 'P'), NULL, 'data', 'DESC');
		$data['ultimos_estudos']   = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 2, $where + array('tipo' => 'E'), NULL, 'data', 'DESC');

		//Veja também
		$data['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
		$data['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');

		//Carrega view
		$this->loadView('publicacoes-artigos', $data);

	}

	public function ver_artigo($id){

		//Título
		$data['title'] = 'Artigos';
		$data['url_pagina'] = 'artigos';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Artigo
		$data['artigo'] = $this->default_model->get_by_id('artigos', $id, array('*'), $where);

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Coluna últimas publicações
		$data['ultimos_artigos']   = $this->default_model->get_all('artigos', array('*'),  NULL, 2, $where, NULL, 'id', 'DESC');
		$data['ultimas_pesquisas'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 2, $where + array('tipo' => 'P'), NULL, 'data', 'DESC');
		$data['ultimos_estudos']   = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 2, $where + array('tipo' => 'E'), NULL, 'data', 'DESC');

		//Veja também
		$data['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
		$data['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');

		//Comentários
		$data['comentarios'] = $this->default_model->get_all('comentarios', array('*'),  NULL, NULL, array('registro_id' => $id, 'area' => 'ART', 'ativo' => 'S'), NULL, 'created', 'DESC');

		//Carrega view
		$this->loadView('publicacoes-artigos-aberto', $data);

	}


    public function pesquisas($offset = 0){

    	//Título
    	$data['title'] = 'Pesquisas e Estudos';
    	$data['url_pagina'] = 'pesquisas_estudos';

    	//Define where com id do idioma
    	$where = array('idioma_id' => $this->session->userdata('idioma_id'));

    	//Verifica se existe busca
    	$busca = $this->input->get('busca');

    	//Artigos
    	if($busca){
    		$offset = $this->input->get('per_page');
    		$data['pesquisas_estudos'] = $this->default_model->get_by_search('pesquisas_estudos', array('*'), $where, $offset, $this->per_page, array('titulo' => $busca_artigo, 'descricao' => $busca_artigo), NULL, 'id', 'DESC');
    		$data['paginacao'] = $this->_pagination('pesquisas_estudos', $busca, '/publicacoes/pesquisas?busca_artigo='.$busca);
    	}
    	else{
    		$data['pesquisas_estudos'] = $this->default_model->get_all('pesquisas_estudos', $campos = array('*'), $offset, $this->per_page, $where, $join = NULL, $order_by = 'id', $dir = 'DESC');
    		$data['paginacao'] = $this->_pagination('pesquisas_estudos', false, '/publicacoes/pesquisas');
    	}

    	//Box destaques
    	$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
    	$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

    	//Coluna últimas publicações
    	$data['ultimos_artigos']   = $this->default_model->get_all('artigos', array('*'),  NULL, 2, $where, NULL, 'id', 'DESC');
    	$data['ultimas_pesquisas'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 2, $where + array('tipo' => 'P'), NULL, 'data', 'DESC');
    	$data['ultimos_estudos']   = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 2, $where + array('tipo' => 'E'), NULL, 'data', 'DESC');

    	//Veja também
    	$data['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
    	$data['artigo_mb'] = $this->default_model->get_all('artigos', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');

    	//Carrega view
    	$this->loadView('publicacoes-estudos', $data);

	}

	public function ver_pesquisas_estudos($id){

		//Título
		$data['title'] = 'Pesquisas e Estudos';
		$data['url_pagina'] = 'pesquisas_estudos';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Pesquisa
		$data['pesquisa'] = $this->default_model->get_by_id('pesquisas_estudos', $id, array('*'), $where);

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Coluna últimas publicações
		$data['ultimos_artigos']   = $this->default_model->get_all('artigos', array('*'),  NULL, 2, $where, NULL, 'id', 'DESC');
		$data['ultimas_pesquisas'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 2, $where + array('tipo' => 'P'), NULL, 'data', 'DESC');
		$data['ultimos_estudos']   = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 2, $where + array('tipo' => 'E'), NULL, 'data', 'DESC');

		//Veja também
		$data['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
		$data['artigo_mb'] = $this->default_model->get_all('artigos', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');

		//Comentários
		$data['comentarios'] = $this->default_model->get_all('comentarios', array('*'),  NULL, NULL, array('registro_id' => $id, 'area' => 'PES', 'ativo' => 'S'), NULL, 'created', 'DESC');

		//Carrega view
		$this->loadView('publicacoes-pesquisas-aberto', $data);

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

}
