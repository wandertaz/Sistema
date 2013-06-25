<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class conteudo_curso extends MY_Controller {

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
        
        public function index($id_incricoes){
            
            /*$this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id');
            $this->db->from('inscricoes');
            $this->db->where(array('curso_id'=>$curso_id,'tipo_curso'=>$tipo_curso));
            $query = $this->db->get(); 
            $data=$query->result();*/
                  
            $dados = array(
           'SessionCurso' 	  => $id_incricoes
           );
            
           
          $this->session->set_userdata($dados);
          header('Location:'.site_url().'conteudo_curso/programacao');
          
        
        }

	public function programacao(){
		
	        check_login_aluno();
                $id= $this->session->userdata('SessionIdAluno');
                
                //verifica se o form foi alterado
                if(isset($_POST['curso_selected'])){
                    if($_POST['curso_selected']!=''){
                        
                        $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id');
                        $this->db->from('inscricoes');
                        $this->db->where(array('inscricoes.id'=>$_POST['curso_selected']));
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
                $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id');
                $this->db->from('inscricoes');
                $this->db->where(array('inscricoes.id'=>$id_inscricao));
                $query = $this->db->get(); 
                $data=$query->result();
                $tipo_curso=$data[0]->tipo_curso;
                
                              
        // verifica todas  as possibilidades de select para o usuario
                 $this->db->select('inscricoes.id,inscricoes.tipo_curso,inscricoes.curso_id');
                 $this->db->from('inscricoes');
                 $this->db->where(array('status'=>'AP','inscrito_id'=>$id));
                 $this->db->order_by('data_aquisicao');
                 $query = $this->db->get();
                
                 
                  foreach($query->result() as $itens){
                      $selected=0;                            
                        if ($id_inscricao==$itens->id ){
                            $selected=1;                            
                        }  
                        
                        $this->db->select('titulo,id');
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
                       
                       //print_r($this->session->userdata('SessionCurso'));
                       //exit();
                  }
    // verifica todas  as possibilidades de select para o usuario                
                
                
                $this->db->select('inscricoes.id,inscricoes.tipo_curso,inscricoes.curso_id');
                $this->db->from('inscricoes');                
                //$this->db->join('avaliacoes' ,'avaliacoes.curso_id = inscricoes.curso_id and avaliacoes.inscrito_id=inscricoes.inscrito_id ','left');
               
                $this->db->where(array('inscricoes.id'=>$id_inscricao));                
                $this->db->order_by('inscricoes.data_conclusao','desc');
                $query_cursos = $this->db->get();    
                
                
                foreach( $query_cursos->result() as $itens){
                   
                   $this->db->select('*');
                   $curso_id=$itens->curso_id;                   
                   
                   if ($itens->tipo_curso=='AB'){
                       $this->db->from('cursos_abertos'); 
                       $this->db->where(array('id'=>$itens->curso_id));
                   }
                   elseif($itens->tipo_curso=='IN'){
                       $this->db->from('cursos_incompany'); 
                       $this->db->where(array('id'=>$itens->curso_id));
                       
                   }
                   elseif($itens->tipo_curso=='AL'){                       
                       $this->db->from('programas_alta_performance'); 
                       $this->db->where(array('id'=>$itens->curso_id));
                   }
                   elseif($itens->tipo_curso=='DE'){
                       $this->db->from('programas_desenvolvimento'); 
                       $this->db->where(array('id'=>$itens->curso_id));
                       
                   }
                   elseif($itens->tipo_curso=='EL'){
                       $this->db->from('elearning'); 
                       $this->db->where(array('id'=>$itens->curso_id));                       
                   }                      
                    $query_cur = $this->db->get();                   
                    $Lista= $query_cur->result();
                    
                    
                    $this->db->select('*');
                    $this->db->from('aulas');
                    $this->db->where(array('curso_id'=>$itens->curso_id,'tipo_curso'=>$itens->tipo_curso)); 
                    $this->db->order_by('aulas.numero');
                    $query_pro = $this->db->get();
                          
                    foreach($query_pro->result() as $itens2){
                        $data["aulas"][]= array('aula_id'=>$itens2->id,'curso_id'=>$itens2->curso_id,'tipo_curso'=>$itens2->tipo_curso,'titulo'=>$itens2->titulo ,'codigo_video'=>$itens2->codigo_video,'arquivo_artigo'=>$itens2->arquivo_artigo,'numero'=>$itens2->numero);
                        
                    }
                   
                            // valida o valor a ser selecionado e marca para selecionar padrão
                            $selected=0;                            
                            if ($id_inscricao==$itens->id){
                                $selected=1;
                            }                        

                    
                        $data["cursos_lista"][]= array('id_inscricao' =>$itens->id,'titulo' =>$Lista[0]->titulo,'tipo_curso' =>$itens->tipo_curso,'selected'=>$selected);
                    
                  
                                       
                }
                
                                           
                           $data['curso']=array('AB'=>'cursos_abertos','IN'=>'cursos_incompany','AL'=>'programas_alta_performance','DE'=>'programas_desenvolvimento','EL'=>'elearning');
                           $tabela=$data['curso'][$tipo_curso];
                           
                            $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id,usuario.nome,instrutor_id,titulo,descricao,data_aquisicao,'.$tabela.'.data_conclusao,numero_aulas,curso_id,inscrito_id');
                            $this->db->from('inscricoes');
                             
                            if ($tipo_curso=='AB'){                                
                                $this->db->join('cursos_abertos' ,'inscricoes.curso_id = cursos_abertos.id');
                                $this->db->join('usuario' ,'usuario.id = cursos_abertos.instrutor_id','left');
                                $this->db->where(array('cursos_abertos.id'=>$itens->curso_id));
                            }
                            elseif($tipo_curso=='IN'){                                
                                $this->db->join('cursos_incompany' ,'inscricoes.curso_id = cursos_incompany.id');
                                $this->db->join('usuario' ,'usuario.id = cursos_incompany.instrutor_id','left');
                                $this->db->where(array('cursos_incompany.id'=>$itens->curso_id));

                            }
                            elseif($tipo_curso=='AL'){  
                                $this->db->join('programas_alta_performance' ,'inscricoes.curso_id = programas_alta_performance.id');
                                $this->db->join('usuario' ,'usuario.id = programas_alta_performance.instrutor_id','left');
                                $this->db->where(array('programas_alta_performance.id'=>$itens->curso_id));
                            }
                            elseif($tipo_curso=='DE'){                                
                                $this->db->join('programas_desenvolvimento' ,'inscricoes.curso_id = programas_desenvolvimento.id');
                                $this->db->join('usuario' ,'usuario.id = programas_desenvolvimento.instrutor_id','left');
                                $this->db->where(array('programas_desenvolvimento.id'=>$itens->curso_id));

                            }
                            elseif($tipo_curso=='EL'){
                                $this->db->join('elearning' ,'inscricoes.curso_id = elearning.id'); 
                                $this->db->join('usuario' ,'usuario.id = elearning.instrutor_id','left');
                                $this->db->where(array('elearning.id'=>$itens->curso_id));                       
                            }  
                           
                                                     
                            $query = $this->db->get();
                            
                            foreach( $query->result() as $itens){

                            $this->db->select('count(*) as faltas');
                            $this->db->from('faltas');
                            $array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>$tipo_curso);
                            $this->db->where($array);
                            $query2 = $this->db->get();		
                            $faltas= $query2->result();
                            
                            
                            $instrutor=$itens->nome;
                         
                            $data["cursos"][]	= array('tipo_curso'=>$itens->tipo_curso,'curso_id'=>$itens->curso_id,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_conclusao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas);
                            
                            

                            }
                            
                            $this->db->select('*');
                            $this->db->from('avaliacoes_perguntas');
                            $this->db->order_by('tipo desc , area desc');
                            $query_perguntas = $this->db->get();		
                            foreach( $query_perguntas->result() as $itens){
                                $data["perguntas"][]= array('id_pergunta'=>$itens->id,'titulo' =>$itens->titulo,'area' =>$itens->area,'tipo' => $itens->tipo);
                            }
                 
                    $dados= array_merge($data);
                
            
		 $this->loadView('area-restrita-programacao',$dados);



	}
        
        public function exercicios(){
		
	        check_login_aluno();
                $id= $this->session->userdata('SessionIdAluno');
                $data='';
              
                //apaga a temp de exercicios
                $this->db->where('inscrito_id',$id);
                $this->db->delete('temp_exercicios');
                
                //apaga a temp de provas
                $this->db->where('inscrito_id',$id);
                $this->db->delete('temp_prova'); 
                
                //verifica se o form foi alterado
                if(isset($_POST['curso_selected'])){
                    if($_POST['curso_selected']!=''){
                        
                        $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id');
                        $this->db->from('inscricoes');
                        $this->db->where(array('inscricoes.id'=>$_POST['curso_selected']));
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
                $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id');
                $this->db->from('inscricoes');
                $this->db->where(array('inscricoes.id'=>$id_inscricao));
                $query = $this->db->get(); 
                $data=$query->result();
                $tipo_curso=$data[0]->tipo_curso;
              
        // verifica todas  as possibilidades de select para o usuario
                 $this->db->select('inscricoes.id,inscricoes.tipo_curso,inscricoes.curso_id');
                 $this->db->from('inscricoes');
                 $this->db->where(array('status'=>'AP','inscrito_id'=>$id));
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
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                $this->db->select('inscricoes.id, inscricoes.tipo_curso,inscricoes.curso_id');
                $this->db->from('inscricoes');                
                $this->db->where(array('inscricoes.id'=>$id_inscricao));
                $this->db->order_by('inscricoes.data_conclusao','desc');
                $query_cursos = $this->db->get();               
                
                foreach( $query_cursos->result() as $itens){
                   $this->db->select('*');
                   $this->db->from('inscricoes'); 
                   $curso_id=$itens->curso_id;
                   
                   if ($itens->tipo_curso=='AB'){
                        $this->db->join('cursos_abertos','cursos_abertos.id=inscricoes.curso_id');
                        $tabela='cursos_abertos';
                    }
                    elseif($itens->tipo_curso=='IN'){
                        $this->db->join('cursos_incompany','cursos_incompany.id=inscricoes.curso_id');    
                        $tabela='cursos_incompany';
                    }
                   
                    elseif($itens->tipo_curso=='AL'){                       
                        $this->db->join('programas_alta_performance','programas_alta_performance.id=inscricoes.curso_id');
                        $tabela='programas_alta_performance';
                    }
                   elseif($itens->tipo_curso=='DE'){
                        $this->db->join('programas_desenvolvimento','programas_desenvolvimento.id=inscricoes.curso_id');
                        $tabela='programas_desenvolvimento';
                   }
                   elseif($itens->tipo_curso=='EL'){
                        $this->db->join('elearning','elearning.id=inscricoes.curso_id');
                        $tabela='elearning';
                   }
                    $this->db->where(array($tabela.'.id'=>$itens->curso_id,'inscricoes.tipo_curso'=>$itens->tipo_curso)); 
                    
                    $query_cur = $this->db->get();		
                    $Lista= $query_cur->result();
                    $selected=0;
                    if(isset($_POST['curso_selected'])){
                        if($_POST['curso_selected']!=''){
                            $post = explode("|", $_POST['curso_selected']);
                            if ($post[0]==$itens->id){
                                $selected=1;
                            }                        

                        }
                    }
                         
                  
                    
                        $data["cursos_lista"][]= array('id_inscricao' =>$itens->id,'titulo' =>$Lista[0]->titulo,'tipo_curso' =>$itens->tipo_curso,'selected'=>$selected);
                    
                 
                                       
                }
                         $data['curso']=array('AB'=>'cursos_abertos','IN'=>'cursos_incompany','AL'=>'programas_alta_performance','DE'=>'programas_desenvolvimento','EL'=>'elearning');
                           $tabela=$data['curso'][$tipo_curso];      
                                                                        
                            $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id,usuario.nome instrutor,instrutor_id,titulo,descricao,data_aquisicao,'.$tabela.'.data_conclusao,numero_aulas,curso_id,inscrito_id');
                            $this->db->from('inscricoes');
                            
                            if ($tipo_curso=='AB'){                                
                                $this->db->join('cursos_abertos' ,'inscricoes.curso_id = cursos_abertos.id');
                                $this->db->join('usuario' ,'usuario.id = cursos_abertos.instrutor_id','left');
                                $this->db->where(array('cursos_abertos.id'=>$itens->curso_id));
                            }
                            elseif($tipo_curso=='IN'){                                
                                $this->db->join('cursos_incompany' ,'inscricoes.curso_id = cursos_incompany.id');
                                $this->db->join('usuario' ,'usuario.id = cursos_incompany.instrutor_id','left');
                                $this->db->where(array('cursos_incompany.id'=>$itens->curso_id));

                            }
                            elseif($tipo_curso=='AL'){  
                                $this->db->join('programas_alta_performance' ,'inscricoes.curso_id = programas_alta_performance.id');
                                 $this->db->join('usuario' ,'usuario.id = programas_alta_performance.instrutor_id','left');
                                $this->db->where(array('programas_alta_performance.id'=>$itens->curso_id));
                            }
                            elseif($tipo_curso=='DE'){                                
                                $this->db->join('programas_desenvolvimento' ,'inscricoes.curso_id = programas_desenvolvimento.id');
                                $this->db->join('usuario' ,'usuario.id = programas_desenvolvimento.instrutor_id','left');
                                $this->db->where(array('programas_desenvolvimento.id'=>$itens->curso_id));

                            }
                            elseif($tipo_curso=='EL'){
                                $this->db->join('elearning' ,'inscricoes.curso_id = elearning.id');    
                                $this->db->join('usuario' ,'usuario.id = elearning.instrutor_id','left');
                                $this->db->where(array('elearning.id'=>$itens->curso_id));                       
                            }  
                           
                                                     
                            $query = $this->db->get();

                            foreach( $query->result() as $itens){

                            $this->db->select('count(*) as faltas');
                            $this->db->from('faltas');   
                            $array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>$tipo_curso);
                            $this->db->where($array);
                            $query2 = $this->db->get();		
                            $faltas= $query2->result();
                            
                            
                            $instrutor=$itens->instrutor;
                            $data["cursos"][]	= array('tipo_curso'=>$itens->tipo_curso,'tipo_curso'=>$tipo_curso,'curso_id'=>$itens->curso_id,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_conclusao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas);

                            
                            }
                              
                              
                             // exibe os exercícios
                            $this->db->select('notas.id id_nota,notas.valor,notas.nota,exercicios.id, aulas.curso_id, aulas.numero, aulas.titulo, exercicios.tipo');
                            $this->db->from('aulas');
                            $this->db->join('exercicios','exercicios.aula_id=aulas.id');
                            $this->db->join('notas','exercicios.id=notas.exercicio_id','left');
                            $array= array('aulas.tipo_curso'=>$tipo_curso,'aulas.curso_id '=>$itens->curso_id ,'aulas.tipo_curso'=>$tipo_curso,'exercicios.tipo'=>'E');
                            $this->db->where($array);
                            $this->db->order_by('exercicios.id');                            
                            $query_perguntas = $this->db->get();
                            
                            foreach( $query_perguntas->result() as $itens){
                                $data["exercicios"][]= array('id_nota'=>$itens->id_nota,'id'=>$itens->id,'curso_id'=>$itens->curso_id,'numero' =>$itens->numero,'titulo' => $itens->titulo,'valor' => $itens->valor,'nota' => $itens->nota);
                            }
                            //print_r($data["exercicios"]);
                            //exit;
                            // exibe as provas
                            $this->db->select('notas.id id_nota,exercicios.id, aulas.curso_id, aulas.numero, aulas.titulo, exercicios.tipo');
                            $this->db->from('aulas');
                            $this->db->join('exercicios','exercicios.aula_id=aulas.id');
                            $this->db->join('notas','exercicios.id=notas.exercicio_id','left');                            
                            $array= array('aulas.tipo_curso'=>$tipo_curso,'notas.id is null'=>null,'aulas.curso_id '=>$itens->curso_id ,'aulas.tipo_curso'=>$tipo_curso,'exercicios.tipo'=>'P');
                            $this->db->where($array);
                            $this->db->order_by('exercicios.id');
                            $query_provas = $this->db->get();
                            
                            foreach( $query_provas->result() as $itens){
                                $data["prova"][]= array('id'=>$itens->id,'curso_id'=>$itens->curso_id,'numero' =>$itens->numero,'titulo' => $itens->titulo);
                            }
                          
                            
                   
                    $data['ativo']=array('ativo'=>1);
                    
                    
                    $dados= array_merge($data);
                
		 $this->loadView('area-restrita-exercicios',$dados);



	}
        
        
        public function apostilas_anexos($tipo_arquivo){
		
	        check_login_aluno();
                $id= $this->session->userdata('SessionIdAluno');
                //$data='';
                
                
                                
                //verifica se o form foi alterado
                if(isset($_POST['curso_selected'])){
                    if($_POST['curso_selected']!=''){
                        
                        $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id');
                        $this->db->from('inscricoes');
                        $this->db->where(array('inscricoes.id'=>$_POST['curso_selected']));
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
                $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id');
                $this->db->from('inscricoes');
                $this->db->where(array('inscricoes.id'=>$id_inscricao));
                $query = $this->db->get(); 
                $data=$query->result();
                $tipo_curso=$data[0]->tipo_curso;
              
        // verifica todas  as possibilidades de select para o usuario
                 $this->db->select('inscricoes.id,inscricoes.tipo_curso,inscricoes.curso_id');
                 $this->db->from('inscricoes');
                 $this->db->where(array('status'=>'AP','inscrito_id'=>$id));
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
                
                
                                
                $this->db->select('inscricoes.id, inscricoes.tipo_curso,inscricoes.curso_id');
                $this->db->from('inscricoes');                
                $this->db->where(array('inscricoes.id'=>$id_inscricao));
                $this->db->order_by('inscricoes.data_conclusao','desc');
                $query_cursos = $this->db->get();               
                
                foreach($query_cursos->result() as $itens){
                   $this->db->select('*');
                   $this->db->from('inscricoes'); 
                   $curso_id=$itens->curso_id;
                   
                   if ($itens->tipo_curso=='AB'){
                        $this->db->join('cursos_abertos','cursos_abertos.id=inscricoes.curso_id');
                        $tabela='cursos_abertos';
                    }
                    elseif($itens->tipo_curso=='IN'){
                        $this->db->join('cursos_incompany','cursos_incompany.id=inscricoes.curso_id');    
                        $tabela='cursos_incompany';
                    }
                   
                    elseif($itens->tipo_curso=='AL'){                       
                        $this->db->join('programas_alta_performance','programas_alta_performance.id=inscricoes.curso_id');
                        $tabela='programas_alta_performance';
                    }
                   elseif($itens->tipo_curso=='DE'){
                        $this->db->join('programas_desenvolvimento','programas_desenvolvimento.id=inscricoes.curso_id');
                        $tabela='programas_desenvolvimento';
                   }
                   elseif($itens->tipo_curso=='EL'){
                        $this->db->join('elearning','elearning.id=inscricoes.curso_id');
                        $tabela='elearning';
                   }
                    $this->db->where(array($tabela.'.id'=>$itens->curso_id,'inscricoes.tipo_curso'=>$itens->tipo_curso)); 
                    
                    $query_cur = $this->db->get();		
                    $Lista= $query_cur->result();
                    $selected=0;
                                         
                  
                    
                        $data["cursos_lista"][]= array('id_inscricao' =>$itens->id,'titulo' =>$Lista[0]->titulo,'tipo_curso' =>$itens->tipo_curso,'selected'=>$selected,'tipo_arquivo'=>$tipo_arquivo);
                    
                 
                                       
                }
                
             
                           $data['curso']=array('AB'=>'cursos_abertos','IN'=>'cursos_incompany','AL'=>'programas_alta_performance','DE'=>'programas_desenvolvimento','EL'=>'elearning');
                           $tabela=$data['curso'][$tipo_curso];
                           
                            $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id,instrutor_id,titulo,descricao,data_aquisicao,'.$tabela.'.data_conclusao,numero_aulas,curso_id,inscrito_id');
                            $this->db->from('inscricoes');
                            
                            if ($tipo_curso=='AB'){                                
                                $this->db->join('cursos_abertos' ,'inscricoes.curso_id = cursos_abertos.id');
                                $this->db->where(array('cursos_abertos.id'=>$itens->curso_id));
                            }
                            elseif($tipo_curso=='IN'){                                
                                $this->db->join('cursos_incompany' ,'inscricoes.curso_id = cursos_incompany.id');
                                $this->db->where(array('cursos_incompany.id'=>$itens->curso_id));

                            }
                            elseif($tipo_curso=='AL'){  
                                $this->db->join('programas_alta_performance' ,'inscricoes.curso_id = programas_alta_performance.id');
                                $this->db->where(array('programas_alta_performance.id'=>$itens->curso_id));
                            }
                            elseif($tipo_curso=='DE'){                                
                                $this->db->join('programas_desenvolvimento' ,'inscricoes.curso_id = programas_desenvolvimento.id');
                                $this->db->where(array('programas_desenvolvimento.id'=>$itens->curso_id));

                            }
                            elseif($tipo_curso=='EL'){
                                $this->db->join('elearning' ,'inscricoes.curso_id = elearning.id');                               
                                $this->db->where(array('elearning.id'=>$itens->curso_id));                       
                            }  
                           
                                                     
                            $query = $this->db->get();

                            foreach( $query->result() as $itens){

                            $this->db->select('count(*) as faltas');
                            $this->db->from('faltas');   
                            $array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>$tipo_curso);
                            $this->db->where($array);
                            $query2 = $this->db->get();		
                            $faltas= $query2->result();
                            
                            
                            $instrutor='';
                            $data["cursos"][]	= array('tipo_curso'=>$itens->tipo_curso,'curso_id'=>$itens->curso_id,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_conclusao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas);

                            
                            }
                              
                              
                            
                            $this->db->select('aulas.titulo as titulo_aula, aulas.id,aulas.curso_id,aulas.numero,arquivos.*');
                            $this->db->from('aulas');
                            $this->db->join('arquivos','arquivos.aula_id=aulas.id');
                            $array= array('aulas.curso_id '=>$itens->curso_id ,'tipo_curso'=>$tipo_curso,'arquivos.tipo'=>$tipo_arquivo);
                            $this->db->where($array);
                            $this->db->order_by('numero,aulas.curso_id');
                            $query_perguntas = $this->db->get();
                            
                            foreach( $query_perguntas->result() as $itens){
                                $data["apostilas"][]= array('id'=>$itens->id,'curso_id'=>$itens->curso_id,'numero' =>$itens->numero,'arquivo' =>$itens->arquivo,'titulo' => $itens->titulo,'tipo_arquivo'=>$tipo_arquivo,'titulo_aula'=>$itens->titulo_aula);
                            }
                          
                            
                   
                    $data['ativo']=array('ativo'=>1);
                    
                    
                    $dados= array_merge($data);
                //print_r($dados['cursos'][0]);
                           //   exit();
             
		 $this->loadView('area-restrita-apostilas',$dados);



	}
        
        
        
        
        



}
