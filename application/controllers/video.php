<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class video extends MY_Controller {

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
                $this->load->helper('email');
                $this->load->library('email');
                $this->load->helper('auxiliar_helper');
	}

	public function index(){
            
            $data['video']=array('codigovideo'=>$_GET['codigovideo']);	
            
            //Carrega view
            $this->loadView('videos', $data);
                
        }
        
}