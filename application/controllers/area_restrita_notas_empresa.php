
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class area_restrita_notas_empresa extends MY_Controller {

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
		
	        check_login_empresa();
                if ($this->session->userdata('SessionIdEmpresa')>0){                    
                   $id= $this->session->userdata('SessionIdEmpresa');
                    // este helper controla quem esta logado para exibir o menu da area restrita
                        seleciona_menu_area_restrita('J');
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){                        
                   $id= $this->session->userdata('SessionEmpresaPermissoes');
                        // este helper controla quem esta logado para exibir o menu da area restrita
                        seleciona_menu_area_restrita('FJ');
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
		
                    
                    
                    //aqui pega todos os inscritos do curso especifico e da empresa especifica
                    $this->db->select('inscrito_id,nome,email');
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
                        
                       $data["inscritos_notas"][]= array('inscrito_id'=>$itens_inscritos->inscrito_id,'nome'=>$itens_inscritos->nome,'email'=>$itens_inscritos->email,'faltas'=>$faltas[0]->faltas,'valor'=>$valor,'nota'=>$nota); 
                    }
                    
                    
             
                }
                
                
                
                
                $dados= array_merge($data);

		 $this->loadView('area-restrita-notas-empresa',$dados);



	}



}
