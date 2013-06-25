<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscricoes_empresas_novo extends CI_Controller {

	var $titulo 		= 'Compras/Inscrições';
	var $dir 			= 'multitools/inscricoes_empresas_novo/';
	var $controller 	= 'multitools/inscricoes_empresas_novo';
	var $title_sing 	= '- Compra/Inscrição';
	var $per_page 		= 20;
	var $table 			= 'inscricoes_empresas';
	var $join			= array('inscritos' => array('where' => 'inscritos.id = inscrito_empresa_id', 'type' => 'inner'),
								'cursos_incompany' => array('where' => 'cursos_incompany.id = inscricoes_empresas.curso_id', 'type' => 'left'),
								'programas_desenvolvimento' => array('where' => 'programas_desenvolvimento.id = inscricoes_empresas.curso_id', 'type' => 'left'),
								'programas_alta_performance' => array('where' => 'programas_alta_performance.id = inscricoes_empresas.curso_id', 'type' => 'left')
								);

	var $tipos_cursos   = array('IN' => 'Curso In Company', 'DE' => 'Programa de Desenvolvimento', 'AL' => 'programas_alta_performance');
	var $status   	    = array('AG' => 'Aguardando Pagamento', 'AP' => 'Aprovado', 'RE' => 'Reprovado', 'CA' => 'Cancelado');

	public function __construct(){
		parent::__construct();
		$this->load->helper("br_date_helper");
                $this->load->helper("auxiliar_helper");
		check_login();
	}

	public function index($tipo = 'IN', $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo.' - '.$this->tipos_cursos[$tipo];
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo.' - '.$this->tipos_cursos[$tipo];

                
                
		//Menu
		get_menu();

		//Tipo de Curso
		$data['tipo'] = $tipo;
		$where = ($data['tipo'] ? array('inscricoes_empresas.tipo_curso' => $data['tipo']) : NULL);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome as inscrito, cursos_incompany.titulo as titulo_curso, programas_desenvolvimento.titulo as titulo_programa, programas_alta_performance.titulo as titulo_programas_alta_performance'), $offset, $this->per_page, $where, $this->join, $this->table.'.id', 'DESC');
                
		//Parâmetros
		$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo']);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing.' - '.$this->tipos_cursos[$tipo];

		//Status
		$data['status'] = $this->status;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}
        
        
        
        	public function atualizar_vagas($id_inscricoes_empresa = '',$tipo='', $offset = 0){

                
                                    
                $join = array('controle_inscritos_empresa' => array('where' => 'inscricoes.id = controle_inscritos_empresa.inscricoes_id', 'type' => 'inner'),
                              'inscritos' => array('where' => 'inscritos.id = controle_inscritos_empresa.inscrito_id', 'type' => 'inner'),
								'cursos_incompany' => array('where' => 'cursos_incompany.id = inscricoes.curso_id', 'type' => 'left'),
								'programas_desenvolvimento' => array('where' => 'programas_desenvolvimento.id = inscricoes.curso_id', 'type' => 'left'),
								'programas_alta_performance' => array('where' => 'programas_alta_performance.id = inscricoes.curso_id', 'type' => 'left'));
                    
                $where = array('controle_inscritos_empresa.inscricoes_empresa_id' => $id_inscricoes_empresa,'inscricoes.tipo_curso'=>$tipo);		
                //Registros
		$data['registros'] = $this->default_model->get_all('inscricoes', array('inscricoes'.'.* , controle_inscritos_empresa.inscricoes_empresa_id , inscritos.cpf_cnpj, inscritos.nome as inscrito, cursos_incompany.titulo as titulo_curso, programas_desenvolvimento.titulo as titulo_programa, programas_alta_performance.titulo as titulo_programas_alta_performance'), $offset, $this->per_page, $where, $join, null, null,'controle_inscritos_empresa.inscrito_id');
               
                 //Tipo de Curso
		$data['tipo'] = $tipo;
                     
                $data['id_inscricoes_empresa']=$id_inscricoes_empresa;
		//Cabeçalho
		$titulo = $this->titulo.' - '.$this->tipos_cursos[$data['tipo']];
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo.' - '.$this->tipos_cursos[$data['tipo']];

                
		//Menu
		get_menu();



		//Parâmetros
		$data['paginacao']  = $this->_pagination($this->table, false, $data['tipo']);
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing.' - '.$this->tipos_cursos[$data['tipo']];

		//Status
		$data['status'] = $this->status;

                
		//Carrega view
		$this->load->view($this->dir.'atualizar_vagas', $data);
                
		get_footer(TRUE);
	}
        
        
        public function adicionar_aluno($id_inscricoes_empresa = ''){

		//Cabeçalho
		$titulo = $this->titulo.' - '.$this->tipos_cursos['IN'];
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing.' - '.$this->tipos_cursos['IN'];

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
                
                $data['id_inscricoes_empresa']=$id_inscricoes_empresa;
		//Carrega view
		$this->load->view($this->dir.'form_adicionar', $data);
		get_footer(TRUE);
	}

        	public function salvar_aluno()
	{
		//Recebe Post
		$data = $_POST;
                
                $id_inscricao_empresa=$data['id'];                
                unset($data['inscrito_nome'],$data['id']);
                
                
                
                
                $this->db->select('id inscrito_id,nome,email,cpf_cnpj');
                $this->db->from('inscritos');
                $this->db->where(array('inscritos.id'=>$data['inscrito_id']));
                $query_inscritos = $this->db->get();
                $Aluno=$query_inscritos->result();
               
            if($query_inscritos->num_rows<=0){              
                 
                $msg='Erro:O aluno não foi cadastrado!';
                $this->session->set_flashdata('msg', $msg);
                redirect($this->controller.'/atualizar_vagas/'.$id_inscricao_empresa);
            }
            else{
                 $this->db->select('*');
                 $this->db->from('controle_inscritos_empresa');
                 $this->db->where(array('inscrito_id'=>$Aluno[0]->inscrito_id,'inscricoes_empresa_id'=>$id_inscricao_empresa));
                  $query_confirmacao = $this->db->get();
                  
                  
               if ($query_confirmacao->num_rows>0){
                   $msg='O aluno já estava cadastrado'; 
                   $this->session->set_flashdata('msg', $msg);
                   redirect($this->controller.'/atualizar_vagas/'.$id_inscricao_empresa);
               }
               else{
                //Trata as datas
		$data['data_aquisicao'] = w3c_date($_POST['data_aquisicao']);
		$data['data_conclusao'] = w3c_date($_POST['data_conclusao']);
                
                 $this->db->select('*');
                 $this->db->from('inscricoes_empresas');
                 $this->db->where(array('id'=>$id_inscricao_empresa));
                  $query_dados = $this->db->get();
                  $empresa=$query_dados->result();            
                
                
                    $data1 = array(
                        'inscrito_id' => $Aluno[0]->inscrito_id ,
                        'curso_id' => $empresa[0]->curso_id,                        
                        'turma_id' => null ,
                        'compra_id' => null,
                        'tipo_curso' => $empresa[0]->tipo_curso,
                        'status' => 'AP',
                        'valor' => '0.00',
                        'data_aquisicao' => $data['data_aquisicao'],
                        'data_conclusao' => $data['data_conclusao'],
                        'created' => date("Y-m-d H:i:s") ,
                        'gerar_certificado' => 'N'
                        
                    );
                    $this->db->insert('inscricoes', $data1);                    
                    $inscricoes_id=$this->db->insert_id();
                    
                    $data2= array('inscricoes_id'=>$inscricoes_id,'inscrito_id'=>$data['inscrito_id'],'inscricoes_empresa_id'=>$id_inscricao_empresa);
                    $this->db->insert('controle_inscritos_empresa', $data2);
                    
                    $msg = 'Dados salvos com sucesso.';
                     //Retorno
                     $this->session->set_flashdata('msg', $msg);
                     redirect($this->controller.'/atualizar_vagas/'.$id_inscricao_empresa.'/'.$empresa[0]->tipo_curso);
                
                
               }
            }

	}
        
        
        
        
        
        
        
        
        
        
        

	public function adicionar($tipo = ''){

		//Cabeçalho
		$titulo = $this->titulo.' - '.$this->tipos_cursos[$tipo];
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing.' - '.$this->tipos_cursos[$tipo];

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Cursos
		$data['tipo'] = $tipo;
		$tabela_cursos = ($tipo == 'IN' ? 'cursos_incompany' : ($tipo =='EL' ? 'elearning' : 'programas_desenvolvimento'));
		$data['cursos'] = $this->default_model->listaAssociativa($tabela_cursos, 'titulo');

		//Inscritos
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome');

		//Status
		$data['status'] = $this->status;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
                
               //Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);
     
                //Tipo de Curso
		$data['tipo'] = $data['registro']->tipo_curso;
                
                
                
		$data['h1'] = 'Editar '.$this->title_sing.' - '.$this->tipos_cursos[$data['tipo']];

		//Menu
		get_menu();


                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Cursos
		$data['tipo'] = $data['registro']->tipo_curso;
		$tabela_cursos = ($data['tipo'] == 'IN' ? 'cursos_incompany' : ($data['tipo'] =='EL' ? 'elearning' : 'programas_desenvolvimento'));
		$data['cursos'] = $this->default_model->listaAssociativa($tabela_cursos, 'titulo');

		//Inscritos
		//$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome');
                
                $id_inscrito= count($data['registro'])>0 ? $data['registro']->inscrito_empresa_id : '';
                $data['inscritos']= $this->default_model->get_all('inscritos', array('inscritos'.'.*'), null,null, array('id'=>$id_inscrito), null, null, null);
                

		//Status
		$data['status'] = $this->status;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;
                unset($data['inscrito_nome']);

                
		//Trata as datas
		$data['data_aquisicao'] = w3c_date($_POST['data_aquisicao']);
		$data['data_conclusao'] = w3c_date($_POST['data_conclusao']);

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id'], $data);
		else{
                    
			$data['created']  = date('Y-m-d H:i:s');
			$rows_affected = $this->default_model->insert($this->table, $data);
		}

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller.'/index/'.$data['tipo_curso']);
	}
        
        
        
        
        
       public function excluir_aluno($id,$id_inscricoes_empresa){

		//Tipo de Curso
		 $this->db->select('*');
                 $this->db->from('inscricoes');
                 $this->db->where(array('inscricoes.id'=>$id));
                 $query= $this->db->get();
                 $result=$query->result();
                
		//Exclui registro
		if($this->default_model->delete('controle_inscritos_empresa', array('inscricoes_id'=>$id))){
                    if($this->default_model->delete('inscricoes', array('id'=>$id)))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
                    else
                       $this->session->set_flashdata('msg', 'Erro a Inscrição de numero! '.$id.' não foi excluída!'); 
                }else{
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');
                }

		//Retorno
		redirect($this->controller.'/atualizar_vagas/'.$id_inscricoes_empresa.'/'.$result[0]->tipo_curso);
	}
        
        

	public function excluir($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);
		$tipo = $data['registro']->tipo_curso;

		//Exclui registro
		if($this->default_model->delete($this->table, array('id'=>$id)))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');

		//Retorno
		redirect($this->controller.'/index/'.$tipo);
	}

	private function _pagination($table, $search = FALSE, $tipo){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		$where = ($tipo ? array('inscricoes_empresas.tipo_curso' => $tipo) : NULL);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&tipo='.$tipo;
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$tipo;
		}

		//Inicializa e retorna paginação
		$this->pagination->initialize($config);
		return $this->pagination->create_links();

	}

	public function buscar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
                $data['tipo'] = $this->input->get('tipo');
		$data['h1'] = $this->titulo.' - '.$this->tipos_cursos[$data['tipo']];

                //Status
		$data['status'] = $this->status;
                
                
		//Menu
		get_menu();

		//Parâmetros de busca
		$data_busca['inscritos.nome']  = $this->input->get('s');
		

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, inscritos.nome as inscrito, cursos_incompany.titulo as titulo_curso, programas_desenvolvimento.titulo as titulo_programa, programas_alta_performance.titulo as titulo_programas_alta_performance  '), array('tipo_curso' => $data['tipo']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'DESC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['tipo']);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */