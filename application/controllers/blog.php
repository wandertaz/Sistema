<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class blog extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	var $per_page = 10;
	var $join	  = array('posts_categorias' => array('where' => 'posts_categorias.id = categoria_id', 'type' => 'inner'),
						  'posts_colunistas' => array('where' => 'posts_colunistas.id = colunista_id', 'type' => 'inner'));

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('br_date');
		$this->load->helper('html');
                $this->load->helper('auxiliar_helper');
	}

	public function index($offset = 0){

		//Título
    	$data['title'] = 'Blog';
		$data['url_pagina'] = 'blog';

		//Define where com id do idioma
		$where = array('posts.idioma_id' => $this->session->userdata('idioma_id'));

		//Verifica se existe busca
		$busca = $this->input->get('busca');

		//Verifica Categoria, Colunista e Data de arquivo
		$categoria_id = $this->input->get('categoria');
		$colunista_id = $this->input->get('colunista');
		$ano_mes 	  = $this->input->get('ano_mes');

		$where_posts = $where;
		if($categoria_id){
			$where_posts += array('categoria_id' => $categoria_id);
			$dados_categoria = $this->default_model->get_by_id('posts_categorias', $categoria_id);
			$data['titulo'] = 'Categoria: '.$dados_categoria->categoria;
			$data['texto'] = false;
		}
		else if($colunista_id){
			$where_posts += array('colunista_id' => $colunista_id);
			$dados_colunista = $this->default_model->get_by_id('posts_colunistas', $colunista_id);
			$data['titulo'] = 'Colunista: '.$dados_colunista->nome;
			$data['texto'] = $dados_colunista->descricao;
                        $data['fotocolunista'] = $dados_colunista->imagem;

		}
		else if($ano_mes){
			$where_posts += array('DATE_FORMAT(data, \'%Y-%m\') = ' => $ano_mes);
			$data['titulo'] = 'Arquivo: '.br_month(date('m', strtotime($ano_mes))).' '.date('Y', strtotime($ano_mes));
			$data['texto'] = false;
		}
		else{
			$data['titulo'] = 'Blog';
			$data['texto'] = false;
		}

		//Artigos
		if($busca){
			$offset = $this->input->get('per_page');
			$data['posts'] = $this->default_model->get_by_search('posts', array('posts.*, posts_colunistas.nome as colunista'), $where_posts, $offset, $this->per_page, array('posts.titulo' => $busca, 'posts.descricao' => $busca), $this->join, 'data', 'DESC');
			$data['paginacao'] = $this->_pagination('posts', $busca, '/blog/index?busca='.$busca);
		}
		else{
			$data['posts'] = $this->default_model->get_all('posts', $campos = array('posts.*, posts_colunistas.nome as colunista'), $offset, $this->per_page, $where_posts, $this->join, 'data', 'DESC');
			$data['paginacao'] = $this->_pagination('posts', false, '/blog/index');
		}

		//último post (Destaque no topo)
		$data['post_destaque'] = $this->default_model->get_all('posts', array('posts.*, posts_colunistas.nome as colunista, posts_colunistas.imagem as imagem_colunista, posts_colunistas.descricao as descricao_colunista'), NULL, 1, $where, $this->join, 'data', 'DESC');

		//Lista de Colunistas e Categorias
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Lista de colunistas
		$data['colunistas'] = $this->default_model->get_all('posts_colunistas', array('*'), NULL, NULL, NULL, NULL, 'nome', 'ASC');
		foreach($data['colunistas'] as $key => $colunista){
			$resultado = $this->default_model->get_all('posts', array('COUNT(*) AS total'), NULL, NULL, $where + array('colunista_id' => $colunista->id));
			$data['colunistas'][$key]->total = $resultado[0]->total;
		}

		//Lista de categorias
		$data['categorias'] = $this->default_model->get_all('posts_categorias', array('*'), NULL, NULL, $where, NULL, 'categoria', 'ASC');
		foreach($data['categorias'] as $key => $categoria){
			$resultado = $this->default_model->get_all('posts', array('COUNT(*) AS total'), NULL, NULL, $where + array('categoria_id' => $categoria->id));
			$data['categorias'][$key]->total = $resultado[0]->total;
		}

		//Lista de arquivos
		$arquivos_posts = $this->default_model->get_all('posts', array('*'), NULL, NULL, $where, NULL, 'data', 'DESC');
		foreach($arquivos_posts as $post)
			$data['arquivos_posts'][date('Y-m', strtotime($post->data))] = br_month(date('m', strtotime($post->data))).' '.date('Y', strtotime($post->data));

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Carrega view
		$this->loadView('blog', $data);
	}

	public function ver_post($id){

		//Título
		$data['title'] = 'Blog';
		$data['url_pagina'] = 'blog';

		//Define where com id do idioma
		$where = array('posts.idioma_id' => $this->session->userdata('idioma_id'));

		//Post
		$data['post'] = $this->default_model->get_by_id('posts', $id, array('posts.*, posts_colunistas.nome as colunista, posts_colunistas.imagem aa, posts_colunistas.descricao as descricao_colunista'), $where, $this->join);


		//último post (Destaque no topo)
		$data['post_destaque'] = $this->default_model->get_all('posts', array('posts.*, posts_colunistas.nome as colunista, posts_colunistas.imagem as imagem_colunista, posts_colunistas.descricao as descricao_colunista'), NULL, 1, $where, $this->join, 'data', 'DESC');

		//Lista de Colunistas e Categorias
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));
		$data['colunistas'] = $this->default_model->get_all('posts_colunistas', array('*'), NULL, NULL, NULL, NULL, 'nome', 'ASC');


		//Recebe total por colunista
		foreach($data['colunistas'] as $key => $colunista){
			$resultado = $this->default_model->get_all('posts', array('COUNT(*) AS total'), NULL, NULL, array('colunista_id' => $colunista->id));
			$data['colunistas'][$key]->total = $resultado[0]->total;
		}

		$data['categorias'] = $this->default_model->get_all('posts_categorias', array('*'), NULL, NULL, $where, NULL, 'categoria', 'ASC');

		//Recebe total por colunista
		foreach($data['categorias'] as $key => $categoria){
			$resultado = $this->default_model->get_all('posts', array('COUNT(*) AS total'), NULL, NULL, array('categoria_id' => $categoria->id));
			$data['categorias'][$key]->total = $resultado[0]->total;
		}

		//Lista de arquivos
		$arquivos_posts = $this->default_model->get_all('posts', array('*'), NULL, NULL, $where, NULL, 'data', 'DESC');
		foreach($arquivos_posts as $post)
			$data['arquivos_posts'][date('Y-m', strtotime($post->data))] = br_month(date('m', strtotime($post->data))).' '.date('Y', strtotime($post->data));

		//Box destaques
		$data['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$data['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Comentários
		$data['comentarios'] = $this->default_model->get_all('comentarios', array('*'),  NULL, NULL, array('registro_id' => $id, 'area' => 'POS', 'ativo' => 'S'), NULL, 'created', 'DESC');

		//Carrega view
		$this->loadView('blog-aberto', $data);

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

		//Define where com id do idioma
		$where = array('posts.idioma_id' => $this->session->userdata('idioma_id'));

		//Busca os itens
		$posts = $this->default_model->get_all('posts', array('posts.*, posts_categorias.categoria as categoria'), 0, NULL, $where, $this->join, 'data', 'DESC');

		//Inicia xml
		$conteudo  = '<?xml version="1.0" encoding="iso-88859-1"?>';
		$conteudo .= '<rss versao="2.0"><channel>';
		$conteudo .= '<title>Blog - MB Consultoria</title>
					  <link>'.site_url('blog').'</link>
					  <description>Blog - MB Consultoria</description>';

		//Adiciona os dados dos registros
		if($posts){
			foreach($posts as $item){
				$conteudo .= '<item>';
				$conteudo .= '<title>'.$item->titulo.'</title>';
				$conteudo .= '<link>'.site_url('blog/ver_post/').'/'.$item->id.'/'.$item->url.'</link>';
				$conteudo .= '<pubDate>'.$item->data.'</pubDate>';
				$conteudo .= '<category>'.$item->categoria.'</category>';
				$conteudo .= '<description><![CDATA['.$item->descricao.']]></description>';
				$conteudo .= '<content><![CDATA['.$item->texto.']]></content>';
				$conteudo .= '</item>';
			}
		}
		$conteudo .= '</channel></rss>';

		//Salva xml
		$xml = fopen('rss/blog/rss.xml', "w");
		fwrite($xml, $conteudo);
		fclose($xml);

		//Redireciona
		header('Location: '. base_url().'rss/blog/rss.xml');
	}

}
