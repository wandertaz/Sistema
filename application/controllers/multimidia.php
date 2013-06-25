<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class multimidia extends MY_Controller {

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
		return $this->videos();
    }

	public function videos($offset = 0){

		//Título
    	$data['title'] = 'Vídeos';
		$data['url_pagina'] = 'videos';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Verifica se existe busca
		$busca = $this->input->get('busca');

		//Vídeos
		if($busca){
			$offset = $this->input->get('per_page');
			$data['videos'] = $this->default_model->get_by_search('videos', array('*'), NULL, $offset, $this->per_page, array('titulo' => $busca, 'descricao' => $busca), NULL, 'data', 'DESC');
			$data['paginacao'] = $this->_pagination('videos', $busca, '/multimidia/videos?busca='.$busca);
		}
		else{
			$data['videos'] = $this->default_model->get_all('videos', array('*'), $offset, $this->per_page, NULL, $join = NULL, $order_by = 'data', $dir = 'DESC');
			$data['paginacao'] = $this->_pagination('videos', false, '/multimidia/videos');
		}

		//Veja também
		$data['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
		$data['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Box Lateral multimidia
		$data['ultimo_video']     = $this->default_model->get_all('videos', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['ultimo_podcast']   = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['ultimas_galerias'] = $this->default_model->get_all('galerias', array('*'),  NULL, 2, NULL, NULL, 'data', 'DESC');

		//Carrega view
		$this->loadView('multimidia-videos', $data);

	}


	public function pesquisa_online($offset = 0){

		//Título
    	$data['title'] = 'Vídeos';
		$data['url_pagina'] = 'videos';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Verifica se existe busca
		$busca = $this->input->get('busca');

		//Vídeos
		if($busca){
			$offset = $this->input->get('per_page');
			$data['videos'] = $this->default_model->get_by_search('videos', array('*'), NULL, $offset, $this->per_page, array('titulo' => $busca, 'descricao' => $busca), NULL, 'data', 'DESC');
			$data['paginacao'] = $this->_pagination('videos', $busca, '/multimidia/videos?busca='.$busca);
		}
		else{
			$data['videos'] = $this->default_model->get_all('videos', array('*'), $offset, $this->per_page, NULL, $join = NULL, $order_by = 'data', $dir = 'DESC');
			$data['paginacao'] = $this->_pagination('videos', false, '/multimidia/videos');
		}

		//Veja também
		$data['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
		$data['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Box Lateral multimidia
		$data['ultimo_video']     = $this->default_model->get_all('videos', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['ultimo_podcast']   = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['ultimas_galerias'] = $this->default_model->get_all('galerias', array('*'),  NULL, 2, NULL, NULL, 'data', 'DESC');

		//Carrega view
		$this->loadView('pesquisa_online/pesquisa_online_pesquisa', $data);

	}

	

	public function ver_video($id){

		//Título
		$data['title'] = 'Vídeo';
		$data['url_pagina'] = 'videos';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Vídeo
		$data['video'] = $this->default_model->get_by_id('videos', $id, array('*'), NULL);

		//Veja também
		$data['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
		$data['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Box Lateral multimidia
		$data['ultimo_video']     = $this->default_model->get_all('videos', array('*'),  NULL, 1, array('id != ' => $id), NULL, 'data', 'DESC');
/*
		print_r($this->db->last_query());
		die();
*/
		$data['ultimo_podcast']   = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['ultimas_galerias'] = $this->default_model->get_all('galerias', array('*'),  NULL, 2, NULL, NULL, 'data', 'DESC');

		//Comentários
		$data['comentarios'] = $this->default_model->get_all('comentarios', array('*'),  NULL, NULL, array('registro_id' => $id, 'area' => 'VID', 'ativo' => 'S'), NULL, 'created', 'DESC');

		//Carrega view
		$this->loadView('multimidia-videos-aberto', $data);

	}

	public function podcasts($offset = 0){

		//Título
    	$data['title'] = 'Podcasts';
		$data['url_pagina'] = 'podcasts';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Verifica se existe busca
		$busca = $this->input->get('busca');

		//Podcasts
		if($busca){
			$offset = $this->input->get('per_page');
			$data['podcasts'] = $this->default_model->get_by_search('podcasts', array('*'), NULL, $offset, $this->per_page, array('titulo' => $busca, 'descricao' => $busca), NULL, 'data', 'DESC');
			$data['paginacao'] = $this->_pagination('podcasts', $busca, '/multimidia/podcasts?busca='.$busca);
		}
		else{
			$data['podcasts'] = $this->default_model->get_all('podcasts', array('*'), $offset, $this->per_page, NULL, $join = NULL, $order_by = 'data', $dir = 'DESC');
			$data['paginacao'] = $this->_pagination('podcasts', false, '/multimidia/podcasts');
		}

		//Veja também
		$data['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
		$data['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Box Lateral multimidia
		$data['ultimo_video']     = $this->default_model->get_all('videos', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['ultimo_podcast']   = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['ultimas_galerias'] = $this->default_model->get_all('galerias', array('*'),  NULL, 2, NULL, NULL, 'data', 'DESC');

		//Carrega view
		$this->loadView('multimidia-podcast', $data);

	}

	public function ver_podcast($id){

		//Título
		$data['title'] = 'Podcasts';
		$data['url_pagina'] = 'podcasts';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Podcast
		$data['podcast'] = $this->default_model->get_by_id('podcasts', $id, array('*'), NULL);

		//Veja também
		$data['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
		$data['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Box Lateral multimidia
		$data['ultimo_video']     = $this->default_model->get_all('videos', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['ultimo_podcast']   = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, array('id != ' => $id), NULL, 'data', 'DESC');
		$data['ultimas_galerias'] = $this->default_model->get_all('galerias', array('*'),  NULL, 2, NULL, NULL, 'data', 'DESC');

		//Comentários
		$data['comentarios'] = $this->default_model->get_all('comentarios', array('*'),  NULL, NULL, array('registro_id' => $id, 'area' => 'POD', 'ativo' => 'S'), NULL, 'created', 'DESC');

		//Carrega view
		$this->loadView('multimidia-podcast-aberto', $data);

	}

    public function galerias($offset = 0){

		//Título
    	$data['title'] = 'Galeria de Fotos';
    	$data['url_pagina'] = 'galerias';

    	//Define where com id do idioma
    	$where = array('idioma_id' => $this->session->userdata('idioma_id'));

    	//Verifica se existe busca
    	$busca = $this->input->get('busca');

    	//Galerias
    	if($busca){
    		$offset = $this->input->get('per_page');
    		$data['galerias'] = $this->default_model->get_by_search('galerias', array('*'), NULL, $offset, $this->per_page, array('titulo' => $busca, 'descricao' => $busca), NULL, 'data', 'DESC');
    		$data['paginacao'] = $this->_pagination('galerias', $busca, '/multimidia/galerias?busca='.$busca);
    	}
    	else{
    		$data['galerias'] = $this->default_model->get_all('galerias', array('*'), $offset, $this->per_page, NULL, $join = NULL, $order_by = 'data', $dir = 'DESC');
    		$data['paginacao'] = $this->_pagination('galerias', false, '/multimidia/galerias');
    	}

    	//Veja também
    	$data['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
    	$data['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');

    	//Box destaques
    	$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
    	$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

    	//Box Lateral multimidia
    	$data['ultimo_video']     = $this->default_model->get_all('videos', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
    	$data['ultimo_podcast']   = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
    	$data['ultimas_galerias'] = $this->default_model->get_all('galerias', array('*'),  NULL, 2, NULL, NULL, 'data', 'DESC');

		//Carrega view
		$this->loadView('multimidia-galeria', $data);

	}

	public function ver_galeria($id){

		//Título
		$data['title'] = 'Galeria de Fotos';
		$data['url_pagina'] = 'galerias';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Galeria
		$data['galeria'] = $this->default_model->get_by_id('galerias', $id, array('*'), NULL);
		$data['galeria']->fotos = $this->default_model->get_all('galerias_fotos', array('*'),  NULL, NULL, array('galeria_id' => $id));

		//Veja também
		$data['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
		$data['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Box Lateral multimidia
		$data['ultimo_video']     = $this->default_model->get_all('videos', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['ultimo_podcast']   = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');
		$data['ultimas_galerias'] = $this->default_model->get_all('galerias', array('*'),  NULL, 2, array('id != ' => $id), NULL, 'data', 'DESC');

		//Comentários
		$data['comentarios'] = $this->default_model->get_all('comentarios', array('*'),  NULL, NULL, array('registro_id' => $id, 'area' => 'GAL', 'ativo' => 'S'), NULL, 'created', 'DESC');

		//Carrega view
		$this->loadView('multimidia-galeria-aberto', $data);

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

	public function rss(){

		//Busca os itens
		$videos = $this->default_model->get_all('videos', array('*'), 0, NULL, NULL, NULL, 'data', 'DESC');
		foreach($videos as $key => $video){
			$videos[$key]->categoria = 'VÍDEO';
			$videos[$key]->link = site_url('multimidia/ver_video/').'/'.$video->id.'/'.$video->url;
		}
		$fotos = $this->default_model->get_all('galerias',  array('*'), 0, NULL, NULL, NULL, 'data', 'DESC');
		foreach($fotos as $key => $foto){
			$fotos[$key]->categoria = 'GALERIA';
			$fotos[$key]->link = site_url('multimidia/ver_galeria/').'/'.$foto->id.'/'.$foto->url;
		}
		$audios = $this->default_model->get_all('podcasts',  array('*'), 0, NULL, NULL, NULL, 'data', 'DESC');
		foreach($audios as $key => $audio){
			$audios[$key]->categoria = 'PODCAST';
			$audios[$key]->link = site_url('multimidia/ver_podcast/').'/'.$audio->id.'/'.$audio->url;
		}

		//Mescla registros, por data
		$itens = array_merge($videos,$fotos,$audios);
		foreach($itens as $item)
			$registros[$item->data][] = $item;
		krsort($registros);

		//Inicia xml
		$conteudo  = '<?xml version="1.0" encoding="iso-88859-1"?>';
		$conteudo .= '<rss versao="2.0"><channel>';
		$conteudo .= '<title>Multimídia - MB Consultoria</title>
					  <link>'.site_url().'</link>
					  <description>Multimídia - MB Consultoria</description>';

		//Adiciona os dados dos registros
		if($registros){
			foreach($registros as $registro){
				foreach($registro as $item){
					$conteudo .= '<item>';
					$conteudo .= '<title>'.$item->titulo.'</title>';
					$conteudo .= '<link>'.$item->link.'</link>';
					$conteudo .= '<pubDate>'.$item->data.'</pubDate>';
					$conteudo .= '<category>'.$item->categoria.'</category>';
					$conteudo .= '<description><![CDATA['.$item->descricao.']]></description>';
					$conteudo .= '<content><![CDATA['.$item->texto.']]></content>';
					$conteudo .= '</item>';
				}
			}
		}
		$conteudo .= '</channel></rss>';

		//Salva xml
		$xml = fopen('rss/multimidia/rss.xml', "w");
		fwrite($xml, $conteudo);
		fclose($xml);

		//Redireciona
		header('Location: '. base_url().'rss/multimidia/rss.xml');
	}

}
