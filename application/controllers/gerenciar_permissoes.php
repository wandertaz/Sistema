<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gerenciar_permissoes extends MY_Controller {

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

	public function index($msg = ''){
		
	        check_login_empresa();
                $id= $this->session->userdata('SessionIdEmpresa');
                    $data['msg']=array('msg'=>$msg);
                    
                    //aqui pega todos as pemissoes cadastradas                    
                    $this->db->select('area_permissoes_concedidas.inscritos_id inscrito_id,nome,email,cpf_cnpj,nome_area_permissoes,area_permissoes_concedidas.area_permissoes_concedidas_id');
                    $this->db->from('area_permissoes_concedidas');
                    $this->db->join('inscritos' ,'area_permissoes_concedidas.inscritos_id=inscritos.id');
                    $this->db->join('area_permissoes' ,'area_permissoes_concedidas.area_permissoes_area_permissoes_id= area_permissoes.area_permissoes_id','left');
                    $array= array('area_permissoes_concedidas_id_empresa' =>$id);
                    $this->db->where($array);
                    //$this->db->order_by('nome');
                    $query_inscritos = $this->db->get();
                    
                    foreach($query_inscritos->result() as $itens_inscritos){
                        
                        // calcula permissão do usuário                                               
                       $data["permissoes_aceitas"][]= array('inscrito_id'=>$itens_inscritos->inscrito_id,'nome'=>$itens_inscritos->nome,'email'=>$itens_inscritos->email,'cpfcnpj'=>$itens_inscritos->cpf_cnpj,'nome_area_permissoes'=>$itens_inscritos->nome_area_permissoes,'area_permissoes_concedidas_id'=>$itens_inscritos->area_permissoes_concedidas_id);
                       }
                    
                    
             
                
                
                
                
                
                $dados= array_merge($data);
                $dados['mensagem']=array($msg);
                $this->loadView('area-restrita-buscar-cadastrados-permissoes',$dados);



	}
             public function buscarcadastrados($msg=false){
            		
	        check_login_empresa();
                $id= $this->session->userdata('SessionIdEmpresa');
                
               
                    $data['msg']=array('msg'=>$msg);
                
                    if ($_POST){
                        if(trim($_POST['nome'])!='' || trim($_POST['email'])!=''){
                            //aqui pega todos os inscritos do curso especifico e da empresa especifica
                            $this->db->select('id inscrito_id,nome,email,cpf_cnpj');
                            $this->db->from('inscritos');                            
                            $array=array('F');
                            $this->db->where_in('inscritos.tipo_pessoa',$array);
                            if(trim($_POST['nome'])!=''){                             
                                $this->db->or_like('nome', $_POST['nome']);
                             }
                             if(trim($_POST['email'])!=''){ 
                                $this->db->or_like('email', $_POST['email']);
                             }
                            
                            
                            
                            $this->db->order_by('nome');
                            $query_inscritos = $this->db->get();

                            foreach($query_inscritos->result() as $itens_inscritos){                               

                               $data["permissoes_nao_cadastradas"][]= array('inscrito_id'=>$itens_inscritos->inscrito_id,'nome'=>$itens_inscritos->nome,'email'=>$itens_inscritos->email,'cpfcnpj'=>$itens_inscritos->cpf_cnpj); 
                            }

                        }
                    
                    }
                
                $dados= array_merge($data);
		
                $this->loadView('area-restrita-buscar-cadastrados-permissoes-novo',$dados);
            
        }
         public function excluir_permissao($permissao_id){
              $this->db->where(array('area_permissoes_concedidas.area_permissoes_concedidas_id'=>$permissao_id));
              $this->db->delete('area_permissoes_concedidas');              
              return $this->index('Permissão excluída com sucesso!');
             
         }
          public function exibiropcoes($usuario_id){
              
                         
                        if(trim($usuario_id)!=''){
                            //aqui pega todos os inscritos do curso especifico e da empresa especifica
                            $this->db->select('id inscrito_id,nome,email,cpf_cnpj');
                            $this->db->from('inscritos'); 
                            $this->db->where('inscritos.id',$usuario_id);                            
                            $query_inscritos = $this->db->get();

                            foreach($query_inscritos->result() as $itens_inscritos){                               
                                
                            $this->db->select('area_permissoes_concedidas.area_permissoes_concedidas_id,area_permissoes.*');
                            $this->db->from('area_permissoes'); 
                            $this->db->join('area_permissoes_concedidas' ,'area_permissoes_concedidas.area_permissoes_area_permissoes_id= area_permissoes.area_permissoes_id and area_permissoes_concedidas.inscritos_id='.$usuario_id,'left');
                            //$this->db->where('area_permissoes_concedidas.inscritos_id',$usuario_id);                            
                            $query = $this->db->get();
                            if($query->num_rows>0){
                                $qtd=round($query->num_rows/2);
                            }
                            foreach($query->result() as $itens){ 
                                
                                $data["areas_cadastradas"][]=array('area_permissoes_concedidas_id'=>$itens->area_permissoes_concedidas_id,'area_permissoes_id'=>$itens->area_permissoes_id,'nome_area_permissoes'=>$itens->nome_area_permissoes,'media'=>$qtd);
                                
                            }
                               
                               $data["permissoes_nao_cadastradas"][]= array('inscrito_id'=>$itens_inscritos->inscrito_id,'nome'=>$itens_inscritos->nome,'email'=>$itens_inscritos->email,'cpfcnpj'=>$itens_inscritos->cpf_cnpj); 
                            }

                        }else{
                           return $this->index('Erro:O aluno não foi cadastrado!') ;                           
                        }
                    
                  
              
              $dados= array_merge($data);
              $this->loadView('area-restrita-buscar-cadastrados-permissoes-novo-mais',$dados);
          }
        
        public function salvaraluno(){
            check_login_empresa();
            $id= $this->session->userdata('SessionIdEmpresa');
           
            
            $this->db->where(array('inscritos_id'=>$_POST['id_usuario']));
            $this->db->delete('area_permissoes_concedidas');
             
            for($x=1;$x<=20;$x++){
               
                if(isset($_POST['nivel_acesso_'.$x])){
                 
                    $dados_permissao=array(
                        'area_permissoes_concedidas_id_empresa'=>$id,
                        'inscritos_id'=>$_POST['id_usuario'],
                        'area_permissoes_area_permissoes_id'=>$_POST['nivel_acesso_'.$x],
                        
                        );
                     $this->db->insert('area_permissoes_concedidas',$dados_permissao);
                }
                else{
                   // break; 
                }
              
                
            }
              return $this->index('O Pemissão foi alterada com sucesso') ;
           
            
        }
        
        public function novocadastro_inscrito($msg=''){
            $data['msg']=$msg;
             $this->loadView('area-restrita-form-add-inscrito',$data);
            
        }
        
        public function salvacadastro_inscrito(){
            
          
           
                    
                    if (isset($_POST)==false){
                      return $this->novocadastro_inscrito('Os campos Obrigatórios devem ser preenchidos');  
                    }  
                    if ( $_POST['nome_add_inscrito']==''||$_POST['uf_add_inscrito']==''|| $_POST['cpf_add_inscrito']=='' || $_POST['tel_add_inscrito']==''||$_POST['uf_add_inscrito']==''|| $_POST['cidade_add_inscrito']=='' ||$_POST['bairro_add_inscrito']==''||$_POST['endereco_add_inscrito']==''|| $_POST['numero_add_inscrito']=='' || $_POST['cep_add_inscrito']==''){
                             return $this->novocadastro_inscrito('Os campos Obrigatórios devem ser preenchidos');

                    }   
                    
                  
                    
                    $cpf=str_replace('-','',str_replace('.','',$_POST['cpf_add_inscrito']));
                     
                    // email cadastrado, mais o usuario e diferente do digitado
                    $email_form=trim($_POST['email_add_inscrito']);
                    $this->db->select('count(*) email');
                    $this->db->from('inscritos');
                    $this->db->where(array('email'=>$email_form,'cpf_cnpj !='=>$cpf));
                     $query_dados = $this->db->get();
                     $email=$query_dados->result();
                     
                     if ($email[0]->email>0){
                         
                          return $this->novocadastro_inscrito('O email já esta cadastrado para outro usuário');
                     }
                     
                     // usuario cadastrado com cpf e email digitado                   
                    $this->db->select('count(*) email');
                    $this->db->from('inscritos');
                    $this->db->where(array('email'=>$email_form,'cpf_cnpj'=>$cpf));
                     $query_dados = $this->db->get();
                     $email=$query_dados->result();
                     
                     if ($email[0]->email>0){
                         
                          return $this->novocadastro_inscrito('Este usuário ja esta cadastrado');
                     }
                     
                      // usuario cadastrado com cpf                   
                    $this->db->select('count(*) cpf');
                    $this->db->from('inscritos');
                    $this->db->where(array('cpf_cnpj'=>$cpf));
                     $query_dados = $this->db->get();
                     $email=$query_dados->result();
                     
                     if ($email[0]->email>0){
                         
                          return $this->novocadastro_inscrito('O cpf inserido ja estava cadastrado');
                     }
                     
                     
                     
                    $data1 = array(
                        
                        'nome' => $_POST['nome_add_inscrito'] ,
                        'email' => $email_form ,                        
                        'senha' => '@*1&%9a$' ,
                        'tipo_pessoa' => 'F',
                        'cpf_cnpj' => $cpf,     
                        'data_nascimento' =>$_POST['data_add_inscrito']!=''?$_POST['data_add_inscrito']:null,
                        'sexo' => $_POST['sexo_add_inscrito'],
                        'telefone' => $_POST['tel_add_inscrito']!=''?$_POST['tel_add_inscrito']:null,
                        'celular' => $_POST['cel_add_inscrito']!=''?$_POST['cel_add_inscrito']:null,                        
                        'estado' => $_POST['uf_add_inscrito']!=''?$_POST['uf_add_inscrito']:null, 
                        'cidade' => $_POST['cidade_add_inscrito']!=''?$_POST['cidade_add_inscrito']:null,
                        'bairro' => $_POST['bairro_add_inscrito']!=''?$_POST['bairro_add_inscrito']:null, 
                        'endereco' => $_POST['endereco_add_inscrito']!=''?$_POST['endereco_add_inscrito']:null,
                        'numero' => $_POST['numero_add_inscrito']!=''?$_POST['numero_add_inscrito']:null,
                        'complemento' => $_POST['complemento_add_inscrito']!=''?$_POST['complemento_add_inscrito']:null,
                        'cep' => $_POST['cep_add_inscrito']!=''?$_POST['cep_add_inscrito']:null,                        
                        'profissao' => $_POST['cargo_add_inscrito']!=''?$_POST['cargo_add_inscrito']:null, 
                        'ativo' => 'S'
                      
                        
                        
                    );
                   
                    
                    $this->db->insert('inscritos', $data1);  
                    return $this->novocadastro_inscrito('O usuário foi cadastrado com sucesso');
            
            
            
            
            
          
            
        }
        

}

