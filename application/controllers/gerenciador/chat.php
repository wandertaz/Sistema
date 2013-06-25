<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class chat extends CI_Controller {

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
		check_login();
		check_login_chat();


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

		//Cabeçalho
		get_header('Chat', TRUE);
		$data['h1'] = 'Chat';

		//Menu
		get_menu();

		$data = array(
		        'lido' => 'S'
		     );

		$this->load->view('multitools/chat/index',$data);
		get_footer(TRUE);

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

			$this->load->view('multitools/chat/index',$data);


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

		$Idcurrent_user = 1;//$_SESSION['current_user'];
		$IdChat = $this->session->userdata('chat_curso_id'); //$_SESSION['current_chat'];


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
		$Idcurrent_user =1;//$_SESSION['current_user'];
		$IdChat = $this->session->userdata('chat_curso_id'); //$_SESSION['current_chat'];

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
/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */