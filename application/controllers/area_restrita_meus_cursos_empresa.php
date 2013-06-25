<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class area_restrita_meus_cursos_empresa extends MY_Controller {

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
            // cada modulo terá um numero que e visualizado na primary da tabela area_permissoes_concedidas
	        check_login_empresa(1);
                if ($this->session->userdata('SessionIdEmpresa')>0){
                    
                   $id= $this->session->userdata('SessionIdEmpresa'); 
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){                        
                   $id= $this->session->userdata('SessionEmpresaPermissoes');     
                }
                
               $dados['tipos_cursos']=array('AB' => 'Curso Aberto', 'IN' => 'Curso In Company', 'AL' => 'Programa de Alta Performance', 'DE'=> 'Programa de Desenvolvimento',"EL"=>"E-learning");
		//area que calcula os cursos alta performace e suas faltas
		$this->db->select('inscricoes_empresas.id id_incricoes_empresa,inscricoes_empresas.tipo_curso,programas_alta_performance.titulo,usuario.nome instrutor,descricao,data_aquisicao,programas_alta_performance.data_conclusao,numero_aulas,curso_id,inscrito_empresa_id');
		$this->db->from('inscricoes_empresas');
		$this->db->join('programas_alta_performance' ,'inscricoes_empresas.curso_id = programas_alta_performance.id');
                $this->db->join('usuario' ,'usuario.id = programas_alta_performance.instrutor_id','left');
		$this->db->where(array('status'=>'AP','inscrito_empresa_id'=>$id,'inscricoes_empresas.tipo_curso'=>'AL'));
		$this->db->order_by('data_aquisicao');
		$query = $this->db->get();
		foreach( $query->result() as $itens){
		$dados["cursos"][]= array('id_incricoes_empresa'=>$itens->id_incricoes_empresa,'tipo_curso'=>'AL','curso_id'=>$itens->curso_id,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_conclusao,'numero_aulas' => $itens->numero_aulas);
		
		}
                
                //area que calcula os cursos incompany e suas faltas
		$this->db->select('inscricoes_empresas.id id_incricoes_empresa,inscricoes_empresas.tipo_curso,cursos_incompany.titulo,usuario.nome instrutor,descricao,data_aquisicao,cursos_incompany.data_conclusao,numero_aulas,curso_id,inscrito_empresa_id');
		$this->db->from('inscricoes_empresas');
		$this->db->join('cursos_incompany' ,'inscricoes_empresas.curso_id = cursos_incompany.id');
                $this->db->join('usuario' ,'usuario.id = cursos_incompany.instrutor_id','left');
		$this->db->where(array('status'=>'AP','inscrito_empresa_id'=>$id,'inscricoes_empresas.tipo_curso'=>'IN'));
		$this->db->order_by('data_aquisicao');
		$query = $this->db->get();
		foreach( $query->result() as $itens){
		$dados["cursos"][]= array('id_incricoes_empresa'=>$itens->id_incricoes_empresa,'tipo_curso'=>'IN','curso_id'=>$itens->curso_id,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_conclusao,'numero_aulas' => $itens->numero_aulas);
		
		}
                
                
                
                
                
                
                
                
               
		 $this->loadView('area_restrita_meus_cursos_empresa',$dados);



	}



}

