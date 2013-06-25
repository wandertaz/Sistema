<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vagas extends CI_Controller {

	var $titulo 		= 'Vagas';
	var $dir 			= 'multitools/vagas/';
	var $controller 	= 'multitools/vagas';
	var $title_sing 	= 'Vaga';
	var $per_page 		= 20;
	var $table 			= 'vagas';
	var $join			= array('inscritos' => array('where' => 'inscritos.id = inscritos_id AND inscritos.tipo_pessoa = "J"', 'type' => 'inner'));
	var $graus_formacao = array('EF' => 'Ensino Fundamental', 'EM' => 'Ensino Médio', 'GR' => 'Graduação', 'PG' => 'Pós-graduação/MBA', 'ME' => 'Mestrado', 'DO' => 'Doutoria');
	var $tipos_contrato = array('CL' => 'CLT', 'PJ' => 'Prestador de Serviço (PJ)', 'TE' => 'Temporário', 'AU' => 'Autônomo', 'ES' => 'Estágio', 'TR' => 'Trainee');

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
		$data['registros'] = $this->default_model->get_all($this->table, array('vagas.*, inscritos.nome as empresa'), $offset, $this->per_page, NULL, $this->join, 'created', 'DESC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		$data['graus_formacao'] = $this->graus_formacao;
		$data['tipos_contrato'] = $this->tipos_contrato;

		//Níveis de atuação
		$data['niveis_atuacao'] = $this->default_model->listaAssociativa('niveis_de_atuacao', 'nome_nivel', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_nivel');

		//Áreas de Atuação
		$data['areas_atuacao'] = $this->default_model->listaAssociativa('area_de_atuacao', 'nome_area', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_area');
		unset($data['areas_atuacao']['']);

		//Idiomas
		$data['idiomas'] = $this->default_model->listaAssociativa('idiomas_selecao', 'nome_idioma', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_idioma');
		unset($data['idiomas']['']);

		//Pretensão Salarial
		$data['pretensoes_salariais'] = $this->default_model->listaAssociativa('pretencaosalarial', 'pretencaosalarial_nome', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'pretencaosalarial_id');

		//Empresas
		$data['empresas'] = $this->default_model->listaAssociativa('inscritos', 'nome', NULL, array('tipo_pessoa' => 'J', 'ativo' => 'S'), 'nome', 'ASC');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_vaga');

		$data['graus_formacao'] = $this->graus_formacao;
		$data['tipos_contrato'] = $this->tipos_contrato;

		//Níveis de atuação
		$data['niveis_atuacao'] = $this->default_model->listaAssociativa('niveis_de_atuacao', 'nome_nivel', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_nivel');

		//Áreas de Atuação
		$data['areas_atuacao'] = $this->default_model->listaAssociativa('area_de_atuacao', 'nome_area', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_area');
		unset($data['areas_atuacao']['']);
		$areas_atuacao_vagas = $this->default_model->get_all('areas_atuacao_vagas', array('areas_atuacao_vagas.*'), 0, NULL, array('vaga_id_vaga' => $id), NULL);
		if($areas_atuacao_vagas)
			foreach($areas_atuacao_vagas as $area)
				$data['areas_atuacao_vagas'][] = $area->area_de_atuacao_id_area;

		//Idiomas
		$data['idiomas'] = $this->default_model->listaAssociativa('idiomas_selecao', 'nome_idioma', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_idioma');
		unset($data['idiomas']['']);
		$idiomas_vagas = $this->default_model->get_all('idiomas_vagas', array('idiomas_vagas.*'), 0, NULL, array('vaga_id_vaga' => $id), NULL);
		if($idiomas_vagas)
			foreach($idiomas_vagas as $idioma){
				$data['ids_idiomas_vagas'][] = $idioma->idiomas_id_idioma;
				$data['idiomas_vagas'][$idioma->idiomas_id_idioma] = $idioma;
			}

		//Faixas Salariais
		$data['pretensoes_salariais'] = $this->default_model->listaAssociativa('pretencaosalarial', 'pretencaosalarial_nome', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'pretencaosalarial_id');
		$faixas_salariais_vagas = $this->default_model->get_all('pretencaosalarial_vagas', array('pretencaosalarial_vagas.*'), 0, 1, array('vaga_id_vaga' => $id), NULL);
		if($faixas_salariais_vagas)
			$data['faixa_salarial'] = $faixas_salariais_vagas[0]->pretencaosalarial_pretencaosalarial_id;

		//Empresas
		$data['empresas'] = $this->default_model->listaAssociativa('inscritos', 'nome', NULL, array('tipo_pessoa' => 'J', 'ativo' => 'S'), 'nome', 'ASC');

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

		//Salva dados da Vaga
		$data_vaga = array('inscritos_id' 				=> $data['inscritos_id'],
						   'exibir_nome_empresa' 		=> $data['exibir_nome_empresa'],
						   'titulo_cargo' 				=> $data['titulo_cargo'],
						   'descricao' 					=> $data['descricao'],
						   'quantidade_vagas' 			=> $data['quantidade_vagas'],
						   'niveis_de_atuacao_id_nivel' => $data['niveis_de_atuacao_id_nivel'],
						   'grau_formacao' 				=> $data['grau_formacao'],
						   'curso_formacao' 			=> $data['curso_formacao'],
						   'outros_cursos' 				=> $data['outros_cursos'],
						   'experiencia' 				=> $data['experiencia'],
						   'conhecimentos_necessarios' 	=> $data['conhecimentos_necessarios'],
						   'sexo' 						=> $data['sexo'],
						   'idade_minima' 				=> $data['idade_minima'],
						   'idade_maxima' 				=> $data['idade_maxima'],
						   'exibir_faixa_salarial' 		=> $data['exibir_faixa_salarial'],
						   'beneficios' 				=> $data['beneficios'],
						   'regime_contratacao' 		=> $data['regime_contratacao'],
						   'horario' 					=> $data['horario'],
						   'informacoes_adicionais' 	=> $data['informacoes_adicionais'],
						   'ativo' 						=> $data['ativo'],
						   'status' 					=> $data['status'],
						   'cidade_atuacao' 			=> $data['cidade_atuacao']
		);

		//salva a Vaga
		if($data['id_vaga']){
			$this->default_model->update($this->table, $data['id_vaga'], $data_vaga, 'id_vaga');
		}
		else{

			//Salva os dados do usuário
			$this->default_model->insert($this->table, $data_vaga);
			$data['id_vaga'] = $this->db->insert_id();
		}

		//Salva Idiomas
		$this->default_model->delete('idiomas_vagas', array('vaga_id_vaga' => $data['id_vaga']));
		if($data['idiomas']){
			foreach($data['idiomas'] as $key => $idioma){
				$dados_idioma['idiomas_id_idioma'] 	= $idioma;
				$dados_idioma['vaga_id_vaga'] 		= $data['id_vaga'];
				$dados_idioma['nivel_leitura'] 		= $data['nivel_leitura_'.$idioma];
				$dados_idioma['nivel_escrita'] 		= $data['nivel_escrita_'.$idioma];
				$dados_idioma['nivel_conversacao'] = $data['nivel_conversacao_'.$idioma];
				$this->default_model->insert('idiomas_vagas', $dados_idioma);
			}
		}

		//Salva área de atuação
		$this->default_model->delete('areas_atuacao_vagas', array('vaga_id_vaga' => $data['id_vaga']));
		if($data['areas_atuacao']){
			foreach($data['areas_atuacao'] as $key => $area)
				$this->default_model->insert('areas_atuacao_vagas', array('area_de_atuacao_id_area' => $area, 'vaga_id_vaga' => $data['id_vaga']));
		}

		//Salva faixa salarial
		$this->default_model->delete('pretencaosalarial_vagas', array('vaga_id_vaga' => $data['id_vaga']));
		if($data['pretensao_salarial_id'])
			$this->default_model->insert('pretencaosalarial_vagas', array('pretencaosalarial_pretencaosalarial_id' => $data['pretensao_salarial_id'], 'vaga_id_vaga' => $data['id_vaga']));

		//Mensagem de retorno
		$msg = 'Dados salvos com sucesso.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller);
	}

	public function excluir($id){

		//Exclui registro
		if($this->default_model->update($this->table, $id, array('ativo' => 'N'), 'id_vaga'))
			$this->session->set_flashdata('msg', 'Vaga desativada com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Vaga não foi desativada!');

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
		$data_busca[$this->table.'.nome']  = $this->input->get('s');
		$data_busca[$this->table.'.breve_descricao'] = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search('inscritos', array('*'), NULL, $offset, $this->per_page, $data_busca, $this->join, '.nome', 'ASC');
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