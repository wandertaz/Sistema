<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class maisdetalhesaluno extends MY_Controller {
      
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
                $this->load->helper('login_helper');
	}

	public function index($id_aluno){
		
	        check_login_empresa();
                
                
                if($id_aluno){          
                    
                    //aqui pega os dados do usuario para mostrar o cadastro
                    $this->db->select('*');
                    $this->db->from('inscritos');                   
                    $array= array('inscritos.id'=>$id_aluno);
                    $this->db->where($array);                    
                    $query_inscrito = $this->db->get();
                    $data['detalhes_aluno']=$query_inscrito->result();
                   
                    $dados= array_merge($data);
                    $this->loadView('area-restrita-mais-detalhes-aluno',$dados);
                }
        }
        
}