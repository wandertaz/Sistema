
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class avaliacao_do_curso extends MY_Controller {

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

	public function salvar_pesquisa(){
            check_login_aluno();

            
            for($x=1;$x<=$_POST['contador'];$x++){
               
                
                $tipo_pergunta=$_POST['tipopergunta_'.$x];                
               
                if ($tipo_pergunta=='F'){
                   $nota= $_POST['resposta_'.$x];
                   $resposta= null;
                }
                else{
                 $nota= null;
                 $resposta= $_POST['resposta_'.$x];
                }
                
                $data = array(
                    'pergunta_id' => $_POST['pergunta_'.$x],
                    'inscrito_id' => $this->session->userdata('SessionIdAluno') ,
                    'curso_id' => $_POST['curso_id'],
                    'tipo_curso' => $_POST['tipo_curso'],                   
                    'nota' => $nota,
                    'resposta' => $resposta,
                    'created'=> date("Y-m-j H:i:s")
                 );

                $this->db->insert('avaliacoes', $data); 
                
                
            }
            redirect(site_url().'avaliacao_do_curso/');
                //print_r($_POST);
                //exit;
      
        }
        
        
        
        public function index(){
		
	        check_login_aluno();
                $id= $this->session->userdata('SessionIdAluno');
                $data=array();
                
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
                
                
                
                
                
                
                $this->db->select('avaliacoes.id id_avalizacao,inscricoes.id, inscricoes.tipo_curso,inscricoes.curso_id,avaliacoes.id id_avaliacao');
                $this->db->from('inscricoes');
                $this->db->join('avaliacoes' ,'avaliacoes.curso_id = inscricoes.curso_id and avaliacoes.tipo_curso = inscricoes.tipo_curso and avaliacoes.inscrito_id=inscricoes.inscrito_id ','left');
               $this->db->where(array('inscricoes.id'=>$id_inscricao));                 
                $this->db->order_by('inscricoes.data_conclusao','desc');
                $query_cursos = $this->db->get();               
                
                foreach( $query_cursos->result() as $itens){
                    
                    $id_avaliacao=$itens->id_avaliacao;
                   
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
                    $selected=0;
                    
                    
                    $data["cursos_lista"][]= array('id_inscricao' =>$itens->id,'titulo' =>$Lista[0]->titulo,'tipo_curso' =>$itens->tipo_curso,'selected'=>$selected,'id_avaliacao'=>$id_avaliacao);
                    
                  
                                       
                }
                
                           $data['curso']=array('AB'=>'cursos_abertos','IN'=>'cursos_incompany','AL'=>'programas_alta_performance','DE'=>'programas_desenvolvimento','EL'=>'elearning');
                           $tabela=$data['curso'][$tipo_curso];
                                                       
                            $this->db->select('inscricoes.tipo_curso,inscricoes.id,inscricoes.curso_id,usuario.nome,titulo,descricao,data_aquisicao,'.$tabela.'.data_conclusao,numero_aulas,curso_id,inscrito_id');
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
                            $array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>'AB');
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
                
             // print_r($dados);
            //  exit();
		
		 $this->loadView('area-restrita-avaliacao',$dados);



	}
        



}
