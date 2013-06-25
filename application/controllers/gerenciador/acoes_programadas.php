<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class acoes_programadas extends CI_Controller {

	var $titulo 		= 'CRM';
	var $dir 		= 'multitools/acoes_programadas/';
	var $controller 	= 'multitools/acoes_programadas/';
	var $title_sing 	= 'CRM';
	var $per_page 		= 20;
	var $table              = 'vw_acoes_programadas';
	var $join		= NULL;

	public function __construct(){
		parent::__construct();
		check_login();
		$this->load->helper("br_date_helper");
		$this->load->model("certificados_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('text_helper');
                $this->load->helper('auxiliar_helper');
                
	}

	public function index($direction_order_by = 'ASC', $campo_order_by = 'data',$offset = 0){
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;
		//Menu
		get_menu();
                
		$where = NULL;
                
                $data['ordem'] = ($direction_order_by == 'ASC'? 'DESC':'ASC');
                $data['campo'] = $campo_order_by;
                $data['pagina'] = $offset;

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*'),$offset, $this->per_page, $where, $this->join, array( $campo_order_by => $direction_order_by));

                
		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false,$direction_order_by,$campo_order_by);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;
               
                //Carrega view
                $this->load->view($this->dir.'index', $data);                    
              
		get_footer(TRUE);
	}

        private function _pagination($table, $search = FALSE,$direction_order_by = 'ASC',$campo_order_by = 'data'){

                //Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, array(), $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s');
		}
		else{
			$config['uri_segment'] = 6;
			$config['total_rows']  = $this->default_model->count($this->table, array(), $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$direction_order_by.'/'.$campo_order_by;
		}

		//Inicializa e retorna paginação
		$this->pagination->initialize($config);
		return $this->pagination->create_links();

	}
        

}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */