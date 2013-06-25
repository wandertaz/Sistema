<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autodiagnosticos_inscricoes extends CI_Controller {

	var $titulo 		= 'Inscrições de Autodiagnósticos';
	var $dir 			= 'multitools/autodiagnosticos_inscricoes/';
	var $controller 	= 'multitools/autodiagnosticos_inscricoes';
	var $title_sing 	= 'Inscrição';
	var $per_page 		= 25;
	var $table 			= 'autodiagnostico_inscricoes';
	var $join			= array('inscritos' => array('where' => 'inscritos.id = inscritos_id', 'type' => 'inner'),
								'autodiagnosticos' => array('where' => 'autodiagnosticos.id_autodiagnostico = autodiagnosticos_id_autodiagnostico', 'type' => 'inner'),
								'autodiagnostico_respostas' => array('where' => 'autodiagnostico_respostas.autodiagnostico_inscricoes_id_inscricao = id_inscricao', 'type' => 'left')
							);
	var $status         = array('P' => 'Pendente', 'A' => 'Em Andamento', 'F' => 'Finalizado');

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome as inscrito, autodiagnosticos.nome as autodiagnostico, SUM(valor) as resultado'), $offset, $this->per_page, array($this->table.'.ativo'=>'S'), $this->join, $this->table.'.id_inscricao', 'DESC', 'id_inscricao');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Status
		$data['status'] = $this->status;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}
        
        
     public function gerarrelatorio(){
            //Status
		$data['status'] = $this->status;
         


               $join			= array('compras' => array('where' => 'compras_id = compras.id', 'type' => 'inner'),
								'autodiagnosticos' => array('where' => 'autodiagnosticos.id_autodiagnostico = autodiagnosticos_id_autodiagnostico', 'type' => 'inner')
								
							);
                
                
                //Registros
		$data['registros'] = $this->default_model->get_all($this->table, array('nome,count(*) as qtd'),0, null, array('compras.status'=>'AP'), $join, $this->table.'.id_inscricao', 'DESC', 'autodiagnosticos_id_autodiagnostico');
      
                $this->load->view($this->dir.'relatorio', $data);
     }   
        
        
        
        
        

/*	public function adicionar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Inscritos e autodiagnósticos
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome');
		$data['autodiagnosticos'] = $this->default_model->listaAssociativa('autodiagnosticos', 'nome', NULL, NULL, NULL, NULL, false, 'id_autodiagnostico');

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
		$data['h1'] = 'Editar '.$this->title_sing;;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_inscricao');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Inscritos e autodiagnósticos
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome');
		$data['autodiagnosticos'] = $this->default_model->listaAssociativa('autodiagnosticos', 'nome', NULL, NULL, NULL, NULL, false, 'id_autodiagnostico');

		//Status
		$data['status'] = $this->status;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}
*/
	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_inscricao"]) && $data["id_inscricao"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id_inscricao'], $data, 'id_inscricao');
		else{
			$data['data_inscricao'] = date('Y-m-d H:i:s');
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
		if($this->default_model->update($this->table,$id, array('ativo'=>'N'),'id_inscricao'))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');

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
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, array($this->table.'.ativo'=>'S'), $this->join, 'id_inscricao');
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s');
		}
		else{
			$config['uri_segment'] = 4;
			$config['total_rows']  = $this->default_model->count($this->table,array($this->table.'.ativo'=>'S'), $this->join, 'id_inscricao');
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
		//$data_busca['inscritos.nome']  = $this->input->get('s');
		$data_busca['autodiagnosticos.nome'] = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search_distinct($this->table, array($this->table.'.*, inscritos.nome as inscrito, autodiagnosticos.nome as autodiagnostico, SUM(valor) as resultado'), array($this->table.'.ativo'=>'S'), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id_inscricao', 'DESC', 'id_inscricao');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Status
		$data['status'] = $this->status;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */