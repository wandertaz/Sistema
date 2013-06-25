<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesquisas_perguntas extends CI_Controller {

	var $titulo 		= 'Perguntas';
	var $dir 			= 'multitools/pesquisas_perguntas/';
	var $controller 	= 'multitools/pesquisas_perguntas';
	var $title_sing 	= 'Pergunta';
	var $per_page 		= 20;
	var $table 			= 'pesquisas_perguntas';
	var $join			= array('pesquisas' => array('where' => 'pesquisas.id_pesquisas = pesquisas_perguntas.pesquisas_id_pesquisas', 'type' => 'inner'),
								'pesquisas_perguntas AS perguntas' => array('where' => 'perguntas.id_pesquisas_perguntas = pesquisas_perguntas.pesquisas_perguntas_id_pesquisas_perguntas', 'type' => 'left')
							);
	var $tipos_pergunta = array('RAD' => 'Múltipla escolha com possibilidade de uma resposta', 'CHE' => 'Múltipla escolha com possibilidade de várias respostas', 'P05' => 'Pontuação de 1 até 5', 'P10' => 'Pontuação de 1 até 10', 'CLA' => 'Classificação das questões', 'ABE' => 'Questão Aberta');

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($pesquisa_id = false, $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//pequisa
		$data['pesquisas_id_pesquisas'] = $pesquisa_id;
		$where = $data['pesquisas_id_pesquisas'] ? array('pesquisas_perguntas.pesquisas_id_pesquisas' => $data['pesquisas_id_pesquisas']) : NULL;

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, titulo, perguntas.pergunta as pergunta_principal'), $offset, $this->per_page, $where, $this->join, $this->table.'.ordem', 'ASC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false, $data['pesquisas_id_pesquisas']);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Tipos
		$data['tipos_pergunta'] = $this->tipos_pergunta;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($pesquisa_id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;           
                //Busca da sugestão
		$data['sugestao'] = '';
                

		//Busca lista de Pesquisas
		$data['pesquisas_id_pesquisas'] = $pesquisa_id;
		$data['pesquisas'] = $this->default_model->listaAssociativa('pesquisas', 'titulo', NULL, array('id_pesquisas' => $data['pesquisas_id_pesquisas']), NULL, NULL, false, 'id_pesquisas');
		unset($data['pesquisas']['']);

		//Perguntas (para agrupamento)
		$data['perguntas'] = $this->default_model->listaAssociativa('pesquisas_perguntas', 'pergunta', NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => NULL,'pesquisas_id_pesquisas' => $data['pesquisas_id_pesquisas']), NULL, NULL, false, 'id_pesquisas_perguntas');

		//Tipos
		$data['tipos_pergunta'] = $this->tipos_pergunta;

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
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas_perguntas');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca lista de pesquisas
		$data['pesquisas'] = $this->default_model->listaAssociativa('pesquisas', 'titulo', NULL, array('id_pesquisas' => $data['registro']->pesquisas_id_pesquisas), NULL, NULL, false, 'id_pesquisas');
		unset($data['pesquisas']['']);

		//Perguntas (para agrupamento)
		$data['perguntas'] = $this->default_model->listaAssociativa('pesquisas_perguntas', 'pergunta', NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => NULL,'pesquisas_id_pesquisas' => $data['registro']->pesquisas_id_pesquisas), NULL, NULL, false, 'id_pesquisas_perguntas');
                
                
                
                
                
                //Busca da sugestão
		$data['sugestao'] = $this->default_model->get_by_id('pesquisas_alteracoes', $id, array('*'), NULL, NULL, 'pesquisas_perguntas_id_pesquisas_perguntas');
                
                
                //print_r($data['sugestao']);
                
                
		//Tipos
		$data['tipos_pergunta'] = $this->tipos_pergunta;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;
		$data['pesquisas_perguntas_id_pesquisas_perguntas'] = $data['pesquisas_perguntas_id_pesquisas_perguntas'] ? $data['pesquisas_perguntas_id_pesquisas_perguntas'] : NULL;
		$data['limite_respostas'] = $data['limite_respostas'] ? $data['limite_respostas'] : NULL;
		$data['limite_caracteres'] = $data['limite_caracteres'] ? $data['limite_caracteres'] : NULL;

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_pesquisas_perguntas"]) && $data["id_pesquisas_perguntas"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id_pesquisas_perguntas'], $data, 'id_pesquisas_perguntas');
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
		redirect($this->controller.'/index/'.$data['pesquisas_id_pesquisas']);
	}

	public function excluir($id){

		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas_perguntas');
		if($this->default_model->update_where($this->table,array('ativo'=>'N'),array('id_pesquisas_perguntas'=>$id)))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');

		//Retorno
		redirect($this->controller.'/index/'.$data['registro']->pesquisas_id_pesquisas);
	}

	private function _pagination($table, $search = FALSE, $pesquisa_id){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//where
		$where = array('pesquisas_perguntas.pesquisas_id_pesquisas' => $pesquisa_id);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&pesquisa_id='.$pesquisa_id;
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$pesquisa_id;
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
		$data_busca[$this->table.'.pergunta']  = $this->input->get('s');
		$data_busca[$this->table.'.numero']  = $this->input->get('s');
		$data['pesquisas_id_pesquisas'] = $this->input->get('pesquisa_id');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, titulo'), $data['pesquisas_id_pesquisas'] ? array('pesquisas_perguntas.pesquisas_id_pesquisas' => $data['pesquisas_id_pesquisas']) : null, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.numero', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['pesquisas_id_pesquisas']);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Tipos
		$data['tipos_pergunta'] = $this->tipos_pergunta;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */