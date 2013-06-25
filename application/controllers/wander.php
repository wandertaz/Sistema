<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wander extends MY_Controller {

	//Retira a prote��o deste controller
	protected $_dontProtectMe = true;

	var $graus_formacao = array('EF' => 'Ensino Fundamental', 'EM' => 'Ensino M�dio', 'GR' => 'Gradua��o', 'PG' => 'P�s-gradua��o/MBA', 'ME' => 'Mestrado', 'DO' => 'Doutoria');
	var $tipos_contrato = array('CL' => 'CLT', 'PJ' => 'Prestador de Servi�o (PJ)', 'TE' => 'Tempor�rio', 'AU' => 'Aut�nomo', 'ES' => 'Est�gio', 'TR' => 'Trainee');
	var $niveis_idiomas = array('N' => 'Nenhum', 'B' => 'B�sico', 'I' => 'Intermedi�rio', 'A' => 'Avan�ado', 'F' => 'Fluente');


	public function __construct(){

	parent::__construct();
                $data['title'] = 'MB Consultoria - Servi�os';
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