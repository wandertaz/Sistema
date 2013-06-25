<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quem_somos extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	public function __construct(){
		parent::__construct();
                $data['title'] = 'MB Consultoria - Quem Somos';
		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('text_helper');
                $this->load->helper('auxiliar_helper');
	}

	public function index(){

		return $this->historia();

        }

       public function historia(){

            $data['url_pagina'] = 'nossa-historia';
            //Título
            //$data['title'] = 'MB Consultoria - notícias';

            $where = null;
            $data['depoimentos'] = $this->default_model->get_all('depoimentos', $campos = array('*'), $offset = NULL, $limit = 3, $where=array('ativo' => 'S', 'tipo' => 'HI'), $join = NULL, $order_by = 'id', $dir = 'DESC');

            $where = array('url'=>'nossos-clientes');
            $data['historia'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $where = array('url'=>'cultura-organizacional');
            $data['cultura'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $where = array('url'=>'nossos-diferenciais');
            $data['diferenciais'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');


            $dados = array('url_pagina'=>$data['url_pagina'],'depoimentos'=>$data['depoimentos'],'historia'=>$data['historia'][0],'cultura'=>$data['cultura'][0],'diferenciais'=>$data['diferenciais'][0]);

	      	//Box destaques
	      	$where = array('idioma_id' => $this->session->userdata('idioma_id'));
	      	$dados['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
	      	$dados['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');


	       	//Busca banner publicitário (depoimento)
	       	$where = array('idioma_id' => $this->session->userdata('idioma_id'));
	       	$dados['banner_depoimento'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = 1, $where + array('tipo' => 'D', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');


            //Carrega view
            $this->loadView('quem-somos-nossa-historia', $dados);

	}


      public function cultura(){

	    $data['url_pagina'] = 'cultura-organizacional';
            //Título
            //$data['title'] = 'MB Consultoria - notícias';

            $where = null;
            $data['depoimentos'] = $this->default_model->get_all('depoimentos', $campos = array('*'), $offset = NULL, $limit = 3, $where= array('ativo' => 'S', 'tipo' => 'CU'), $join = NULL, $order_by = 'id', $dir = 'DESC');



            $where = array('url'=>'nossa-historia');
            $data['historia'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $where = array('url'=>'nossos-clientes');
            $data['cultura'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $where = array('url'=>'nossos-diferenciais');
            $data['diferenciais'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');


            $dados = array('url_pagina'=>$data['url_pagina'],'depoimentos'=>$data['depoimentos'],'historia'=>$data['historia'][0],'cultura'=>$data['cultura'][0],'diferenciais'=>$data['diferenciais'][0]);

	     	//Box destaques
	     	$where = array('idioma_id' => $this->session->userdata('idioma_id'));
	     	$dados['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
	     	$dados['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

            //Carrega view
            $this->loadView('quem-somos-cultura-organizacional', $dados);


	}

      public function diferenciais(){

	    $data['url_pagina'] = 'nossos-diferenciais';
            //Título
            //$data['title'] = 'MB Consultoria - notícias';

            $where = null;
            $data['depoimentos'] = $this->default_model->get_all('depoimentos', $campos = array('*'), $offset = NULL, $limit = 3, $where=array('ativo' => 'S', 'tipo' => 'DI'), $join = NULL, $order_by = 'id', $dir = 'DESC');



            $where = array('url'=>'nossa-historia');
            $data['historia'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $where = array('url'=>'cultura-organizacional');
            $data['cultura'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $where = array('url'=>'nossos-clientes');
            $data['diferenciais'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');


            $dados = array('url_pagina'=>$data['url_pagina'],'depoimentos'=>$data['depoimentos'],'historia'=>$data['historia'][0],'cultura'=>$data['cultura'][0],'diferenciais'=>$data['diferenciais'][0]);

	      	//Box destaques
	      	$where = array('idioma_id' => $this->session->userdata('idioma_id'));
	      	$dados['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
	      	$dados['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

	      	//Busca banner publicitário (depoimento)
	      	$where = array('idioma_id' => $this->session->userdata('idioma_id'));
	      	$dados['banner_depoimento'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = 1, $where + array('tipo' => 'D', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');

            //Carrega view
            $this->loadView('quem-somos-nossos-diferenciais', $dados);

	}


	public function clientes(){

		$data['url_pagina'] = 'nossos-clientes';

		$where = null;
		$data['depoimentos'] = $this->default_model->get_all('depoimentos', $campos = array('*'), $offset = NULL, $limit = 3, $where=array('ativo' => 'S', 'tipo' => 'CL'), $join = NULL, $order_by = 'id', $dir = 'DESC');

		$where = array('url'=>'nossa-historia');
		$data['historia'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

		$where = array('url'=>'cultura-organizacional');
		$data['cultura'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

		$where = array('url'=>'nossos-diferenciais');
		$data['diferenciais'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');


		$dados = array('url_pagina'=>$data['url_pagina'],'depoimentos'=>$data['depoimentos'],'historia'=>$data['historia'][0],'cultura'=>$data['cultura'][0],'diferenciais'=>$data['diferenciais'][0]);

		//Box destaques
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));
		$dados['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
		$dados['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');


		//Busca banner publicitário (depoimento)
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));
		$dados['banner_depoimento'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = 1, $where + array('tipo' => 'D', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');


		//Carrega view
		$this->loadView('quem-somos-nossos-clientes', $dados);

	}








}
