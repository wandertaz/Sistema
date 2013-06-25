<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class menu_interno extends MY_Controller {

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
            
            
            
          /*  $email  = '--1--3--6--4-';
            $domain = strpos($email, '-1-');
            print_r($domain); // prints @example.com
            exit(); */           
            
            
            
            
            
            
            
            $tipopessoa= $this->session->userdata('SessionTipoPessoa');
            
            if ($tipopessoa=='F'){
                
                check_login_aluno();
            }
            elseif ($tipopessoa=='J'){
                 check_login_empresa();               
                 
            }
             //$this->loadView('area-restrita-central');
             $this->loadView('area-restrita-dashboard');
        }

        /*public function dashboard(){
             $this->loadView('area-restrita-dashboard');
        }*/
        
}