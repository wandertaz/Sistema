<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class localizacao extends MY_Controller {

    //Retira a proteção deste controller
    protected $_dontProtectMe = true;

    public function __construct(){

        parent::__construct();
        $data['title'] = 'MB Consultoria - Serviços';
        //Carrega model e helpers

        $this->load->model('default_model');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->helper('text_helper');
        $this->load->helper('auxiliar_helper');
        $this->load->helper('email');
        $this->load->library('email');
    }

    public function index() {

        $titulo = 'Localização - Mb Consultoria';
        $msg ='Desde de já agradecemos seu contato. Por favor preencha os campos abaixo, responderemos assim que possível. Campos com * são de preenchimento obrigatório.';
        $action ='contato/enviacontato';
        $nomebotao = 'Enviar';
        $data = array('action'=>$action,'titulo'=>$titulo,'msg'=>$msg,'nomebotao'=>$nomebotao);
        //Carrega view

        $this->loadView('localizacao',$data);
    }
}