<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controle_negocios extends CI_Controller {

	var $titulo 		= 'Controle de Negocios';
	var $dir 			= 'multitools/controle_negocios/';
	var $controller 	= 'multitools/controle_negocios';
	var $title_sing 	= 'Controle de Negócio';
	var $per_page 		= 20;
	var $table 			= '';
	var $join			= NULL;

	public function __construct(){
		parent::__construct();
		check_login();
                $this->load->helper('auxiliar_helper');
	}

	public function index($offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();
                
               
		//Registros
		//$data['registros'] = $this->default_model->get_all('vw_datas_especiais', array('vw_datas_especiais.*'), $offset, $this->per_page,null, $this->join, 'data', 'ASC');

		//Parâmetros
		//$data['paginacao']   = $this->_pagination($this->table);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}



	public function gerar_relatorio(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Relatório '.$this->title_sing;               
                
		//Menu
		get_menu();
                
                $dados = $_POST;
                
                $where=null;
        
                if($dados['classificacao']!=''){
                    $where['classificacao']=$dados['classificacao'];
                }
               
                if($dados['data_inicio']!=''){
                    $where['data_programada_apresentacao >=']=ing_date($dados['data_inicio']);
                }
                if($dados['data_fim']!=''){
                   $where['data_programada_apresentacao <= ']=  ing_date($dados['data_fim']);
                }
                if($dados['responsavel']!=''){
                    $where['id_usuario_responsavel_apresentacao']=$dados['responsavel'];
                }
                
                //Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
                $data['titulo'] = $this->titulo;
                    
                    //taxa de Coversão
                   $where['status !=']='N';
                   $this->db->select('count(*) as qtd');
                   $this->db->select_sum('valor_inicial');                  
                   $this->db->select_sum('valor_fechado');
                   $this->db->where($where);
                   $query = $this->db->get('proposta');
                   $data['registros1']=$query->result(); 
                   unset($where['status !=']);
                   
                  
                    if($dados['status']!=''){
                        $where['status']=$dados['status'];
                    }
                    //pontualidade
                   $where['data_programada_apresentacao <= `data_apresentacao`']=null;
                   $this->db->select('count(*) as qtd');
                   $this->db->where($where);
                   $query = $this->db->get('proposta');
                   $data['registros2']=$query->result();                   
                   unset($where['data_programada_apresentacao <= `data_apresentacao`']);
                   
                  
                   //Prazo médio de proposta
                   $where['data_apresentacao != ']='0000-00-00';                   
                   $this->db->select('count(*) as qtd , sum(data_apresentacao - data_solicitacao) as qtd_dias');                   
                   $this->db->where($where);
                   $query = $this->db->get('proposta');
                   $data['registros3']=$query->result();                    
                   unset($where['data_apresentacao != ']);




                    //Indicações
                   $where['indicacao_mb != ']='';
                   $this->db->select('count(*) as qtd');
                   $this->db->where($where);
                   $query = $this->db->get('proposta');
                   $data['registros4']=$query->result();

              
                    //Carrega view
                    $this->load->view($this->dir.'gerar_relatorio', $data);                
                
            
		get_footer(TRUE);
	}

        
        	public function adicionar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}
        
	public function salvar()
	{
		//Recebe Post
		$data = $_POST;
                
                
                //$ano = substr($data['data_especial'],6,9);
                $mes = substr($data['data_especial'],3,2);
                $dia = substr($data['data_especial'],0,2);
                
                $data['data_especial']=$mes."-".$dia;
                
                /*if ($data['variacao']=='S'){
                    $data['ano']=$ano;
                }  */     
                 unset($data['variacao']) ;		
               
		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id'], $data, 'id');
		else{
			$rows_affected = $this->default_model->insert($this->table, $data);
		}

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller);
	}

	public function excluir($id){

		//Exclui registro
		if($this->default_model->delete($this->table, array('id' => $id)))
			$this->session->set_flashdata('msg', 'Você excluiu uma '.$this->title_sing);
		else
			$this->session->set_flashdata('msg', 'Registro não foi desativado!');


		//Retorno
		redirect($this->controller);
	}

	private function _pagination($table, $search = FALSE){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, array(), $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s');
		}
		else{
			$config['uri_segment'] = 4;
			$config['total_rows']  = $this->default_model->count($this->table, array(), $this->join);
			$config['base_url']    = base_url().$this->controller.'/index';
		}

		//Inicializa e retorna paginação
		$this->pagination->initialize($config);
		return $this->pagination->create_links();

	}

	public function buscar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Parâmetros de busca
		$data_busca[$this->table.'.nome_area']  = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*'), NULL, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.ordem', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca);

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