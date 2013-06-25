<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class servicos extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	public function __construct(){
		parent::__construct();
                $data['title'] = 'MB Consultoria - Serviços';
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

       public function estrategias(){

	 $data['url_pagina'] = 'estrategias';
            //Título
            //$data['title'] = 'MB Consultoria - notícias';

            $where = array('tipo'=>'ES');
            $data['projetos'] = $this->default_model->get_all('projetos', $campos = array('*'), $offset = NULL, $limit =10, $where, $join = NULL, $order_by = 'id', $dir = 'DESC');

           $where = array('url'=>'nossos-diferenciais');
            $data['diferenciais'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $where = array('url'=>'cultura-organizacional');
            $data['cultura'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');


             // print_r($data['diferenciais'][0]);
            //exit;
            $dados = array('url_pagina'=>$data['url_pagina'],'projetos'=>$data['projetos'],'diferenciais'=>$data['diferenciais'][0],'cultura'=>$data['cultura'][0]);

	      	//Box destaques
       		$where = array('idioma_id' => $this->session->userdata('idioma_id'));
	      	$dados['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
	      	$dados['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

            //Carrega view
            $this->loadView('servicos-estrategias', $dados);

	}


      public function processos(){

            $data['url_pagina'] = 'processos';
            //Título
            //$data['title'] = 'MB Consultoria - notícias';

            $where = array('tipo'=>'PR');
            $data['projetos'] = $this->default_model->get_all('projetos', $campos = array('*'), $offset = NULL, $limit =10, $where, $join = NULL, $order_by = 'id', $dir = 'DESC');

           $where = array('url'=>'nossos-diferenciais');
            $data['diferenciais'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $where = array('url'=>'cultura-organizacional');
            $data['cultura'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');


             // print_r($data['diferenciais'][0]);
            //exit;
            $dados = array('url_pagina'=>$data['url_pagina'],'projetos'=>$data['projetos'],'diferenciais'=>$data['diferenciais'][0],'cultura'=>$data['cultura'][0]);

		//Box destaques
      	$where = array('idioma_id' => $this->session->userdata('idioma_id'));
      	$dados['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
      	$dados['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Carrega view
		$this->loadView('servicos-processos', $dados);

	}

      public function pessoas(){

            $data['url_pagina'] = 'pessoas';
            //Título
            //$data['title'] = 'MB Consultoria - notícias';

            $where = array('tipo'=>'PE');
            $data['projetos'] = $this->default_model->get_all('projetos', $campos = array('*'), $offset = NULL, $limit =10, $where, $join = NULL, $order_by = 'id', $dir = 'DESC');

           $where = array('url'=>'nossos-diferenciais');
            $data['diferenciais'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $where = array('url'=>'cultura-organizacional');
            $data['cultura'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');


             // print_r($data['diferenciais'][0]);
            //exit;
            $dados = array('url_pagina'=>$data['url_pagina'],'projetos'=>$data['projetos'],'diferenciais'=>$data['diferenciais'][0],'cultura'=>$data['cultura'][0]);

      	//Box destaques
      	$where = array('idioma_id' => $this->session->userdata('idioma_id'));
      	$dados['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
      	$dados['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

		//Carrega view
		$this->loadView('servicos-pessoas', $dados);

	}


        public function governanca_corporativa(){

            $data['url_pagina'] = 'governanca-corporativa';
            //Título
            //$data['title'] = 'MB Consultoria - notícias';

            $where = array('tipo'=>'GO');
            $data['projetos'] = $this->default_model->get_all('projetos', $campos = array('*'), $offset = NULL, $limit =10, $where, $join = NULL, $order_by = 'id', $dir = 'DESC');

           $where = array('url'=>'nossos-diferenciais');
            $data['diferenciais'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $where = array('url'=>'cultura-organizacional');
            $data['cultura'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $dados = array('url_pagina'=>$data['url_pagina'],'projetos'=>$data['projetos'],'diferenciais'=>$data['diferenciais'][0],'cultura'=>$data['cultura'][0]);

        	//Box destaques
        	$where = array('idioma_id' => $this->session->userdata('idioma_id'));
        	$dados['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
        	$dados['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

            //Carrega view
            $this->loadView('servicos-governanca', $dados);

	}



       public function educacao_corporativa(){

	    $data['url_pagina'] = 'educacao-Corporativa';
            //Título
            //$data['title'] = 'MB Consultoria - notícias';

            $where = array('tipo'=>'EC');
            $data['projetos'] = $this->default_model->get_all('projetos', $campos = array('*'), $offset = NULL, $limit =10, $where, $join = NULL, $order_by = 'id', $dir = 'DESC');

           $where = array('url'=>'nossos-diferenciais');
            $data['diferenciais'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $where = array('url'=>'cultura-organizacional');
            $data['cultura'] = $this->default_model->get_all('paginas', $campos = array('*'), $offset = NULL, $limit =1, $where, $join = NULL, $order_by ='id', $dir = 'DESC');

            $dados = array('url_pagina'=>$data['url_pagina'],'projetos'=>$data['projetos'],'diferenciais'=>$data['diferenciais'][0],'cultura'=>$data['cultura'][0]);

	      	//Box destaques
	      	$where = array('idioma_id' => $this->session->userdata('idioma_id'));
	      	$dados['box_destaques'] = $this->default_model->get_all('noticias', array('*'),  NULL, 2, $where + array('tipo' => 'D'), NULL, $order_by = 'data', $dir = 'DESC');
	      	$dados['box_news'] = $this->default_model->get_all('noticias', array('*'),  NULL, 1, $where + array('tipo' => 'N'), NULL, $order_by = 'data', $dir = 'DESC');

            //Carrega view
            $this->loadView('servicos-coorporativo', $dados);
	}





}
