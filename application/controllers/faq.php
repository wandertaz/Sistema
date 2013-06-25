<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class faq extends MY_Controller {

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

	public function index(){

		//Título
    	$data['title'] = 'faq';
		$data['url_pagina'] = 'faq';

		//Carrega view
		$this->loadView('faq', $data);  
	}

	
}
