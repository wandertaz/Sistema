<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('html');
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
}
