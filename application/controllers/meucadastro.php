<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class meucadastro extends MY_Controller {

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
	}
        //altera cadastro ja existente
	public function index($tipo_pessoa){
            
                if ($tipo_pessoa=="F"){
                    check_login_aluno();
                    $id= $this->session->userdata('SessionIdAluno');
                }
                elseif ($tipo_pessoa=="J"){
                    check_login_empresa();
                    $id= $this->session->userdata('SessionIdEmpresa');
                }
                         // este helper controla quem esta logado para exibir o menu da area restrita
                        seleciona_menu_area_restrita($tipo_pessoa);
                
                
                $this->db->select('inscritos.*');
                $this->db->from('inscritos');            
                $this->db->where('id',$id);
                $query = $this->db->get();                
                $data["aluno"]=$query->result();
                $data["ativo"]=array('ativo'=>1);
                $data["tipo"]=array('tipo_pessoa'=>$tipo_pessoa);
                $dados=array_merge($data);                          
                $this->loadView('area-restrita-cadastro',$dados);
            
        }
        
        public function cadastronovoaberto($tipo_pessoa='F'){
           
             $data["ativo"]=array('ativo'=>0);
             $data['tipo_pessoa']=$tipo_pessoa;
             $dados=array_merge($data); 
             if($tipo_pessoa=='F'){
                $this->loadView('area-restrita-cadastro_aberto',$dados);   
             }else{
                $this->loadView('area-restrita-cadastro_aberto_empresa',$dados);                   
             }
          
            
        }
        
        
        
        
        
        
        
        public function cadastronovo(){
           
             $data["ativo"]=array('ativo'=>0);
                $dados=array_merge($data);                          
            $this->loadView('area-restrita-cadastro',$dados);   
          
            
        }
        
        public function inserircadastro_aberto(){          
                
            $senha= trim($_POST['senha']);                
            $cpf_cnpj= str_replace("/","",str_replace("-","",str_replace(".","", trim($_POST['cpf_cnpj']))));
            
            
            $data=$_POST;
            unset($data['confirmar-senha']);
            $data['cpf_cnpj']=$cpf_cnpj;
            $data['data_nascimento']=w3c_date($_POST['data_nascimento']);
            
            if($cpf_cnpj=='' || trim($_POST['email'])==''){
                if($tipo_pessoa=='F'){
                    $dat['mensagem']="E-mail e Cpf são obrigatórios!"; 
                }else{
                    $dat['mensagem']="E-mail e Cnpj são obrigatórios!";

                }
            }else{
                $this->db->select('*');
                $this->db->from('inscritos');
                $this->db->or_where(array('cpf_cnpj'=>$cpf_cnpj,'email'=>trim($_POST['email'])));
                $query=$this->db->get();
                if($query->num_rows>0){
                    if($tipo_pessoa=='F'){
                        $dat['mensagem']="E-mail ou Cpf já foram cadastrados!";
                    }else{
                        $dat['mensagem']="E-mail ou Cnpj já foram cadastrados!";
                    }
                }else{
                    $dat['mensagem_sucesso']="Usuário cadastrado com sucesso!";           
                    $this->db->set($data);
                   if($this->db->insert('inscritos')){
                       
                       $dat['mensagem_sucesso']="Usuário cadastrado com sucesso!";
                   } else{
                       
                       $dat['mensagem']="Erro Usuário não foi cadastrado!";
                   }
                }               
            }
         
            $this->loadView('login', $dat);
            
            
          
            
        }
        
        
        
               public function inserircadastro(){          
                
            $senha= trim($_POST['senha']);                
            $cpf_cnpj= str_replace("/","",str_replace("-","",str_replace(".","", trim($_POST['cpf']))));
            
            if(count($cpf_cnpj)<=11){
               $tipo_pessoa='F';
            }else{
               $tipo_pessoa='J';
            }
           
            $data['dados'] = array(
               'email' => trim($_POST['email']),
               'senha' => $senha,
               'cpf_cnpj' => $cpf_cnpj,
               'tipo_pessoa' => $tipo_pessoa,
               'nome' => $_POST['nome'],
               'data_nascimento' => w3c_date($_POST['data-nascimento']),
               'sexo' => $_POST['sexo'],
               'telefone' => $_POST['telefoneFixo'],
               'celular' => $_POST['telefoneCelular'],
               'endereco' => $_POST['endereco'],
               'numero' => $_POST['numero'],
                'complemento' => $_POST['complemento'],
                'bairro' => $_POST['bairro'],
                'cidade' => $_POST['cidade'],
                'estado' => $_POST['estado'],
                'cep' => $_POST['cep'],
                'profissao' => $_POST['profissao']
             );
            
            if($cpf_cnpj=='' || trim($_POST['email'])==''){
                if($tipo_pessoa=='F'){
                    $data['mensagem']="E-mail e Cpf são obrigatórios!"; 
                }else{
                    $data['mensagem']="E-mail e Cnpj são obrigatórios!";

                }
            }else{
                $this->db->select('*');
                $this->db->from('inscritos');
                $this->db->or_where(array('cpf_cnpj'=>$cpf_cnpj,'email'=>trim($_POST['email'])));
                $query=$this->db->get();
                if($query->num_rows>0){
                    if($tipo_pessoa=='F'){
                        $data['mensagem']="E-mail ou Cpf já foram cadastrados!";
                    }else{
                        $data['mensagem']="E-mail ou Cnpj já foram cadastrados!";
                    }
                }else{
                    $data['mensagem_sucesso']="Usuário cadastrado com sucesso!";           
                    $this->db->set($data['dados']);
                   if($this->db->insert('inscritos')){
                       
                       $data['mensagem_sucesso']="Usuário cadastrado com sucesso!";
                   } else{
                       
                       $data['mensagem']="Erro Usuário não foi cadastrado!";
                   }
                }               
            }
         
            $this->loadView('login', $data);
            
            
          
            
        }
        
                
        public function editarcadastro(){
            
            $tipo_pessoa=trim($_POST['tipo_pessoa']);
             if ($tipo_pessoa=="F"){
                    check_login_aluno();
                    $id= $this->session->userdata('SessionIdAluno');
                }
                elseif ($tipo_pessoa=="J"){
                    check_login_empresa();
                    $id= $this->session->userdata('SessionIdEmpresa');
                }
            
          
            
            if ($_POST['senha']==$_POST['confirmar-senha']&& trim($_POST['senha'])!=''){
                
                $senha= trim($_POST['senha']);
            }
            else{
                
                $this->db->select('senha');
                $this->db->from('inscritos');            
                $this->db->where('id',$id);
                $query = $this->db->get();                
                $data["senha"]=$query->result();
                $senha=$data["senha"][0]->senha;
                
            }
           
            $data = array(
               'email' => trim($_POST['email']),
               'senha' => $senha,
               'nome' => $_POST['nome'],
               'data_nascimento' => w3c_date($_POST['data-nascimento']),
               'sexo' => $_POST['sexo'],
               'telefone' => $_POST['telefoneFixo'],
               'celular' => $_POST['telefoneCelular'],
               'endereco' => $_POST['endereco'],
               'numero' => $_POST['numero'],
                'complemento' => $_POST['complemento'],
                'bairro' => $_POST['bairro'],
                'cidade' => $_POST['cidade'],
                'estado' => $_POST['estado'],
                'cep' => $_POST['cep'],
                'profissao' => $_POST['profissao']
             );
            $this->db->where('id', $id);
            $this->db->update('inscritos', $data);
            
            
            redirect(site_url().'meucadastro/index/'.$tipo_pessoa);
            
            
            
          
            
        }
}
