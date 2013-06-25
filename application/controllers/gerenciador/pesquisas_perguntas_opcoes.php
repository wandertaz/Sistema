<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesquisas_perguntas_opcoes extends CI_Controller {

	var $titulo 		= 'Opções de Resposta';
	var $dir 			= 'multitools/pesquisas_perguntas_opcoes/';
	var $controller 	= 'multitools/pesquisas_perguntas_opcoes';
	var $title_sing 	= 'Opção';
	var $per_page 		= 20;
	var $table 			= 'pesquisas_perguntas_opcoes';
	var $join			= array('pesquisas_perguntas' => array('where' => 'pesquisas_perguntas.id_pesquisas_perguntas = pesquisas_perguntas_opcoes.pesquisas_perguntas_id_pesquisas_perguntas', 'type' => 'inner'));

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($pergunta_id, $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//perguntas
		$data['pesquisas_perguntas_id_pesquisas_perguntas'] = $pergunta_id;
		$where = array('pesquisas_perguntas_opcoes.pesquisas_perguntas_id_pesquisas_perguntas' => $data['pesquisas_perguntas_id_pesquisas_perguntas']);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, pergunta, pesquisas_id_pesquisas'), $offset, $this->per_page, $where, $this->join, $this->table.'.ordem', 'ASC');
                
		//Registros Perguntas
		$data['pergunta'] = $this->default_model->get_by_id('pesquisas_perguntas', $pergunta_id, array('pesquisas_perguntas.pesquisas_id_pesquisas'), NULL, NULL, 'id_pesquisas_perguntas');
                              
		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false, $data['pesquisas_perguntas_id_pesquisas_perguntas']);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($pergunta_id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Busca pergunta
		$data['pergunta'] = $this->default_model->get_by_id('pesquisas_perguntas', $pergunta_id, array('*'), NULL, NULL, 'id_pesquisas_perguntas');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca lista de Perguntas
		$data['pesquisas_perguntas_id_pesquisas_perguntas'] = $pergunta_id;
		$data['perguntas'] = $this->default_model->listaAssociativa('pesquisas_perguntas', 'pergunta', NULL, array('id_pesquisas_perguntas' => $data['pesquisas_perguntas_id_pesquisas_perguntas']), NULL, NULL, false, 'id_pesquisas_perguntas');
		unset($data['perguntas']['']);

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
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas_perguntas_opcoes');

                
		//Busca pergunta
		$data['pergunta'] = $this->default_model->get_by_id('pesquisas_perguntas', $data['registro']->id_pesquisas_perguntas, array('*'), NULL, NULL, 'id_pesquisas_perguntas');

                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca lista de Perguntas
		$data['pesquisas_perguntas_id_pesquisas_perguntas'] =$data['registro']->pesquisas_perguntas_id_pesquisas_perguntas; //$pergunta_id;
		$data['perguntas'] = $this->default_model->listaAssociativa('pesquisas_perguntas', 'pergunta', NULL, array('id_pesquisas_perguntas' => $data['registro']->pesquisas_perguntas_id_pesquisas_perguntas), NULL, NULL, false, 'id_pesquisas_perguntas');
		unset($data['perguntas']['']);

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_pesquisas_perguntas_opcoes"]) && $data["id_pesquisas_perguntas_opcoes"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id_pesquisas_perguntas_opcoes'], $data, 'id_pesquisas_perguntas_opcoes');
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
		redirect($this->controller.'/index/'.$data['pesquisas_perguntas_id_pesquisas_perguntas']);
	}

	public function excluir($id){

		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas_perguntas_opcoes');
		if($this->default_model->update_where($this->table,array('ativo'=>'N'),array('id_pesquisas_perguntas_opcoes'=>$id)))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');

		//Retorno
		redirect($this->controller.'/index/'.$data['registro']->pesquisas_perguntas_id_pesquisas_perguntas);
	}

	private function _pagination($table, $search = FALSE, $pergunta_id){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//where
		$where = array('pesquisas_perguntas_opcoes.pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta_id);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&pergunta_id='.$pergunta_id;
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$pergunta_id;
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
		$data_busca[$this->table.'.opcao']  = $this->input->get('s');
		$data['pesquisas_perguntas_id_pesquisas_perguntas'] = $this->input->get('pergunta_id');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, pergunta'), array('pesquisas_perguntas_opcoes.pesquisas_perguntas_id_pesquisas_perguntas' => $data['pesquisas_perguntas_id_pesquisas_perguntas']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.ordem', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['pesquisas_perguntas_id_pesquisas_perguntas']);

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