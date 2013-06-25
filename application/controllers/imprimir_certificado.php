<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imprimir_certificado extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	public function __construct(){
		parent::__construct();
        $data['title'] = 'MB Consultoria - Certificado';
		//Carrega model e helpers
		$this->load->model("certificados_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('text_helper');
                $this->load->helper('auxiliar_helper');
        $this->load->helper(array('dompdf', 'file', 'br_date'));
	}

	public function index(){
		
			//Checando se o usuário está logado
			check_login_aluno();

            //Pegando a ID do usuário logado
			$aluno = $this->session->userdata('SessionIdAluno');

			//Resgandando parametros enviados por GET
			$curso_id = $_GET['idc'];
			$curso_type = $_GET['tc'];

			//Carregando dados do usuário para impressão
			$usuario = $this->certificados_model->get_user_logged($aluno);
			$certificados = $this->certificados_model->print_certificado($aluno,$curso_id);	
			$cursos = $this->certificados_model->get_curso($curso_id, $curso_type);				

			//Armazenando dados que serão enviados para a VIEW
			$dados_pdf['usuario'] = $usuario[0]['nome'];
			$dados_pdf['curso'] = $cursos[0]['titulo'];
			$dados_pdf['tipo'] = $curso_type;

			if ($curso_type!="EL") {
				$dados_pdf['carga_horaria'] = $cursos[0]['carga_horaria'];
                                $dados_pdf['data_de_inicio']=$cursos[0]['data_inicio'];
			}
                       
                        $dados_pdf['data_de_conclusao']=$certificados[0]['data_conclusao'];
			//$data_de_conclusao = explode('-', $certificados[0]['data_conclusao']);
			//$dados_pdf['data_de_conclusao'] = $data_de_conclusao[2].' de '.br_month($data_de_conclusao[1]).' de '.$data_de_conclusao[0];
			
			//Carregando a VIEW e armazenando conteudo em uma Variável
		    $html = $this->load->view('area-restrita-emitir-certificado', $dados_pdf, true);

		    //Imprimindo PDF na tela
		    pdf_create($html, $dados_pdf['curso'].' Certificado Digital - MB Consultoria');


    }

  
 }
