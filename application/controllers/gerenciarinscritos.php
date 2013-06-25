<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gerenciarinscritos extends MY_Controller {

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
		
	        check_login_empresa(1);
                 if ($this->session->userdata('SessionIdEmpresa')>0){
                    
                   $id= $this->session->userdata('SessionIdEmpresa'); 
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){                        
                   $id= $this->session->userdata('SessionEmpresaPermissoes');     
                }
                
               //print_r($data['mensagem']);
              // exit;
                //verifica se o form foi alterado
                if(isset($_POST['curso_selected'])){
                    if($_POST['curso_selected']!=''){
                        
                        $this->db->select('inscricoes_empresas.tipo_curso,inscricoes_empresas.id,inscricoes_empresas.curso_id');
                        $this->db->from('inscricoes_empresas');
                        $this->db->where(array('inscricoes_empresas.id'=>$_POST['curso_selected']));
                        $query = $this->db->get(); 
                        $data=$query->result();                        
                        $id_inscricao=$data[0]->id;
                        $dados = array(
                           'SessionCurso'=>$id_inscricao
                        );
                       $this->session->set_userdata($dados);
                    } 
                    else{
                        $id_inscricao=$this->session->userdata('SessionCurso');
                    }
                    
                }
                else{
                    $id_inscricao=  $this->session->userdata('SessionCurso');                 
                    
                }
                
                //verifica o tipo do curso
                $this->db->select('inscricoes_empresas.tipo_curso,inscricoes_empresas.id,inscricoes_empresas.curso_id');
                $this->db->from('inscricoes_empresas');
                $this->db->where(array('inscricoes_empresas.id'=>$id_inscricao));
                $query = $this->db->get(); 
                $data=$query->result();
                $tipo_curso=$data[0]->tipo_curso;
              
        // verifica todas  as possibilidades de select para o usuario
                 $this->db->select('inscricoes_empresas.id,inscricoes_empresas.tipo_curso,inscricoes_empresas.curso_id');
                 $this->db->from('inscricoes_empresas');
                 $this->db->where(array('status'=>'AP','inscrito_empresa_id'=>$id));
                 $this->db->order_by('data_aquisicao');
                 $query = $this->db->get();
                
                 
                  foreach($query->result() as $itens){
                      $selected=0;                            
                        if ($id_inscricao==$itens->id){
                            $selected=1;
                        }  
                        
                        $this->db->select('titulo');
                        if ($itens->tipo_curso=='AB'){
                            $this->db->from('cursos_abertos');
                        }
                        elseif ($itens->tipo_curso=='IN'){
                            $this->db->from('cursos_incompany');
                        }                            
                        elseif ($itens->tipo_curso=='AL'){
                            $this->db->from('programas_alta_performance');
                        }
                        elseif ($itens->tipo_curso=='DE'){
                            $this->db->from('programas_desenvolvimento');
                        }
                        elseif ($itens->tipo_curso=='EL'){
                            $this->db->from('elearning');
                        }
                        $this->db->where(array('id'=>$itens->curso_id));
                        $query2 = $this->db->get();
                        $titulo=$query2->result();
                     
                        
                       $data["listaNova"][]= array('titulo'=>$titulo[0]->titulo,'id_inscricao'=>$itens->id,'selected'=>$selected);
                  }
    // verifica todas  as possibilidades de select para o usuario 
                
		
          
                if ($tipo_curso=='AL'){ 
		
		
                    //area que calcula os cursos alta performace 
                    $this->db->select('inscricoes_empresas.curso_id,inscricoes_empresas.tipo_curso,usuario.nome instrutor,titulo,descricao,data_aquisicao,programas_alta_performance.data_conclusao,numero_aulas,curso_id,inscrito_empresa_id');
                    $this->db->from('inscricoes_empresas');
                    $this->db->join('programas_alta_performance' ,'inscricoes_empresas.curso_id = programas_alta_performance.id');
                    $this->db->join('usuario' ,'programas_alta_performance.instrutor_id = usuario.id','left');
                    $this->db->where(array('inscricoes_empresas.id'=>$id_inscricao));
                    $this->db->order_by('data_aquisicao');
                    $query = $this->db->get();
                    $itens=$query->result();
                    //print_r($itens);
                   // exit();
                    $data["cursos"]= array('curso_id'=>$itens[0]->curso_id,'tipo_curso'=>$itens[0]->tipo_curso,'titulo' =>$itens[0]->titulo,'descricao' =>$itens[0]->descricao,'instrutor' =>$itens[0]->instrutor,'data_aquisicao' => $itens[0]->data_aquisicao,'data_conclusao' => $itens[0]->data_conclusao,'numero_aulas' => $itens[0]->numero_aulas,'id_inscricao'=>$id_inscricao);
		
                    
                    
                    //aqui pega todos os inscritos do curso especifico e da empresa especifica
                    $this->db->select('inscrito_id,nome,email,cpf_cnpj');
                    $this->db->from('controle_inscritos_empresa');
                    $this->db->join('inscritos' ,'controle_inscritos_empresa.inscrito_id=inscritos.id');
                    $array= array('inscricoes_id '=>$id_inscricao, 'inscricoes_empresa_id' =>$id);
                    $this->db->where($array);
                    $this->db->order_by('nome');
                    $query_inscritos = $this->db->get();
                    
                    foreach($query_inscritos->result() as $itens_inscritos){
                        
                        //verifica as faltas do aluno
                        $this->db->select('count(*) as faltas');
                        $this->db->from('faltas');
                        $array= array('curso_id '=>$itens[0]->curso_id , 'inscrito_id' =>$itens_inscritos->inscrito_id,'tipo_curso'=>'AL');
                        $this->db->where($array);
                        $query2 = $this->db->get();		
                        $faltas= $query2->result();
                        
                        
                        // calcula nota do aluno    
                        $this->db->select_sum('nota');
                        $this->db->select_sum('notas.valor');
                        $this->db->join('exercicios','exercicios.id=notas.exercicio_id');
                        $this->db->where(array('tipo_curso'=>'AL','notas.curso_id'=>$itens[0]->curso_id,'notas.inscrito_id'=>$itens_inscritos->inscrito_id,'exercicios.tipo'=>'P'));
                        $query3 = $this->db->get('notas');		
                        $aux=$query3->result();		
                        $valor=$aux[0]->valor;
                        $nota=$aux[0]->nota;
                        if ($valor==''){
                                $valor=0;
                        }
                        if ($nota==''){
                                $nota=0;
                        }
                        
                       $data["inscritos_notas"][]= array('inscrito_id'=>$itens_inscritos->inscrito_id,'nome'=>$itens_inscritos->nome,'email'=>$itens_inscritos->email,'faltas'=>$faltas[0]->faltas,'valor'=>$valor,'nota'=>$nota,'cpfcnpj'=>$itens_inscritos->cpf_cnpj); 
                    }
                    
                    
             
                }
                
                
                
                
                $dados= array_merge($data);
                $dados['mensagem']=array($msg);
                $this->loadView('area-restrita-gerenciar-inscritos',$dados);



	}
        public function buscarcadastrados($msg=false){
            		
	        check_login_empresa(1);
                if ($this->session->userdata('SessionIdEmpresa')>0){
                    
                   $id= $this->session->userdata('SessionIdEmpresa'); 
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){                        
                   $id= $this->session->userdata('SessionEmpresaPermissoes');     
                }
		$data='';
                
                
                //verifica se o form foi alterado
                if(isset($_POST['curso_selected'])){
                    if($_POST['curso_selected']!=''){
                        
                        $this->db->select('inscricoes_empresas.tipo_curso,inscricoes_empresas.id,inscricoes_empresas.curso_id');
                        $this->db->from('inscricoes_empresas');
                        $this->db->where(array('inscricoes_empresas.id'=>$_POST['curso_selected']));
                        $query = $this->db->get(); 
                        $data=$query->result();                        
                        $id_inscricao=$data[0]->id;
                        $dados = array(
                           'SessionCurso'=>$id_inscricao
                        );
                       $this->session->set_userdata($dados);
                    } 
                    else{
                        $id_inscricao=$this->session->userdata('SessionCurso');
                    }
                    
                }
                else{
                    $id_inscricao=  $this->session->userdata('SessionCurso');                 
                    
                }
                
                //verifica o tipo do curso
                $this->db->select('inscricoes_empresas.tipo_curso,inscricoes_empresas.id,inscricoes_empresas.curso_id');
                $this->db->from('inscricoes_empresas');
                $this->db->where(array('inscricoes_empresas.id'=>$id_inscricao));
                $query = $this->db->get(); 
                $data=$query->result();
                $tipo_curso=$data[0]->tipo_curso;
              
        // verifica todas  as possibilidades de select para o usuario
                 $this->db->select('inscricoes_empresas.id,inscricoes_empresas.tipo_curso,inscricoes_empresas.curso_id');
                 $this->db->from('inscricoes_empresas');
                 $this->db->where(array('status'=>'AP','inscrito_empresa_id'=>$id));
                 $this->db->order_by('data_aquisicao');
                 $query = $this->db->get();
                
                 
                  foreach($query->result() as $itens){
                      $selected=0;                            
                        if ($id_inscricao==$itens->id){
                            $selected=1;
                        }  
                        
                        $this->db->select('titulo');
                        if ($itens->tipo_curso=='AB'){
                            $this->db->from('cursos_abertos');
                        }
                        elseif ($itens->tipo_curso=='IN'){
                            $this->db->from('cursos_incompany');
                        }                            
                        elseif ($itens->tipo_curso=='AL'){
                            $this->db->from('programas_alta_performance');
                        }
                        elseif ($itens->tipo_curso=='DE'){
                            $this->db->from('programas_desenvolvimento');
                        }
                        elseif ($itens->tipo_curso=='EL'){
                            $this->db->from('elearning');
                        }
                        $this->db->where(array('id'=>$itens->curso_id));
                        $query2 = $this->db->get();
                        $titulo=$query2->result();
                     
                        
                       $data["listaNova"][]= array('titulo'=>$titulo[0]->titulo,'id_inscricao'=>$itens->id,'selected'=>$selected);
                  }
    // verifica todas  as possibilidades de select para o usuario 
                
		
          
                if ($tipo_curso=='AL'){ 
		
		
                    //area que calcula os cursos alta performace 
                    $this->db->select('inscricoes_empresas.curso_id,inscricoes_empresas.tipo_curso,usuario.nome instrutor,titulo,descricao,data_aquisicao,programas_alta_performance.data_conclusao,numero_aulas,curso_id,inscrito_empresa_id');
                    $this->db->from('inscricoes_empresas');
                    $this->db->join('programas_alta_performance' ,'inscricoes_empresas.curso_id = programas_alta_performance.id');
                    $this->db->join('usuario' ,'programas_alta_performance.instrutor_id = usuario.id','left');
                    $this->db->where(array('inscricoes_empresas.id'=>$id_inscricao));
                    $this->db->order_by('data_aquisicao');
                    $query = $this->db->get();
                    $itens=$query->result();
                    //print_r($itens);
                   // exit();
                    $data["cursos"]= array('curso_id'=>$itens[0]->curso_id,'tipo_curso'=>$itens[0]->tipo_curso,'titulo' =>$itens[0]->titulo,'descricao' =>$itens[0]->descricao,'instrutor' =>$itens[0]->instrutor,'data_aquisicao' => $itens[0]->data_aquisicao,'data_conclusao' => $itens[0]->data_conclusao,'numero_aulas' => $itens[0]->numero_aulas);
		
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
                               

                               $data["inscritos_notas"][]= array('inscrito_id'=>$itens_inscritos->inscrito_id,'nome'=>$itens_inscritos->nome,'email'=>$itens_inscritos->email,'cpfcnpj'=>$itens_inscritos->cpf_cnpj); 
                            }

                        }
                    }
                }
                
                
                
                
                $dados= array_merge($data);

		
            $this->loadView('area-restrita-buscar-cadastrados',$dados);
            
        }
        
        public function salvaraluno($aluno_id){
            check_login_empresa(1);
            if ($this->session->userdata('SessionIdEmpresa')>0){
                    
                   $id= $this->session->userdata('SessionIdEmpresa'); 
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){                        
                   $id= $this->session->userdata('SessionEmpresaPermissoes');     
                }

            //aqui pega todos os inscritos do curso especifico e da empresa especifica
            $this->db->select('id inscrito_id,nome,email,cpf_cnpj');
            $this->db->from('inscritos');
            $this->db->where(array('inscritos.id'=>$aluno_id));
            $query_inscritos = $this->db->get();
            $Aluno=$query_inscritos->result();
            //print_r($query_inscritos);
            //exit;
            if(count($Aluno)<=0){                
                return $this->index('Erro:O aluno não foi cadastrado!') ;                
            }
            else{
                 $this->db->select('*');
                 $this->db->from('controle_inscritos_empresa');
                 $this->db->where(array('inscrito_id'=>$aluno_id,'inscricoes_id'=>$this->session->userdata('SessionCurso')));
                  $query_confirmacao = $this->db->get();
               if ($query_confirmacao->num_rows>0){
                   
                   return $this->index('O aluno já estava cadastrado') ;
               }
               else{
                   
                 $this->db->select('*');
                 $this->db->from('inscricoes_empresas');
                 $this->db->where(array('id'=>$this->session->userdata('SessionCurso')));
                  $query_dados = $this->db->get();
                  $empresa=$query_dados->result();
                  //print_r($empresa[0]);
                   
                    $data1 = array(
                        'inscrito_id' => $aluno_id ,
                        'curso_id' => $empresa[0]->curso_id ,                        
                        'turma_id' => $empresa[0]->turma_id ,
                        'compra_id' => $empresa[0]->compra_id,
                        'tipo_curso' => 'AL',
                        'status' => 'AP',
                        'valor' => '0.00',
                        'data_aquisicao' => $empresa[0]->data_aquisicao,
                        'data_conclusao' => '',
                        'created' => date("Y-m-d H:i:s") ,
                        'gerar_certificado' => 'N'
                        
                    );

                    $id_inscricao_aluno=$this->db->insert('inscricoes', $data1); 
                    
                    // salva na tabela controle_inscritos_empresa tabela de relacionamento
                    $data2 = array(
                        'inscricoes_id' => $id_inscricao_aluno,
                        'inscrito_id' => $aluno_id ,                        
                        'inscricoes_empresa_id' => $this->session->userdata('SessionCurso')
                    );

                    $id_inscricao_relacionamento=$this->db->insert('controle_inscritos_empresa', $data2); 
                    
                    
                    if ($id_inscricao_aluno<=0|| $id_inscricao_relacionamento<=0 ){
                        
                         return $this->index('Erro: consulte a Mb este erro pode ter gerado alguma inconsistência') ;
                        
                    }               
                  
                   return $this->index('O aluno foi cadastrado com sucesso') ;
               }
           
                  
                
            }
            
            return $this->index() ;
           
            
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

