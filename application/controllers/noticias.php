<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class noticias extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;
        var $per_page =10;
	public function __construct(){
		parent::__construct();
                $data['title'] = 'MB Consultoria - notícias';
		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('text_helper');
                $this->load->helper('auxiliar_helper');
	}

	public function index(){

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Busca os banners
		$data['banners'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = NULL, $where, $join = NULL, $order_by = NULL, $dir = 'ASC');

		//Carrega view
		$this->loadView('index', $data);

        }

       public function destaques($offset = 0){

                //Busca texto da tabela  paginas
                $data['url_pagina'] = 'destaques';


                //Busca todas as noticias da tabela  paginas
               if (isset($_GET['buscarNoticia'])){
                   $offset = $this->input->get('per_page');
                  $search="Tipo = 'D' and (titulo like'%".$_GET['buscarNoticia']."%' OR descricao like'%".$_GET['buscarNoticia']."%' OR texto like '%".$_GET['buscarNoticia']."%')";
                  $data['noticias'] = $this->default_model->get_by_search_All('noticias', $campos ='*', $where=null, $offset = null, $per_page =null, $search,  $join = NULL, $order_by = NULL, $direction_order_by = "ASC");
                  $data['paginacao'] = $this->_pagination('noticias', $_GET['buscarNoticia'], '/publicacoes/moticias?buscarNoticia='.$_GET['buscarNoticia']);
               }
               else{
                   $offset = $this->input->get('per_page');
                   $where = array('tipo' =>'D');
                   $data['noticias'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit =10, $where, $join = NULL, $order_by = 'data', $dir = 'ASC');
                   $data['paginacao'] = $this->_pagination('noticias','', '/noticias/destaques');
               }



                $where = array('tipo' =>'D');
		$data['noticia_destaque'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit = 3, $where, $join = NULL, $order_by = 'data', $dir = 'ASC');

                //Busca 2 ultimas as noticias MB NA MÍDIA
                $where = array('tipo' =>'M');
		$data['noticia_mbmidia'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit = 3, $where, $join = NULL, $order_by = 'data', $dir = 'ASC');





                $dados = array('url_pagina'=>$data['url_pagina'],'todasnews' => $data['noticias'],'noticia_destaque' => $data['noticia_destaque'],'noticia_mbmidia' =>$data['noticia_mbmidia']);
                //print_r($dados);
                //exit();
       	//Busca 2 ultimas as noticias news
       	$where = array('tipo' =>'N');
       	$dados['noticia_news'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit =2, $where, $join = NULL, $order_by = 'data', $dir = 'desc');



                //Carrega view
		$this->loadView('noticias-destaques',$dados);


	}


      public function news($offset = 0){


                //Busca texto da tabela  paginas
                $data['url_pagina'] = 'news';


                //Busca todas as noticias da tabela  paginas

               if (isset($_GET['buscarNoticia'])){
                  $offset = $this->input->get('per_page');
                  $search="Tipo = 'N' and (titulo like'%".$_GET['buscarNoticia']."%' OR descricao like'%".$_GET['buscarNoticia']."%' OR texto like '%".$_GET['buscarNoticia']."%')";
                  $data['noticias'] = $this->default_model->get_by_search_All('noticias', $campos ='*', $where=null, $offset = null, $per_page =null, $search,  $join = NULL, $order_by = NULL, $direction_order_by = "ASC");
                  $data['paginacao'] = $this->_pagination('noticias', $_GET['buscarNoticia'], '/noticias/news?buscarNoticia='.$_GET['buscarNoticia']);
               }
               else{
                   $offset = $this->input->get('per_page');
                   $where = array('tipo' =>'N');
                   $data['noticias'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit =10, $where, $join = NULL, $order_by = 'data', $dir = 'ASC');
                   $data['paginacao'] = $this->_pagination('noticias','', '/noticias/news');
               }



                $where = array('tipo' =>'D');
		$data['noticia_destaque'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit = 3, $where, $join = NULL, $order_by = 'data', $dir = 'ASC');

                //Busca 2 ultimas as noticias MB NA MÍDIA
                $where = array('tipo' =>'M');
		$data['noticia_mbmidia'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit = 3, $where, $join = NULL, $order_by = 'data', $dir = 'ASC');




                $dados = array('url_pagina'=>$data['url_pagina'],'todasnews' => $data['noticias'],'noticia_destaque' => $data['noticia_destaque'],'noticia_mbmidia' =>$data['noticia_mbmidia']);
                //print_r($dados);
                //exit();

      	//Veja também
      	$where = array('idioma_id' => $this->session->userdata('idioma_id'));
      	$dados['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
      	$dados['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');



                //Carrega view
		$this->loadView('noticias-news',$dados);

	}

	public function mb_na_midia($offset = 0){


		//Busca texto da tabela  paginas
		$data['url_pagina'] = 'mb-na-midia';


		//Busca todas as noticias da tabela  paginas

		if (isset($_GET['buscarNoticia'])){
			$offset = $this->input->get('per_page');
			$search="Tipo = 'M' and (titulo like'%".$_GET['buscarNoticia']."%' OR descricao like'%".$_GET['buscarNoticia']."%' OR texto like '%".$_GET['buscarNoticia']."%')";
			$data['noticias'] = $this->default_model->get_by_search_All('noticias', $campos ='*', $where=null, $offset = null, $per_page =null, $search,  $join = NULL, $order_by = NULL, $direction_order_by = "ASC");
			$data['paginacao'] = $this->_pagination('noticias', $_GET['buscarNoticia'], '/noticias/mb_na_midia?buscarNoticia='.$_GET['buscarNoticia']);
		}
		else{
			$offset = $this->input->get('per_page');
			$where = array('tipo' =>'M');
			$data['noticias'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit =10, $where, $join = NULL, $order_by = 'data', $dir = 'ASC');
			$data['paginacao'] = $this->_pagination('noticias','', '/noticias/mb_na_midia');
		}



		$where = array('tipo' =>'D');
		$data['noticia_destaque'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit = 3, $where, $join = NULL, $order_by = 'data', $dir = 'ASC');

		//Busca 2 ultimas as noticias MB NA MÍDIA
		$where = array('tipo' =>'M');
		$data['noticia_mbmidia'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit = 3, $where, $join = NULL, $order_by = 'data', $dir = 'ASC');

		//Busca 2 ultimas as noticias news
		$where = array('tipo' =>'N');
		$data['noticia_news'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit =2, $where, $join = NULL, $order_by = 'data', $dir = 'desc');


		$dados = array('url_pagina'=>$data['url_pagina'],'todasnews' => $data['noticias'],'noticia_destaque' => $data['noticia_destaque'],'noticia_mbmidia' =>$data['noticia_mbmidia'], 'noticia_news' => $data['noticia_news']);
		//print_r($dados);
		//exit();

		//Veja também
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));
		$dados['revista_mb'] = $this->default_model->get_all('revistas', array('*'),  NULL, 1, $where, NULL, 'id', 'DESC');
		$dados['pesquisa_estudo'] = $this->default_model->get_all('pesquisas_estudos', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');



		//Carrega view
		$this->loadView('noticias-midia',$dados);

	}


        public function noticias_abertas(){





                //Define where com id da noticia
                $where = array('id' => $_GET['id_noticia']);
		//Busca da noticia pesquisada
		$data['noticias'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit = 1, $where, $join = NULL, $order_by = NULL, $dir = 'desc');


                $where = array('tipo' =>'D');
		$data['noticia_destaque'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit = 3, $where, $join = NULL, $order_by = 'data', $dir = 'ASC');



                //Busca 2 ultimas as noticias news
                $where = array('tipo' =>'N');
		$data['noticia_news'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit =2, $where, $join = NULL, $order_by = 'data', $dir = 'desc');




                //Busca 2 ultimas as noticias MB NA MÍDIA
                $where = array('tipo' =>'M');
		$data['noticia_mbmidia'] = $this->default_model->get_all('noticias', $campos = array('*'), $offset = NULL, $limit = 3, $where, $join = NULL, $order_by = 'data', $dir = 'ASC');



                if ($data['noticias'][0]->tipo=='D'){
                   // $this->loadView('noticias-destaques-aberto', $dados);
                  //Busca texto da tabela  paginas
                    $data['url_pagina'] = 'destaques';
                }
                elseif($data['noticias'][0]->tipo=='M'){
                  //$this->loadView('noticias-midia-aberto', $dados);
                    $data['url_pagina'] = 'mb-na-midia';
                }
                else{
                    $data['url_pagina'] = 'News';


                }

                //comentarios de cada  produto
                $where = array('area' =>'NOT');
                $where = array('id' =>$_GET['id_noticia']);
		$data['comentarios'] = $this->default_model->get_all('comentarios', $campos = array('*'), $offset = NULL, $limit = 2, $where, $join = NULL, $order_by = 'id', $dir = 'desc');




                $dados = array('url_pagina'=>$data['url_pagina'],'noticias' => $data['noticias']['0'],'noticia_destaque' => $data['noticia_destaque'],'noticia_mbmidia' =>$data['noticia_mbmidia'],'noticia_news' =>$data['noticia_news'],'comentarios'=>$data['comentarios']);

                if ($data['noticias'][0]->tipo=='D'){
                    $this->loadView('noticias-destaques-aberto', $dados);
                }
                elseif($data['noticias'][0]->tipo=='M'){
                  $this->loadView('noticias-midia-aberto', $dados);
                }
                else{
                 $this->loadView('noticias-news-aberto', $dados);

                }

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
