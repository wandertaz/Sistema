<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class certificado extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	public function __construct(){
		parent::__construct();
        $data['title'] = 'MB Consultoria - Serviços';
		//Carrega model e helpers
		$this->load->model("certificados_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('text_helper');
                $this->load->helper('auxiliar_helper');
	}

	public function index(){
		
                check_login_aluno();

                $aluno = $this->session->userdata('SessionIdAluno');
                $id=$aluno;// não deletar 
                $this->load->model("certificados_model");

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
                
                        
                        
                        
                        
                        
                      if  ($tipo_curso!='EL') {
                        
                            $certificados = $this->certificados_model->get_certificado($aluno,$id_inscricao);
                            foreach ($certificados as $key) {
                                    //if($key['tipo_curso']!='EL'){
                                            $data['cursos'][] = $this->certificados_model->get_curso($key['curso_id'], $key['tipo_curso']);
                                            $data['emitir'][] = site_url('imprimir_certificado').'?idc='.$key['curso_id'].'&tc='.$key['tipo_curso'];
                                   // }
                            }
                      }else{
                            $notaVal = $this->certificados_model->get_certificado_elearning($aluno,$id_inscricao);
                            if ($notaVal[0]['nota']>=70){
                                    foreach ($notaVal as $key2) {
                                            $data['cursos'][] = $this->certificados_model->get_curso($key2["curso_id"], $key2['tipo_curso']);
                                            $data['emitir'][] = site_url('imprimir_certificado').'?idc='.$key2["curso_id"].'&tc='.$key2['tipo_curso'].'&n='.$key2['nota'];
                                    }				
                            }
                     }
            $this->loadView('area-restrita-certificado',$data);
    }


  
 }
