<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class area_restrita_meus_cursos extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;
	//var $tipos_cursos   = array('AB' => 'Curso Aberto', 'IN' => 'Curso In Company', 'AL' => 'Programa de Alta Performance', 'DE'=> 'Programa de Desenvolvimento');

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
                $id= $this->session->userdata('SessionIdAluno');
                
                
                
                // este helper controla quem esta logado para exibir o menu da area restrita
                seleciona_menu_area_restrita('F');
                
		
                $data['tipos_cursos']=array('AB' => 'Curso Aberto', 'IN' => 'Curso In Company', 'AL' => 'Programa de Alta Performance', 'DE'=> 'Programa de Desenvolvimento',"EL"=>"E-learning");
		//area que calcula os cursos abertos e suas faltas
		$this->db->select('inscricoes.id id_incricoes,inscricoes.tipo_curso,usuario.nome instrutor,cursos_abertos.titulo,imagem, descricao,data_aquisicao,cursos_abertos.data_conclusao,numero_aulas,curso_id,inscrito_id');
		$this->db->from('inscricoes');
		$this->db->join('cursos_abertos' ,'inscricoes.curso_id = cursos_abertos.id');
                $this->db->join('usuario' ,'usuario.id = cursos_abertos.instrutor_id','left');
		$this->db->where(array('status'=>'AP','inscrito_id'=>$id,'inscricoes.tipo_curso'=>'AB'));
		$this->db->order_by('data_aquisicao');
		$query = $this->db->get();

		foreach( $query->result() as $itens){

		$this->db->select('count(*) as faltas');
		$this->db->from('faltas');
		$array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>'AB');
		$this->db->where($array);
		$query2 = $this->db->get();
		$faltas= $query2->result();

		$data["cursos"][]= array('id_incricoes'=>$itens->id_incricoes,'tipo_curso'=>'AB','curso_id'=>$itens->curso_id,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_conclusao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas, 'imagem' => $itens->imagem);


		}




		//area que calcula os cursos Incompany e suas faltas
		$this->db->select('inscricoes.id id_incricoes,inscricoes.tipo_curso,usuario.nome instrutor,cursos_incompany.titulo,imagem,descricao,data_aquisicao,cursos_incompany.data_conclusao,numero_aulas,curso_id,inscrito_id');
		$this->db->from('inscricoes');
		$this->db->join('cursos_incompany' ,'inscricoes.curso_id = cursos_incompany.id');
                $this->db->join('usuario' ,'usuario.id = cursos_incompany.instrutor_id','left');
		$this->db->where(array('status'=>'AP','inscrito_id'=>$id,'inscricoes.tipo_curso'=>'IN'));
		$this->db->order_by('data_aquisicao');
		$query = $this->db->get();

		foreach( $query->result() as $itens){

		$this->db->select('count(*) as faltas');
		$this->db->from('faltas');
		$array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>'IN' );
		$this->db->where($array);
		$query2 = $this->db->get();
		$faltas= $query2->result();

		$data["cursos"][]	= array('id_incricoes'=>$itens->id_incricoes,'tipo_curso'=>'IN','curso_id'=>$itens->curso_id,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_conclusao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas, 'imagem' => $itens->imagem);


		}


		//area que calcula os cursos alta performace e suas faltas
		$this->db->select('inscricoes.id id_incricoes,inscricoes.tipo_curso,programas_alta_performance.titulo,usuario.nome instrutor,imagem,descricao,data_aquisicao,programas_alta_performance.data_conclusao,numero_aulas,curso_id,inscrito_id');
		$this->db->from('inscricoes');
		$this->db->join('programas_alta_performance' ,'inscricoes.curso_id = programas_alta_performance.id');
                $this->db->join('usuario' ,'usuario.id = programas_alta_performance.instrutor_id','left');
		$this->db->where(array('status'=>'AP','inscrito_id'=>$id,'inscricoes.tipo_curso'=>'AL'));
		$this->db->order_by('data_aquisicao');
		$query = $this->db->get();

		foreach( $query->result() as $itens){

		$this->db->select('count(*) as faltas');
		$this->db->from('faltas');
		$array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>'AL');
		$this->db->where($array);
		$query2 = $this->db->get();
		$faltas= $query2->result();

		$data["cursos"][]= array('id_incricoes'=>$itens->id_incricoes,'tipo_curso'=>'AL','curso_id'=>$itens->curso_id,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_conclusao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas, 'imagem' => $itens->imagem);



		}


		//area que calcula os cursos desenvolvimento e suas faltas
		$this->db->select('inscricoes.id id_incricoes,inscricoes.tipo_curso,programas_desenvolvimento.titulo,usuario.nome instrutor,imagem,descricao,data_aquisicao,programas_desenvolvimento.data_conclusao,numero_aulas,curso_id,inscrito_id');
		$this->db->from('inscricoes');
		$this->db->join('programas_desenvolvimento' ,'inscricoes.curso_id = programas_desenvolvimento.id');
                $this->db->join('usuario' ,'usuario.id = programas_desenvolvimento.instrutor_id','left');
		$this->db->where(array('status'=>'AP','inscrito_id'=>$id,'inscricoes.tipo_curso'=>'DE'));
		$this->db->order_by('data_aquisicao');
		$query = $this->db->get();

		foreach( $query->result() as $itens){

		$this->db->select('count(*) as faltas');
		$this->db->from('faltas');
		$array= array('curso_id '=>$itens->curso_id , 'inscrito_id' => $itens->inscrito_id,'tipo_curso'=>'DE');
		$this->db->where($array);
		$query2 = $this->db->get();
		$faltas= $query2->result();

		$data["cursos"][]	= array('id_incricoes'=>$itens->id_incricoes,'tipo_curso'=>'DE','curso_id'=>$itens->curso_id,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_conclusao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas, 'imagem' => $itens->imagem);


		}


                //area que calcula os cursos elearning e suas faltas
		$this->db->select('inscricoes.id id_incricoes,inscricoes.tipo_curso,elearning.titulo,imagem,descricao,usuario.nome instrutor,inscricoes.data_aquisicao,inscricoes.data_conclusao,numero_aulas,curso_id,inscrito_id');
		$this->db->from('inscricoes');
		$this->db->join('elearning' ,'inscricoes.curso_id = elearning.id');
                $this->db->join('usuario' ,'usuario.id = elearning.instrutor_id','left');
		$this->db->where(array('status'=>'AP','inscrito_id'=>$id,'inscricoes.tipo_curso'=>'EL'));
		$this->db->order_by('data_aquisicao');
		$query = $this->db->get();

		foreach( $query->result() as $itens){

		$this->db->select('count(*) as faltas');
		$this->db->from('faltas');
		$array= array('curso_id '=>$itens->curso_id , 'inscrito_id' =>$id,'tipo_curso'=>'EL');
		$this->db->where($array);
		$query2 = $this->db->get();
		$faltas= $query2->result();

		$data["cursos"][]	= array('id_incricoes'=>$itens->id_incricoes,'tipo_curso'=>'EL','curso_id'=>$itens->curso_id,'titulo' =>$itens->titulo,'descricao' =>$itens->descricao,'instrutor' =>$itens->instrutor,'data_aquisicao' => $itens->data_aquisicao,'data_conclusao' => $itens->data_conclusao,'numero_aulas' => $itens->numero_aulas,'faltas'=>$faltas[0]->faltas, 'imagem' => $itens->imagem);


		}


			$dados= array_merge($data);

			//print_r($dados);
			//exit;
		//,$data["cursos_incompany"]
		 $this->loadView('area_restrita_meus_cursos',$dados);



	}



}
