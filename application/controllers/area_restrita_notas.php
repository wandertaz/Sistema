<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class area_restrita_notas extends MY_Controller {

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

	public function index(){
		
	        check_login_aluno();
                $id= $this->session->userdata('SessionIdAluno');
		$data='';
                
                
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
                
		
                if ($tipo_curso=='AB'){
                    //area que calcula os cursos abertos e suas faltas
                    $this->db->select('inscricoes.curso_id,inscricoes.tipo_curso,usuario.nome instrutor,titulo,descricao,data_aquisicao,cursos_abertos.data_conclusao,numero_aulas,curso_id,inscrito_id');
                    $this->db->from('inscricoes');
                    $this->db->join('cursos_abertos' ,'inscricoes.curso_id = cursos_abertos.id');
                    $this->db->join('usuario' ,'cursos_abertos.instrutor_id = usuario.id','left');
                    $this->db->where(array('inscricoes.id'=>$id_inscricao));
                    //$this->db->where(array('status'=>'AP','inscrito_id'=>$id,'inscricoes.tipo_curso'=>'AB'));
                    $this->db->order_by('data_aquisicao');
                    $query = $this->db->get();     
                
                    foreach( $query->result() as $itens){

                        $this->db->select('count(*) as faltas');
                        $this->db->from('faltas');
                        $array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>'AB');
                        $this->db->where($array);
                        $query2 = $this->db->get();		
                        $faltas= $query2->result();
                
                        $presenca=0;
                       if($itens->numero_aulas >0 && $faltas[0]->faltas>=0){
                          $presenca=((100/$itens->numero_aulas)* $faltas[0]->faltas); 
                       }
                       //$presenca=((100/$itens->numero_aulas)* $faltas[0]->faltas);

                       if($presenca<0){
                               $presenca=0;	
                       }
		
         
                        //select sum(valor),sum(nota) from notas where curso_id=1 and inscrito_id=1
                        $this->db->select_sum('nota');
                        $this->db->select_sum('notas.valor');
                        $this->db->join('exercicios','exercicios.id=notas.exercicio_id');
                        //$this->db->where(array('inscricoes.id'=>$id_inscricao));
                        $this->db->where(array('tipo_curso'=>'AB','notas.curso_id'=>$itens->curso_id,'notas.inscrito_id'=>$id,'exercicios.tipo'=>'P'));
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



                        $data["cursos"][]	= array('curso_id'=>$itens->curso_id,'tipo_curso'=>$itens->tipo_curso,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_aquisicao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas,'presenca'=>$presenca,'valor'=>$valor,'nota'=>$nota);


                     }
		
                } elseif ($tipo_curso=='IN'){  
		
		
                    //area que calcula os cursos Incompany e suas faltas
                    $this->db->select('inscricoes.curso_id,inscricoes.tipo_curso,usuario.nome instrutor,titulo,descricao,data_aquisicao,cursos_incompany.data_conclusao,numero_aulas,curso_id,inscrito_id');
                    $this->db->from('inscricoes');
                    $this->db->join('cursos_incompany' ,'inscricoes.curso_id = cursos_incompany.id');
                    $this->db->join('usuario' ,'cursos_incompany.instrutor_id = usuario.id','left');
                    $this->db->where(array('inscricoes.id'=>$id_inscricao));
                    $this->db->order_by('data_aquisicao');
                    $query = $this->db->get();
		
                    foreach( $query->result() as $itens){

                        $this->db->select('count(*) as faltas');
                        $this->db->from('faltas');
                        $array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>'IN' );
                        $this->db->where($array);
                        $query2 = $this->db->get();		
                        $faltas= $query2->result();
                
                
                        $presenca=0;
                       if($itens->numero_aulas >0 && $faltas[0]->faltas>=0){
                          $presenca=((100/$itens->numero_aulas)* $faltas[0]->faltas); 
                       }
                       //$presenca=((100/$itens->numero_aulas)* $faltas[0]->faltas);

                       if($presenca<0){
                               $presenca=0;	
                       }
		
		
                        //select sum(valor),sum(nota) from notas where curso_id=1 and inscrito_id=1
                        $this->db->select_sum('nota');
                        $this->db->select_sum('notas.valor');
                        $this->db->join('exercicios','exercicios.id=notas.exercicio_id');
                        $this->db->where(array('tipo_curso'=>'IN','notas.curso_id'=>$itens->curso_id,'notas.inscrito_id'=>$id,'exercicios.tipo'=>'P'));
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
		
                        $data["cursos"][]	= array('curso_id'=>$itens->curso_id,'tipo_curso'=>$itens->tipo_curso,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_aquisicao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas,'presenca'=>$presenca,'valor'=>$valor,'nota'=>$nota);
		
	
                    }
                }elseif ($tipo_curso=='AL'){ 
		
		
                    //area que calcula os cursos alta performace e suas faltas
                    $this->db->select('inscricoes.curso_id,inscricoes.tipo_curso,usuario.nome instrutor,titulo,descricao,data_aquisicao,programas_alta_performance.data_conclusao,numero_aulas,curso_id,inscrito_id');
                    $this->db->from('inscricoes');
                    $this->db->join('programas_alta_performance' ,'inscricoes.curso_id = programas_alta_performance.id');
                    $this->db->join('usuario' ,'programas_alta_performance.instrutor_id = usuario.id','left');
                    $this->db->where(array('inscricoes.id'=>$id_inscricao));
                    $this->db->order_by('data_aquisicao');
                    $query = $this->db->get();
		
                    foreach( $query->result() as $itens){

                    $this->db->select('count(*) as faltas');
                    $this->db->from('faltas');
                    $array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>'AL');
                    $this->db->where($array);
                    $query2 = $this->db->get();		
                    $faltas= $query2->result();
	
                
                    $presenca=0;
                   if($itens->numero_aulas >0 && $faltas[0]->faltas>=0){
                      $presenca=((100/$itens->numero_aulas)* $faltas[0]->faltas); 
                   }

                   if($presenca<0){
                           $presenca=0;	
                   }
		
		
                    //select sum(valor),sum(nota) from notas where curso_id=1 and inscrito_id=1
                    $this->db->select_sum('nota');
                    $this->db->select_sum('notas.valor');
                    $this->db->join('exercicios','exercicios.id=notas.exercicio_id');
                    $this->db->where(array('tipo_curso'=>'AL','notas.curso_id'=>$itens->curso_id,'notas.inscrito_id'=>$id,'exercicios.tipo'=>'P'));
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
		
		
		
                    $data["cursos"][]= array('curso_id'=>$itens->curso_id,'tipo_curso'=>$itens->tipo_curso,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_aquisicao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas,'presenca'=>$presenca,'valor'=>$valor,'nota'=>$nota);
		
		
	
		}
             
            } elseif ($tipo_curso=='DE'){ 
		
		//area que calcula os cursos desenvolvimento e suas faltas
		$this->db->select('inscricoes.curso_id,inscricoes.tipo_curso,usuario.nome instrutor,titulo,descricao,data_aquisicao,programas_desenvolvimento.data_conclusao,numero_aulas,curso_id,inscrito_id');
		$this->db->from('inscricoes');
		$this->db->join('programas_desenvolvimento' ,'inscricoes.curso_id = programas_desenvolvimento.id');
                $this->db->join('usuario' ,'programas_desenvolvimento.instrutor_id = usuario.id','left');
		 $this->db->where(array('inscricoes.id'=>$id_inscricao));
		$this->db->order_by('data_aquisicao');
		$query = $this->db->get();
		
		foreach( $query->result() as $itens){
				
                    $this->db->select('count(*) as faltas');
                    $this->db->from('faltas');
                    $array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>'DE');
                    $this->db->where($array);
                    $query2 = $this->db->get();		
                    $faltas= $query2->result();
                
                    $presenca=0;
                   if($itens->numero_aulas >0 && $faltas[0]->faltas>=0){
                      $presenca=((100/$itens->numero_aulas)* $faltas[0]->faltas); 
                   }
		
		
                    if($presenca<0){
                            $presenca=0;	
                    }
		
		
                    //select sum(valor),sum(nota) from notas where curso_id=1 and inscrito_id=1
                    $this->db->select_sum('nota');
                    $this->db->select_sum('notas.valor');
                    $this->db->join('exercicios','exercicios.id=notas.exercicio_id');
                    $this->db->where(array('tipo_curso'=>'DE','notas.curso_id'=>$itens->curso_id,'notas.inscrito_id'=>$id,'exercicios.tipo'=>'P'));
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
		
		
                    $data["cursos"][]	= array('curso_id'=>$itens->curso_id,'tipo_curso'=>$itens->tipo_curso,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_aquisicao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas,'presenca'=>$presenca,'valor'=>$valor,'nota'=>$nota);
		
	
		}
            } elseif ($tipo_curso=='EL'){  
                //area que calcula os cursos elearning e suas faltas
		$this->db->select('inscricoes.curso_id,inscricoes.tipo_curso,usuario.nome instrutor,titulo,descricao,data_aquisicao,elearning.data_conclusao,numero_aulas,curso_id,inscrito_id');
		$this->db->from('inscricoes');
		$this->db->join('elearning' ,'inscricoes.curso_id = elearning.id');
                $this->db->join('usuario' ,'elearning.instrutor_id = usuario.id','left');
		$this->db->where(array('inscricoes.id'=>$id_inscricao));
		$this->db->order_by('data_aquisicao');
		$query = $this->db->get();
		
		foreach( $query->result() as $itens){
				
                    $this->db->select('count(*) as faltas');
                    $this->db->from('faltas');
                    $array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>'EL');
                    $this->db->where($array);
                    $query2 = $this->db->get();		
                    $faltas= $query2->result();
                
                    $presenca=0;
                   if($itens->numero_aulas >0 && $faltas[0]->faltas>=0){
                      $presenca=((100/$itens->numero_aulas)* $faltas[0]->faltas); 
                   }


                   if($presenca<0){
                           $presenca=0;	
                   }
		
		
                    //select sum(valor),sum(nota) from notas where curso_id=1 and inscrito_id=1
                    $this->db->select_sum('nota');
                    $this->db->select_sum('notas.valor');
                    $this->db->join('exercicios','exercicios.id=notas.exercicio_id');
                    $this->db->where(array('tipo_curso'=>'EL','notas.curso_id'=>$itens->curso_id,'notas.inscrito_id'=>$id,'exercicios.tipo'=>'P'));
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
		
		
                    $data["cursos"][]	= array('curso_id'=>$itens->curso_id,'tipo_curso'=>$itens->tipo_curso,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_aquisicao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas,'presenca'=>$presenca,'valor'=>$valor,'nota'=>$nota);
		
	
		}		
            }	
                
                
                
                
                $dados= array_merge($data);

		 $this->loadView('area-restrita-notas',$dados);



	}



}
