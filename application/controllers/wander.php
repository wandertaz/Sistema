<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wander extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	var $graus_formacao = array('EF' => 'Ensino Fundamental', 'EM' => 'Ensino Médio', 'GR' => 'Graduação', 'PG' => 'Pós-graduação/MBA', 'ME' => 'Mestrado', 'DO' => 'Doutoria');
	var $tipos_contrato = array('CL' => 'CLT', 'PJ' => 'Prestador de Serviço (PJ)', 'TE' => 'Temporário', 'AU' => 'Autônomo', 'ES' => 'Estágio', 'TR' => 'Trainee');
	var $niveis_idiomas = array('N' => 'Nenhum', 'B' => 'Básico', 'I' => 'Intermediário', 'A' => 'Avançado', 'F' => 'Fluente');


	public function __construct(){

	parent::__construct();
                $data['title'] = 'MB Consultoria - Serviços';
		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('text_helper');
                $this->load->library('pagination');
                $this->load->helper('auxiliar1_helper');


	}

	public function index($msg=false){
             $this->loadView('wander');
        }
        public function salvar($msg=false){
            
            
           //multiple_upload($name = 'userfile', $upload_dir, $allowed_types = 'gif|jpg|jpeg|jpe|png|doc', $size = 0, $rename = false, $overwrite = false, $encrypt_name = false);
            $retorno=multiple_upload('ArquivoObjetivos','./assets/teste/',null,0,date('dmYHis'),false,false);
            
            print_r($retorno);
          
        }
}