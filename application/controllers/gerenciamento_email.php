
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gerenciamento_email extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	//var $per_page = 4;

	public function __construct(){
		parent::__construct();


		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('br_date');
                $this->load->helper('auxiliar_helper');
	}

        public function avise_me($curso_id,$tipo_curso,$msg=false){

            $data['titulo'] = 'Avise-me de novas turmas';
            $data['msg'] =$msg;
            $data['curso']=array('curso_id'=>$curso_id,'tipo_curso'=>$tipo_curso);

            $this->db->select('disponibilidadehorario_id,disponibilidadehorario_nome');
            $this->db->from('disponibilidadehorario');
            $this->db->where(array('ativo'=>'S'));
            $this->db->order_by('ordem','asc');
            $query = $this->db->get();
            $data['disponibilidade']=$query->result();

            $this->loadView('avisar', $data);
        }



         public function avise_me_salvar(){


            $data['titulo'] = 'Indique a um amigo';
            $dat['insert']=$_POST;

            //$data['msg'] =$msg;
            $data['curso']=array('curso_id'=>$dat['insert']['curso_id'],'tipo_curso'=>$dat['insert']['tipo_curso']);

            $id = $this->db->insert('avise_me',$dat['insert']);

            if($id<=0){
                 $data['msg'] ='Erro ao enviar solicitação!';
                 $this->loadView('avisar', $data);
            }
            else{
                $data['msg'] ='Entraremos em contato em breve!';
                $this->loadView('avisar-sucesso', $data);
            }



        }

        public function indicar_amigo($curso_id,$tipo_curso,$msg=false){

		$data['titulo'] = 'Indique a um amigo';
                $data['msg'] =$msg;
                $data['curso']=array('curso_id'=>$curso_id,'tipo_curso'=>$tipo_curso);

		//Carrega view
		$this->loadView('indique', $data);
	}

        public function indicar_vaga_amigo($id_vaga,$msg=false){

        $data['titulo'] = 'Indique a um amigo';
        $data['msg'] =$msg;
        $data['vaga']=array('id_vaga'=>$id_vaga);

            //Carrega view
        $this->loadView('indique-vaga', $data);
        }


        public function indicar_vaga_envio(){

            $data['titulo'] = 'Indique a um amigo';

            if($_POST['nome']=='' || $_POST['email']=='' || $_POST['nome_destinatario']=='' || $_POST['email_destinatario']==''|| $_POST['id_vaga']==''){

                $data['msg'] ='Erro: Os campos obrigatórios devem ser preenchidos';
                $data['curso']=array('id_vaga'=>$_POST['id_vaga']);

                $this->loadView('indique-vaga', $data);

            }

            $vaga = $this->default_model->get_by_id('vagas',$_POST['id_vaga'],array(),null,array(),'id_vaga');

            // temos de cadastrar o layout do email
            $conteudo = $this->load->view('includes/email_indique_amigo', array('nome' => $_POST['nome'], 'amigo' => $_POST['nome_destinatario'], 'curso' => $vaga), true);

            //carrega library de email
            $this->load->library('email');
            $config['protocol'] = 'mail';
            $config['mailtype'] = 'html';

            //Parâmetros
            $this->email->initialize($config);
            $this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA - Indicação');
            $this->email->to(trim($_POST['email_destinatario']), trim($_POST['nome_destinatario']));
            $this->email->reply_to(trim($_POST['email_destinatario']),trim($_POST['nome_destinatario']));
            $this->email->subject('Um Amigo lhe enviou uma indicação do portal MB Consultoria');
            $this->email->message($conteudo);
            $this->email->send();

            //Carrega view
                       // return $this->indicar_amigo($_POST['curso_id'],$_POST['tipo_curso'],'E-mail foi enviado com sucesso');
                      // return $this->indicar_amigo(1,'EL','dasdasda');
            $mensagem="Email enviado com sucesso";
            redirect(site_url('gerenciamento_email/indicar_vaga_amigo/'.$_POST['id_vaga'].'/'.$mensagem));
        }


        public function indicar_amigo_envio(){

            $data['titulo'] = 'Indique a um amigo';

            if($_POST['nome']=='' || $_POST['email']=='' || $_POST['nome_destinatario']=='' || $_POST['email_destinatario']==''|| $_POST['curso_id']==''||$_POST['tipo_curso']==''){

                           // return $this->indicar_amigo($_POST['curso_id'], $_POST['tipo_curso'], 'Erro: Os campos obrigatórios devem ser preenchidos');
                $data['msg'] ='Erro: Os campos obrigatórios devem ser preenchidos';
                $data['curso']=array('curso_id'=>$_POST['curso_id'],'tipo_curso'=>$_POST['tipo_curso']);

                $this->loadView('indique', $data);
               

            }

            $tabelas_cursos   = array('AB' => 'cursos_abertos', 'IN' => 'cursos_incompany', 'AL' => 'programas_alta_performance', 'DE' => 'programas_desenvolvimento', 'EL' => 'elearning');
            $curso = $this->default_model->get_by_id($tabelas_cursos[$_POST['tipo_curso']], $_POST['curso_id']);

                        // temos de cadastrar o layout do email
            $conteudo = $this->load->view('includes/email_indique_amigo', array('nome' => $_POST['nome'], 'amigo' => $_POST['nome_destinatario'], 'curso' => $curso), true);

			//carrega library de email
            $this->load->library('email');
            $config['protocol'] = 'mail';
            $config['mailtype'] = 'html';

			//Parâmetros
            $this->email->initialize($config);
            $this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA - Indicação');
            $this->email->to(trim($_POST['email_destinatario']), trim($_POST['nome_destinatario']));
            $this->email->reply_to(trim($_POST['email_destinatario']),trim($_POST['nome_destinatario']));
			//$this->email->cc(array('luana@multiwebdigital.com.br'));
            $this->email->subject('Um Amigo lhe enviou uma indicação do portal MB Consultoria');
            $this->email->message($conteudo);
           // $this->email->send();

			//Carrega view
                       // return $this->indicar_amigo($_POST['curso_id'],$_POST['tipo_curso'],'E-mail foi enviado com sucesso');
                      // return $this->indicar_amigo(1,'EL','dasdasda');
            $data['mensagem']="Email enviado com sucesso";
            //redirect(site_url().'gerenciamento_email/indicar_amigo/'.$_POST['curso_id'].'/'.$_POST['tipo_curso'].'/'.$mensagem);
           redirect(site_url().'gerenciamento_email/indique_sucesso/');

        }
        public function indique_sucesso(){           
              $data['titulo'] = 'Indique a um amigo';
              $data['mensagem']="Email enviado com sucesso";
             $this->loadView('indique_sucesso', $data);
        }

        /* Enviar por e-mail das área de Publicações */
	public function enviar_por_email($registro_id, $tipo, $msg = false){

		$data['titulo'] 	= 'Enviar por E-mail';
		$data['msg'] 		= $msg;
		$data['registro'] 	= array('registro_id' => $registro_id, 'tipo' => $tipo);

		//Carrega view
		$this->loadView('enviar_publicacao', $data);
	}

	public function enviar_publicacao(){

		if($_POST['nome'] !== '' && $_POST['email'] !== '' && $_POST['registro_id'] !== '' && $_POST['tipo'] !== ''){

			//Busca registro
			$tabelas = array('AR' => 'artigos', 'PE' => 'pesquisas_estudos');
			$registro = $this->default_model->get_by_id($tabelas[$_POST['tipo']], $_POST['registro_id']);

			//Conteúdo
			$conteudo = $this->load->view('email_enviar_publicacao', array('nome' => $_POST['nome'], 'registro' => $registro), true);

			//carrega library de email
			$this->load->library('email');
			$config['protocol'] = 'mail';
			$config['mailtype'] = 'html';

			//Parâmetros
			$this->email->initialize($config);
			$this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
			$this->email->to(trim($_POST['email']), trim($_POST['nome']));
			$this->email->subject('Publicação enviada pelo site');
			$this->email->message($conteudo);
			$this->email->send();

			//Carrega view
			$mensagem = "Email enviado com sucesso";
			redirect(site_url().'gerenciamento_email/enviar_por_email/'.$_POST['registro_id'].'/'.$_POST['tipo'].'/'.$mensagem);

		}
		else{
			$data['titulo'] = 'Enviar por E-mail';
			$data['msg'] = 'Campos obrigatórios não preenchidos.';
			$this->loadView('enviar_publicacao', $data);
		}

	}


}