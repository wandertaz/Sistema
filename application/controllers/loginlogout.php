<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loginlogout extends MY_Controller {

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
                $this->load->helper('login_helper');
                $this->load->helper('auxiliar_helper');

	}

        public function index($mensagem = false){

        	//Título
        	$data['title'] = 'Login';

        	$data['url'] = isset($_GET['url']) ? $_GET['url'] : false;

        	//Carrega view
        	$data['mensagem'] = $mensagem;
        	$this->loadView('login', $data);

        }
        
         public function mensagem_erro(){
             //$titulo=false,$mensagem = false,$url=false
             $get=$_GET;
            
             if ($get['titulo']){
                  $data['title'] =$get['titulo'];
             }
             else{
                   $data['title'] = 'Erro';              
             }
             
              //mensagem
              if (isset($get['mensagem'])){                
                
                 $data['mensagem'] =$get['mensagem'];   
             }
             else{
                 $data['mensagem'] = 'Erro';               
             }
        	
             /*if(isset($get['url'])){
                $data['url'] = $get['url'];
                 
             }*/
        	

        	//Carrega view        	
        	$this->loadView('mensagem_erro', $data);

        }
        
        
        
        
        
        
        

        public function login(){

            //check_login_aluno();
            $post = $_POST;
            if(trim($post['usuario'])=='' ||trim($post['senha'])==''){

                return $this->index('Preencha o E-mail e a Senha corretamente.');
            }

            $this->db->select('id,nome,email,data_nascimento,tipo_pessoa');
	    $this->db->from('inscritos');
            $this->db->where(array('email'=>$post['usuario'],'senha'=>$post['senha'],'ativo'=>'S'));
            $query = $this->db->get();

            $data= $query->result();


            //  tipo_pessoa grava se  e pessoa fisica ou juridica
            if (isset($data[0]->id)){

                // destroy a sessão antiga ja que temos 2 tipos de ssesion empresas e alunos
                destroy_session_antiga();

                if ($data[0]->tipo_pessoa =='F'){

                    //aqui verifica se o usuario tem permissão em alguma empresa e aonde
                    $this->db->select('area_permissoes_area_permissoes_id areas, area_permissoes_concedidas_id_empresa empresa');
                    $this->db->from('area_permissoes_concedidas');
                    $this->db->where(array('inscritos_id'=>$data[0]->id));
                    $query = $this->db->get();
                    $data_permissoes= $query->result();
                    $string_permissao='';

                    if($query->num_rows>0){
                        foreach ($data_permissoes as $item){

                           $string_permissao.='--'.$item->areas.'--';

                        }
                        $dados_permissao = array('logged_in_Permissao_Juridica' => TRUE,
                                       'SessionAreaPermissoes' => $string_permissao,
                                       'SessionEmpresaPermissoes' => $data_permissoes[0]->empresa
                                );
                       $this->session->set_userdata($dados_permissao);
                    }


                 $dados = array('logged_in_Aluno' => TRUE,
                 'SessionIdAluno' 	  => $data[0]->id,
                 'SessionTipoPessoa' 	  => $data[0]->tipo_pessoa,
                 'SessionNomeAluno' 	  => $data[0]->nome,
                 'SessionEmailAluno' 	  => $data[0]->email,
                 'SessionDtNascimento' 	  => br_date($data[0]->data_nascimento)

                 );
                $this->session->set_userdata($dados);

                if(isset($post['url']) && $post['url'])
                	redirect($post['url']);
                else
					redirect('menu_interno');

                }

                elseif ($data[0]->tipo_pessoa =='J'){
                        $dados = array(
                     'logged_in_Empresa' => TRUE,
                     'SessionIdEmpresa' 	  => $data[0]->id,
                     'SessionTipoPessoa' 	  => $data[0]->tipo_pessoa,
                     'SessionNomeEmpresa' 	  => $data[0]->nome,
                     'SessionEmailEmpresa' 	  => $data[0]->email,
                     'SessionDtCriacao' 	  => br_date($data[0]->data_nascimento)

                     );
                    $this->session->set_userdata($dados);

                	if(isset($post['url']) && $post['url'])
                		redirect($post['url']);
                	else
                		redirect('menu_interno');

                }else{

                     return $this->index('Usuário ou Senha inválidos');
                }
            }
            else{

                return $this->index('Usuário ou Senha inválidos');

            }
        }

	public function logout(){

                // Encerra  sessão referentes as permissões dadas as pessoas fisicas pelas empresas
                $this->session->unset_userdata('logged_in_Permissao_Juridica');
                $this->session->unset_userdata('SessionAreaPermissoes');
                $this->session->unset_userdata('SessionEmpresaPermissoes');

		//Encerra sessão referentes ao aluno
		$this->session->unset_userdata('logged_in_Aluno');
		$this->session->unset_userdata('SessionIdAluno');
		$this->session->unset_userdata('SessionNomeAluno');
		$this->session->unset_userdata('SessionEmailAluno');
		 $this->session->unset_userdata('SessionDtNascimento');
                //Encerra sessão referentes ao Empresa e aluno

                 //deleta itens do carrinho
                 $this->session->unset_userdata('carrinho');

                //Encerra sessão referentes ao Empresa
		$this->session->unset_userdata('logged_in_Empresa');
		$this->session->unset_userdata('SessionIdEmpresa');
		$this->session->unset_userdata('SessionNomeEmpresa');
		$this->session->unset_userdata('SessionEmailEmpresa');
                $this->session->unset_userdata('SessionDtCriacao');

                 //Encerra sessão que controla o menu da Area restrita
                 $this->session->unset_userdata('Session_menu_area_restrita');

                 //Encerra sessão que controla a pasta selecionada de armazenamento nas nuvens
                 $this->session->unset_userdata('Session_pasta_selecionada');




		//Redireciona para página inical
		$data['mensagem'] = 'Logout efetuado com sucesso.';
		$this->loadView('login', $data);
	}

	public function recuperar_senha(){

		$msg 		= 'Por favor preencha o campo abaixo com seu e-mail. Você receberá uma nova senha para acesso à area restrita.';
		$nomebotao	='Enviar';

		//Carrega view
		$this->loadView('recuperar_senha', array('msg' => $msg, 'nomebotao' => $nomebotao));
	}

	public function envia_senha(){

		//Busca usuário
		$data = $_POST;
		$this->db->select('id, nome, email');
		$this->db->from('inscritos');
		$this->db->where(array('email' => $data['email'], 'ativo '=> 'S'));
		$query = $this->db->get();
		$usuario = $query->result();
		$usuario = isset($usuario[0]) ? $usuario[0] : false;

		//Envio de email
		if($usuario){

			//Gera senha
			$aux = $usuario->id.time();
			$senha = substr(md5($aux),0,6);
			$this->default_model->update('inscritos', $usuario->id, array('senha' => $senha), 'id');

			//E-mail com a senha
			$conteudo = $this->load->view('email_esqueceu_senha', array('nome' => $usuario->nome, 'email' => $usuario->email, 'senha' => $senha), true);

			//carrega library de email
			$this->load->library('email');
			$config['protocol'] = 'mail';
			$config['mailtype'] = 'html';

			//Parâmetros
			$this->email->initialize($config);
			$this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
			$this->email->to($usuario->email, $usuario->nome);
			$this->email->subject('MB CONSULTORIA - NOVA SENHA');
			$this->email->message($conteudo);
			if($this->email->send())
				$data = array('msg' => 'Sua nova senha foi enviada paro o e-mail cadastrado.', 'titulo' => 'RECUPERAR SENHA', 'sucesso' => '1');
			else
				$data = array('msg' => 'Não foi possível enviar uma nova senha.', 'titulo' => 'RECUPERAR SENHA', 'sucesso' => '0');

		}
		else{
			$data = array('msg' => 'Usuário não encontrado. Verifique se o e-mail de cadastro está correto.', 'titulo' => 'RECUPERAR SENHA', 'sucesso' => '0');
		}

		$this->loadView('recuperar_senha_retorno', $data);
	}

}
