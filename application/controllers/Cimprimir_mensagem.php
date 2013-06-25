<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//ttt
class Cimprimir_mensagem extends MY_Controller {

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
                $this->load->library('pagination');


	}

	public function index(){
            
            
            
                //area que baixa as mensagens
		$this->db->select('mensagens.id,  mensagens.remetente_id,mensagens_destinatarios.lido,mensagens.assunto, mensagens.created,mensagens.texto ,usuario.nome usuario,inscritos.nome inscritos,mensagens.tipo_remetente');
		$this->db->from('mensagens');
                $this->db->join('mensagens_destinatarios', 'mensagens_destinatarios.mensagem_id = mensagens.id');
                $this->db->join('inscritos', 'inscritos.id = mensagens.remetente_id', 'left');
                $this->db->join('usuario', 'usuario.id = mensagens.remetente_id', 'left');
		$this->db->where(array('mensagens.id'=>$_GET['id_mensagem']));        
		$this->db->order_by('lido, created'); 
		$query = $this->db->get();                
		$data['mensagens']= $query->result();
                
                
                // select das respostas
                $this->db->select('texto,created,inscritos.nome inscritos, usuario.nome usuario,tipo_remetente');
                $this->db->from('mensagem_resposta');
                $this->db->join('inscritos','inscritos.id=mensagem_resposta.remetente_id','left');
                $this->db->join('usuario','usuario.id=mensagem_resposta.remetente_id','left');
                $this->db->where(array('mensagem_resposta.id_mensagem'=>$_GET['id_mensagem']));
                $this->db->order_by('created');
                $query_resposta = $this->db->get(); 
                $data['mensagem_resposta']= $query_resposta->result();
                               

                $dados= array_merge($data);
            
            $this->loadView('imprimir_mensagem',$dados);
            
        }
}
