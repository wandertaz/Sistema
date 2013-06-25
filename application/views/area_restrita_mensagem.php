<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class area_restrita_mensagem extends MY_Controller {

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
                $this->load->library('pagination');
                $this->load->helper('auxiliar_helper');


	}

	public function index($offset = 0){

                check_login_aluno();
                $id= $this->session->userdata('SessionIdAluno');

                 //mensagens
                 //mensagem_resposta
                 //mensagens_destinatarios
                 
		//area que baixa as mensagens
		$this->db->select('mensagens.id,  mensagens.remetente_id,mensagens_destinatarios.lido,mensagens.assunto, mensagens.created,mensagens.texto ,usuario.nome usuario,inscritos.nome inscritos,mensagens.tipo_remetente');
		$this->db->from('mensagens');
                $this->db->join('mensagens_destinatarios', 'mensagens_destinatarios.mensagem_id = mensagens.id');
                $this->db->join('inscritos', 'inscritos.id = mensagens.remetente_id', 'left');
                $this->db->join('usuario', 'usuario.id = mensagens.remetente_id', 'left');
		$this->db->where(array('mensagens_destinatarios.destinatario_id'=>$id,'mensagens_destinatarios.data_desativacao is Null'=>null,'mensagens_destinatarios.tipo_destinatario'=>'A'));
                $this->db->limit(15,$offset);
		$this->db->order_by('lido, created');
		$query = $this->db->get();
		$data['mensagens']= $query->result();
        $data['mensagens_lateral'] = $query->result();
                //print_r($data['mensagens'][1]);
                //exit();

		



		 $this->db->count_all_results('mensagens');
                 $this->db->from('mensagens');
                 $this->db->join('mensagens_destinatarios', 'mensagens.id=mensagens_destinatarios.mensagem_id');                
                 $this->db->where(array('mensagens_destinatarios.destinatario_id'=>$id,'mensagens_destinatarios.data_desativacao is Null'=>null,'mensagens_destinatarios.tipo_destinatario'=>'A'));
                 $max_registros= $this->db->count_all_results();

                $config['base_url'] = site_url().'area_restrita_mensagem/index';
                $config['total_rows'] = $max_registros;
                $config['per_page'] = 15;

                $this->pagination->initialize($config);
                $data['paginacao'] = $this->pagination->create_links();

        $dados = array_merge($data);

		$this->loadView('area-restrita-mensagem',$dados);

	}
	public function mensagem_aberta(){
		 check_login_aluno();

                $id= $this->session->userdata('SessionIdAluno');

                $data2 = array(
                    'lido' => 'S'
                 );
                $this->db->where(array('mensagem_id'=>$_GET['id'],'destinatario_id'=>$id,'tipo_destinatario'=>'A'));
                $this->db->update('mensagens_destinatarios', $data2);


		//area que baixa as mensagens
		$this->db->select('mensagens.id,  mensagens.remetente_id,mensagens_destinatarios.lido,mensagens.assunto, mensagens.created,mensagens.texto ,usuario.nome usuario,inscritos.nome inscritos,mensagens.tipo_remetente');
		$this->db->from('mensagens');
                $this->db->join('mensagens_destinatarios', 'mensagens_destinatarios.mensagem_id = mensagens.id');
                $this->db->join('inscritos', 'inscritos.id = mensagens.remetente_id', 'left');
                $this->db->join('usuario', 'usuario.id = mensagens.remetente_id', 'left');
		$this->db->where(array('mensagens.id'=>$_GET['id']));        
		$this->db->order_by('lido, created'); 
		$query = $this->db->get();                
		$data['mensagens']= $query->result();
                
                
                // select das respostas
                $this->db->select('texto,created,inscritos.nome inscritos, usuario.nome usuario,tipo_remetente');
                $this->db->from('mensagem_resposta');
                $this->db->join('inscritos','inscritos.id=mensagem_resposta.remetente_id','left');
                $this->db->join('usuario','usuario.id=mensagem_resposta.remetente_id','left');
                $this->db->where(array('mensagem_resposta.id_mensagem'=>$_GET['id']));
                $this->db->order_by('created');
                $query_resposta = $this->db->get(); 
                $data['mensagem_resposta']= $query_resposta->result();
                               

                $dados= array_merge($data);

		//print_r(count($data['mensagem_resposta']));
		//exit;
		$this->loadView('area-restrita-mensagem-aberta',$dados);
	}
	public function responder_mensagem(){

		 check_login_aluno();
                 $id= $this->session->userdata('SessionIdAluno');
		
                // insere a resposta
                 $data = array(
	   		'id_mensagem' => $_POST['id_mensagem'] ,
	   		'texto' =>  $_POST['resposta'] ,
			'remetente_id' =>  $id ,
                        'tipo_remetente '=>'A',
			'created'=> date("Y-m-j H:i:s")

		);
		$this->db->insert('mensagem_resposta', $data);
                
                //seta a msnsagem para todos os destinatarios como não lida
                 $data2 = array(
                    'lido' => 'N',
                     'data_desativacao'=>null
                 );
                $this->db->where(array('mensagem_id'=>$_POST['id_mensagem']));
                $this->db->update('mensagens_destinatarios', $data2);

		header('Location:'.site_url().'area_restrita_mensagem/mensagem_aberta?id='.$_POST['id_mensagem'].'msg=1');

	}

    	public function deletar_mensagem(){

		check_login_aluno();
                $id= $this->session->userdata('SessionIdAluno');

		$data = array(	   		
			'data_desativacao'=> date("Y-m-j H:i:s")
		);
		$this->db->where(array('mensagem_id'=> $_GET['id_mensagem'],'destinatario_id'=>$id,'tipo_destinatario'=>'A'));
                $this->db->update('mensagens_destinatarios', $data); 

		header('Location:'.site_url().'area_restrita_mensagem');

	}
        
            	public function nova_mensagem(){

		check_login_aluno();
                $id= $this->session->userdata('SessionIdAluno');

		$data = array(	   		
			'data_desativacao'=> date("Y-m-j H:i:s")
		);


		$this->loadView('area-restrita-nova-mensagem',$data);

	}
        
        public function salva_nova_mensagem(){
            
            check_login_aluno();
            $id= $this->session->userdata('SessionIdAluno');
            
           
            //area ve o id do professor
            $this->db->select('inscricoes.curso_id, elearning.instrutor_id');
            $this->db->from('inscricoes');
            $this->db->join('elearning', 'inscricoes.curso_id=elearning.id');
            $this->db->where(array('inscricoes.tipo_curso'=>'EL','inscricoes.inscrito_id'=>$id,'inscricoes.status'=>'AP'));
            $this->db->limit(1);
            $this->db->order_by('created desc');
            $query_resposta = $this->db->get(); 
            $data['mensagem_resposta']= $query_resposta->result();
            
           $id_intrutor=$data['mensagem_resposta'][0]->instrutor_id;
          
            
            
             // insere a MENSAGEM
             $data = array(
                    'curso_id' => $data['mensagem_resposta'][0]->curso_id ,
                    'tipo_curso' =>  'EL' ,
                    'remetente_id' =>  $id ,
                    'tipo_remetente '=>'A',                 
                    'assunto '=>$_POST['assunto'],
                    'texto '=>$_POST['resposta'],                 
                    'created'=> date("Y-m-j H:i:s")

            );
             
            $this->db->insert('mensagens', $data);
            $id_mensagem = mysql_insert_id();
            
             // insere o destinatario istrutor
             $data = array(
                    'mensagem_id' => $id_mensagem ,
                    'destinatario_id' => $id_intrutor ,
                    'tipo_destinatario' =>  'I' ,
                    'lido '=>'N',                         
                    

            );
            $this->db->insert('mensagens_destinatarios', $data);
            
            
              // insere o destinatario quem fez
             $data = array(
                    'mensagem_id' => $id_mensagem ,
                    'destinatario_id' => $id ,
                    'tipo_destinatario' =>  'A' ,
                    'lido '=>'S',                         
                    

            );
            $this->db->insert('mensagens_destinatarios', $data);
            
           
            header('Location:'.site_url().'area_restrita_mensagem/nova_mensagem?msg=1');
      

        }





}
