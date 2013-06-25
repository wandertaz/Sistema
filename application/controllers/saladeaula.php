
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class saladeaula extends MY_Controller {

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

	public function index(){
             check_login_aluno();
             redirect(site_url());
            
        }
        public function fazerexercicio($id_exercicio,$curso_id,$tipo_curso){
             check_login_aluno();
             $id= $this->session->userdata('SessionIdAluno');
             $data['parametros']=array('id_exercicio'=>$id_exercicio,'curso_id'=>$curso_id,'tipo_curso'=>$tipo_curso);
             
             // aqui salva a pergunta anterior na tabela temp do exercicio
             if($_POST){
               //aqui valcula a nota de cada pergunta  
                    //valor total do exercício
                    $this->db->select('valor');
                    $this->db->from('exercicios');   
                    $this->db->where(array('id'=>$id_exercicio));
                    $query4 = $this->db->get();
                    $data['valor']=$query4->result();
                    $valor=$data['valor'][0]->valor;


                    //total de perguntas para calcular a nota               
                    $this->db->from('exercicios_perguntas');   
                    $this->db->where(array('exercicio_id'=>$id_exercicio));
                    $qtd_perguntas=$this->db->count_all_results();

                    $valor_pergunta=$valor/$qtd_perguntas;
              //aqui valcula a nota de cada pergunta  
                   
                    
                 //alternativas de cada pergunta                
                $this->db->select('*');
                $this->db->from('exercicios_alternativas');
                $this->db->where(array('id'=> $_POST['alternativa']));                
                $query3 = $this->db->get();
                $data['resultado']=$query3->result();
                
                $valorquestao=0;
                $nota=0;  
                
                if ($data['resultado'][0]->correta=='S'){                
                    $nota= number_format(($valor_pergunta),2);                   
                    
                  
                } 
                    
                // verifica seeste item já foi inserido
                // se ja foi não deixa inserir denovo
                $this->db->select('count(*) qtd_item');
                $this->db->from('temp_exercicios');
                $this->db->where(array('pergunta_id'=> $data['resultado'][0]->pergunta_id,'inscrito_id'=>$id,'exercicio_id'=>$id_exercicio));
                $query3 = $this->db->get();
                $data['qtd_item']=$query3->result();
                
                
               // se o aluno ja respondeu e voltar, vale a 1º resposta.
                //print_r($data['qtd_item'][0]->qtd_item);
               // exit;
               if ($data['qtd_item'][0]->qtd_item ==0){
                    $dat = array(
                        'pergunta_id' => $data['resultado'][0]->pergunta_id ,
                        'inscrito_id' => $id ,
                        'nota_pergunta' => $nota,
                        'exercicio_id' => $id_exercicio,
                        
                     );
                    //print_r($dat);
                    $this->db->insert('temp_exercicios', $dat);
                   // print_r( $this->db->insert_id());
                   // exit();
               }   
                 
                    
                
                    
                
           
             }
             
             //perguntas respondidas
             $this->db->select('pergunta_id');
             $this->db->from('temp_exercicios');
             $this->db->where(array('inscrito_id'=>$id));
             $query2 = $this->db->get();
             $data['respondidas']=$query2->result();
             //$notin='';
             
             
             
             $notin=array();
             //pega as perguntas que já foram rtespondidas
             foreach ($data['respondidas'] as $itens){
                 array_push($notin,$itens->pergunta_id);
      
             }             
              
            
              
             $data['perguntasrespondidas']=count($data['respondidas']);
            
           
             
            //proxima pergunta
            $this->db->select('*');
            $this->db->from('exercicios_perguntas');   
            $this->db->where(array('exercicio_id'=>$id_exercicio));
            if ($data['perguntasrespondidas']>0){
                $this->db->where_not_in('exercicios_perguntas.id',$notin);
            }
            $this->db->order_by('ordem');
            $this->db->limit(1);
            $query = $this->db->get();
            $data['pergunta']=$query->result();
            
            // testa acabaram as perguntas
            //se acabaram vai para uma tela de finalizar
            $data['fimexercicio']=false;
            if (count($data['pergunta'])==0){
                $data['fimexercicio']=true;
                
                // pega dados a serem salvos do exercicio
                $this->db->select('*');
                $this->db->from('exercicios'); 
                $this->db->where(array('id'=>$id_exercicio));
                $query = $this->db->get();
                $data['exercicio']=$query->result();
                
               
                
                
                //calcula a nota
                $this->db->select('sum(nota_pergunta) total,exercicio_id,pergunta_id,inscrito_id');
                $this->db->from('temp_exercicios'); 
                $this->db->where(array('exercicio_id'=>$id_exercicio,'inscrito_id'=>$id));
                $queryTotal = $this->db->get();
                $data['totalexercicio']=$queryTotal->result();
                
                
                //verifica se a nota ja foi cadastrada
                //apenas a 1 nota de cada exercicio e cadastrada
                $this->db->select('count(*) controle');
                $this->db->from('notas'); 
                $this->db->where(array('exercicio_id'=>$id_exercicio,'inscrito_id'=>$id,'tipo_curso'=>$tipo_curso));
                $query = $this->db->get();
                $data['controle']=$query->result();
                
               
                // apenas salva a nota se a nota ja não foi cadastrada anteriormente
               if ($data['controle'][0]->controle==0){
                   
                $dat = array(
                        'exercicio_id' => $id_exercicio,
                        'inscrito_id' => $id ,
                        'curso_id' =>$curso_id ,
                        'tipo_curso' =>$tipo_curso ,
                        'titulo' => $data['exercicio'][0]->titulo ,
                        'valor'=>$data['exercicio'][0]->valor,
                        'nota'=>$data['totalexercicio'][0]->total,   
                        'data' => date("Y-m-d") 
                     );
                    $this->db->insert('notas', $dat);
                    
                    
                    
                    
                    
                    
               } 
                   
                   $data['finalizando'] = array(
                        'exercicio_id' => $id_exercicio,
                        'inscrito_id' => $id ,
                        'curso_id' =>$curso_id ,
                        'tipo_curso' =>$tipo_curso ,
                        'titulo' => $data['exercicio'][0]->titulo ,
                        'valor'=>$data['exercicio'][0]->valor,
                        'nota'=>round($data['totalexercicio'][0]->total),   
                        'data' => date("Y-m-d") 
                     );
                   
               
                //$this->db->where('inscrito_id',$id);
               // $this->db->delete('temp_exercicios'); 
               
            }
        // testa acabaram as perguntas
         //se acabaram vai para uma tela de finalizar
           
            
            
            
            //se não acabou no exercicio executa
           if($data['fimexercicio']==false){
                
            //alternativas de cada pergunta
            $this->db->select('*');
            $this->db->from('exercicios_alternativas');
            $this->db->where(array('pergunta_id'=>$data['pergunta'][0]->id));
            $this->db->order_by('rand()');
            $query3 = $this->db->get();
            $data['alternativas']=$query3->result();
            
           }
            
            $dados= array_merge($data);           
            $this->loadView('exercicio',$dados);
            
        }
 
        
       public function fazerprova_ol($id_prova,$curso_id){
             check_login_aluno();
             
             $data=array();
            $dados= array_merge($data);
             // print_r($dados);
            //  exit();
            $this->loadView('prova',$dados);
            
        }
        
        public function fazerprova($id_exercicio,$curso_id,$tipo_curso){
             check_login_aluno();
             $id= $this->session->userdata('SessionIdAluno');
             $data['parametros']=array('id_exercicio'=>$id_exercicio,'curso_id'=>$curso_id,'tipo_curso'=>$tipo_curso);
             
             // aqui salva a pergunta anterior na tabela temp do exercicio
             if($_POST){
                 
                //valor total do exercício
                $this->db->select('valor');
                $this->db->from('exercicios');   
                $this->db->where(array('id'=>$id_exercicio));
                $query4 = $this->db->get();
                $data['valor']=$query4->result();
                $valor=$data['valor'][0]->valor;
                
                
                //total de perguntas para calcular a nota               
                $this->db->from('exercicios_perguntas');   
                $this->db->where(array('exercicio_id'=>$id_exercicio));
                $qtd_perguntas=$this->db->count_all_results();
                
                
                 
                 //alternativas de cada pergunta
                $this->db->select('*');
                $this->db->from('exercicios_alternativas');
                $this->db->where(array('id'=> $_POST['alternativa']));                
                $query3 = $this->db->get();
                $data['resultado']=$query3->result();
                
                $valorquestao=0;
                $nota=0;  
                
                if ($data['resultado'][0]->correta=='S'){                
                    //$nota= number_format(((100/$qtd_perguntas)*1),2);   
                    $nota= number_format(($valor_pergunta),2);
                } 
                    
                // verifica seeste item já foi inserido
                // se ja foi não deixa inserir denovo
                $this->db->select('count(*) qtd_item');
                $this->db->from('temp_prova');
                $this->db->where(array('pergunta_id'=> $data['resultado'][0]->pergunta_id,'inscrito_id'=>$id,'exercicio_id'=>$id_exercicio));
                $query3 = $this->db->get();
                $data['qtd_item']=$query3->result();
                
               // se o aluno ja respondeu e voltar, vale a 1º resposta.
               if ($data['qtd_item'][0]->qtd_item ==0){
                    $dat = array(
                        'pergunta_id' => $data['resultado'][0]->pergunta_id ,
                        'inscrito_id' => $id ,
                        'exercicio_id' => $id_exercicio,
                        'nota_pergunta' => $nota
                     );

                    $this->db->insert('temp_prova', $dat); 
               }   
                 
                    
                
                    
                
           
             }
             
             //perguntas respondidas
             $this->db->select('pergunta_id');
             $this->db->from('temp_prova'); 
             $query2 = $this->db->get();
             $data['respondidas']=$query2->result();
             //$notin='';
             
             
             
             $notin=array();
             //pega as perguntas que já foram rtespondidas
             foreach ($data['respondidas'] as $itens){
                 array_push($notin,$itens->pergunta_id);
      
             }             
              
            
              
             $data['perguntasrespondidas']=count($data['respondidas']);
            
             
             
            //proxima pergunta
            $this->db->select('*');
            $this->db->from('exercicios_perguntas');   
            $this->db->where(array('exercicio_id'=>$id_exercicio));
            if ($data['perguntasrespondidas']>0){
                $this->db->where_not_in('exercicios_perguntas.id',$notin);
            }
            $this->db->order_by('ordem');
            $this->db->limit(1);
            $query = $this->db->get();
            $data['pergunta']=$query->result();
            
            // testa acabaram as perguntas
            //se acabaram vai para uma tela de finalizar
            $data['fimexercicio']=false;
            if (count($data['pergunta'])==0){
                $data['fimexercicio']=true;
                
                // pega dados a serem salvos do exercicio
                $this->db->select('*');
                $this->db->from('exercicios'); 
                $this->db->where(array('id'=>$id_exercicio));
                $query = $this->db->get();
                $data['exercicio']=$query->result();
                
               
                
                
                //calcula a nota
                $this->db->select('sum(nota_pergunta) total,exercicio_id,pergunta_id,inscrito_id');
                $this->db->from('temp_prova'); 
                $this->db->where(array('exercicio_id'=>$id_exercicio,'inscrito_id'=>$id));
                $queryTotal = $this->db->get();
                $data['totalexercicio']=$queryTotal->result();
                
                
                //verifica se a nota ja foi cadastrada
                //apenas a 1 nota de cada exercicio e cadastrada
                $this->db->select('count(*) controle');
                $this->db->from('notas'); 
                $this->db->where(array('exercicio_id'=>$id_exercicio,'inscrito_id'=>$id,'tipo_curso'=>$tipo_curso));
                $query = $this->db->get();
                $data['controle']=$query->result();
                
               
                // apenas salva a nota se a nota ja não foi cadastrada anteriormente
               if ($data['controle'][0]->controle==0){
                   
                $dat = array(
                        'exercicio_id' => $id_exercicio,
                        'inscrito_id' => $id ,
                        'curso_id' =>$curso_id ,
                        'tipo_curso' =>$tipo_curso ,
                        'titulo' => $data['exercicio'][0]->titulo ,
                        'valor'=>$data['exercicio'][0]->valor,
                        'nota'=>$data['totalexercicio'][0]->total,   
                        'data' => date("Y-m-d") 
                     );
                    $this->db->insert('notas', $dat);
                    
                    
                    
                    
                    
                    
               } 
                   
                   $data['finalizando'] = array(
                        'exercicio_id' => $id_exercicio,
                        'inscrito_id' => $id ,
                        'curso_id' =>$curso_id ,
                        'tipo_curso' =>$tipo_curso ,
                        'titulo' => $data['exercicio'][0]->titulo ,
                        'valor'=>$data['exercicio'][0]->valor,
                        'nota'=>round($data['totalexercicio'][0]->total),   
                        'data' => date("Y-m-d") 
                     );
                   
               
                //$this->db->where('inscrito_id',$id);
                //$this->db->delete('temp_prova'); 
               
            }
        // testa acabaram as perguntas
         //se acabaram vai para uma tela de finalizar
           
            
            
            
            //se não acabou no exercicio executa
           if($data['fimexercicio']==false){
                
            //alternativas de cada pergunta
            $this->db->select('*');
            $this->db->from('exercicios_alternativas');
            $this->db->where(array('pergunta_id'=>$data['pergunta'][0]->id));
            $this->db->order_by('rand()');
            $query3 = $this->db->get();
            $data['alternativas']=$query3->result();
            
           }
            
            $dados= array_merge($data);           
            $this->loadView('prova',$dados);
            
        }
        
        
        
        
}
