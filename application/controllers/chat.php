<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class chat extends MY_Controller {

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
                $this->load->helper('chat_helper');


	}
        public function aa(){
            
            $IdChat =1; //$_SESSION['current_chat'];       
       
            $this->db->select('IdMensagem,Mensagem,DataHoraMensagem,Status,MensagemRespostaDe,IdAutor');
            $this->db->from('Chat');
            $this->db->where(array('IdChat'=>$IdChat));
            $this->db->order_by('DataHoraMensagem DESC');       
            $query = $this->db->get();                
            $data['registro']= $query->result();
            
            print_r($data['registro']);
            exit();
            
            

        }
	public function index(){
            
            check_login_aluno();
            
            
             //verifica o tipo do ID    DO curso
            $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id');
            $this->db->from('inscricoes');
            $this->db->where(array('inscricoes.id'=>$this->session->userdata('SessionCurso')));
            $query = $this->db->get(); 
            $data1=$query->result();
            $tipo_curso=$data1[0]->tipo_curso;               
            $curso_id=$data1[0]->curso_id;
            
            $data['curso'] = array(
                'lido' => 'S',
                'curso_id'=>$curso_id
            );
            
            $this->loadView('area-restrita-chat',$data);
            
        }
        
       public function AppSetMsg(){ 
           
           
        $IdAutor = $_POST['current-user'];
        $IdChat = $_POST['id-chat'];
        $Mensagem = $_POST['mensagem'];
        $DataHoraMensagem = date("Y-m-d H:i:s");
        $Status = $_POST['status'];

        if ($Mensagem != ''){
            
                $data = array(
                    'IdAutor' => $IdAutor,
                    'IdChat' => $IdChat ,
                    'Mensagem' => $Mensagem,
                    'DataHoraMensagem' => $DataHoraMensagem,                   
                    'Status' => $Status
                    
                 );

                $this->db->insert('Chat', $data); 
                
               $this->loadView('area-restrita-chat',$data);
            
           
        }

   }
   public function AppSetQuestions(){
       
       
        $IdAutor = $_POST['current-user'];
        $IdChat = $_POST['id-chat'];
        $Mensagem = $_POST['mensagem'];
        $DataHoraMensagem = date("Y-m-d H:i:s");
        $Status = 'resposta';

        $MensagemRespostaDe = implode(',',$_POST['checked-for-question']);



        // $str = implode(',',$checkedForReply);
        // $arr=explode(",",$str);
        // print_r($arr);

        if ($Mensagem != ''&&$MensagemRespostaDe){
	
                $data = array(
                    'IdAutor' => $IdAutor,
                    'IdChat' => $IdChat ,
                    'Mensagem' => $Mensagem,
                    'DataHoraMensagem' => $DataHoraMensagem,                   
                    'Status' => $Status,
                    'MensagemRespostaDe'=>$MensagemRespostaDe
                    
                 );

                $this->db->insert('Chat', $data); 

            if ($_POST['checked-for-question']) {
                    foreach ($_POST['checked-for-question'] as $Pergunta) {
                            $data = array(                                           
                            'Status' => 'pergunta-respondida'                       

                         );
                         $this->db->where(array('IdMensagem'=>$Pergunta));
                         $this->db->update('Chat',$data);
                     }
            }
        }
       
   }
   public function AppCountMsg(){
       
       $this->db->select('IdMensagem');
       $this->db->from('Chat');
       $this->db->where(array('IdMensagem'=>$Pergunta));
       $this->db->order_by('IdMensagem DESC');       
       $query = $this->db->get();                
       $data['registro']= $query->result();
       echo $data['registro'][0]->IdMensagem;
       
   }
   public function AppGetMsg(){
       
       //$_SESSION['current_user'] = 8;
      // $_SESSION['current_chat'] = 1;
       
       $Idcurrent_user =$this->session->userdata('SessionIdAluno');
       
        //verifica o  ID  DO curso
        $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id');
        $this->db->from('inscricoes');
        $this->db->where(array('inscricoes.id'=>$this->session->userdata('SessionCurso')));
        $query = $this->db->get(); 
        $data1=$query->result();
        $tipo_curso=$data1[0]->tipo_curso;               
        $curso_id=$data1[0]->curso_id;
       
       
       $IdChat =$curso_id;
       
       
       $this->db->select('IdMensagem,Mensagem,DataHoraMensagem,Status,MensagemRespostaDe,IdAutor');
       $this->db->from('Chat');
       $this->db->where(array('IdChat'=>$IdChat));
       $this->db->order_by('DataHoraMensagem DESC');       
       $query = $this->db->get();                
       $data['registro']= $query->result();
       
     
    //faz um looping e cria um array com os campos da consulta
      foreach ($data['registro'] as $itens) {
      //mostra na tela o nome e a data de nascimento
      if($itens->Status=='resposta'){
        if ($Idcurrent_user==$itens->IdAutor) {
            echo '<li class="li-no-question current_author_on" id="'.$itens->IdMensagem.'">'.$itens->Mensagem;
        }else{
            echo '<li class="li-no-question" id="'.$itens->IdMensagem.'">'.$itens->Mensagem;
        }
  	echo '<ul class="resposta">';
      
	$arr=explode(",",$itens->MensagemRespostaDe);
  	foreach ($arr as $perguntaRespondida) {
            
            $this->db->select('IdMensagem,Mensagem,IdAutor');
            $this->db->from('Chat');
            $this->db->where(array('IdChat'=>$IdChat,'IdMensagem'=>$perguntaRespondida));
            $this->db->order_by('DataHoraMensagem DESC');       
            $query = $this->db->get();                
            $data['array']= $query->result();

            foreach ($data['array'] as $array2) {
        
            if ($Idcurrent_user==$array2->IdAutor) {
                echo '<li class="current_author_on" id="'.$array2->IdMensagem.'">'.$array2->Mensagem.'</li>';
            }else{
                echo '<li id="'.$array2->IdMensagem.'">'.$array2->Mensagem.'</li>';
            }
	  }
  	}
  	echo '</ul></li>';
    }else{
        if ($Idcurrent_user==$itens->IdAutor) {
          echo '<li class="li-no-question current_author_on" id="'.$itens->IdMensagem.'">'.$itens->Mensagem;
        }else{
          echo '<li class="li-no-question" id="'.$itens->IdMensagem.'">'.$itens->Mensagem;
        } 	
    }

  }
 }
   
  public function AppGetQuestions(){
        
      
        $Idcurrent_user =$this->session->userdata('SessionIdAluno');
       
        //verifica o  ID  DO curso
        $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id');
        $this->db->from('inscricoes');
        $this->db->where(array('inscricoes.id'=>$this->session->userdata('SessionCurso')));
        $query = $this->db->get(); 
        $data1=$query->result();
        $tipo_curso=$data1[0]->tipo_curso;               
        $curso_id=$data1[0]->curso_id;       
       
        $IdChat =$curso_id;
       
        $this->db->select('IdMensagem,Mensagem');
        $this->db->from('Chat');
        $this->db->where(array('Status'=>'pergunta-aberta','IdChat'=>$IdChat));
        $this->db->order_by('IdMensagem DESC');       
        $query = $this->db->get();                
        $data['array']= $query->result();

        //faz um looping e cria um array com os campos da consulta
          foreach ($data['array'] as $array) {          
          //mostra na tela o nome e a data de nascimento
          echo '<li id="'.$array->IdMensagem.'" class="checkBox"><input type="checkbox" class="check-for-question" value="'.$array->IdMensagem.'" name="checked-for-question[]" id="">'.$array->Mensagem.'</li>';
          }

   }
        
}