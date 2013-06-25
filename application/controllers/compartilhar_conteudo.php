<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class compartilhar_conteudo extends MY_Controller {

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
                $this->load->helper('download');
                $this->load->helper('auxiliar_helper');
	}

	public function download(){  
            
          $dados = file_get_contents ("assets/uploads/".$_GET['arquivo']) ;
          $name = $_GET['aula_id'].'-'.$_GET['arquivo']; 
          force_download ($name, $dados);             
            
        }
}