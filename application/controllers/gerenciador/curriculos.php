<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curriculos extends CI_Controller {

	var $titulo 		= 'Currículos';
	var $dir 			= 'multitools/curriculos/';
	var $controller 	= 'multitools/curriculos';
	var $title_sing 	= 'Currículo';
	var $per_page 		= 20;
	var $table 			= 'curriculos';
	var $join			= array('curriculos' => array('where' => 'curriculos.inscritos_id = inscritos.id', 'type' => 'inner'));
	var $estados_civis  = array('S' => 'Solteiro(a)', 'C' => 'Casado(a)', 'D' => 'Divorciado(a)', 'V' => 'Viúvo(a)');
	var $graus_formacao = array('EF' => 'Ensino Fundamental', 'EM' => 'Ensino Médio', 'GR' => 'Graduação', 'PG' => 'Pós-graduação/MBA', 'ME' => 'Mestrado', 'DO' => 'Doutorado');
	var $status_formacao = array('CO' => 'Completo', 'CU' => 'Cursando', 'IN' => 'Interrompido');

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
		$data['registros'] = $this->default_model->get_all('inscritos', array('inscritos.*, curriculos.tipo_cadastro as tipo_cadastro'), $offset, $this->per_page, array('tipo_pessoa' => 'F'), $this->join, 'nome', 'ASC');

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

		$data['estados_civis']   = $this->estados_civis;
		$data['graus_formacao']  = $this->graus_formacao;
		$data['status_formacao'] = $this->status_formacao;

		//Níveis de atuação
		$data['niveis_atuacao'] = $this->default_model->listaAssociativa('niveis_de_atuacao', 'nome_nivel', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_nivel');

		//Áreas de Atuação
		$data['areas_atuacao'] = $this->default_model->listaAssociativa('area_de_atuacao', 'nome_area', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_area');
		unset($data['areas_atuacao']['']);

		//Segmentos de Atuação
		$data['segmentos_atuacao'] = $this->default_model->listaAssociativa('segmentodeatuacao', 'segmentodeatuacao_nome', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'segmentodeatuacao_id');
		unset($data['segmentos_atuacao']['']);

		//Disponibilidades de Horário
		$data['disponibilidades_horario'] = $this->default_model->listaAssociativa('disponibilidadehorario', 'disponibilidadehorario_nome', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'disponibilidadehorario_id');
		unset($data['disponibilidades_horario']['']);

		//Pretensão Salarial
		$data['pretensoes_salariais'] = $this->default_model->listaAssociativa('pretencaosalarial', 'pretencaosalarial_nome', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'pretencaosalarial_id');
		unset($data['pretensoes_salariais']['']);

		//Idiomas
		$data['idiomas'] = $this->default_model->listaAssociativa('idiomas_selecao', 'nome_idioma', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_idioma');
		unset($data['idiomas']['']);

		$data['formacao_academica'] = $data['cursos_complementares'] = $data['historico_profissional'] = $data['referencias_profissionais'] = array('vazio' => true);

		//Inscritos
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome', NULL, array('tipo_pessoa' => 'F', 'ativo' => 'S'), 'nome', 'ASC', false, 'id');
		unset($data['inscritos']['']);

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
		$join = array('inscritos' => array('where' => 'inscritos.id = inscritos_id', 'type' => 'inner'));
		$data['registro'] = $this->default_model->get_by_id('curriculos', $id, array('*'), NULL, $join, 'inscritos_id');

		//Id do currículo
		if($data['registro'])
			$curriculo_id = $data['registro']->id_curriculo;
		else{
			$this->db->insert('curriculos', array('inscritos_id' => $id, 'niveis_de_atuacao_id_nivel' => NULL, 'objetivosprofissionais' => NULL, 'tipo_cadastro' => 'M', 'created' => date('Y-m-d H:i:s')));
			$curriculo_id = $this->db->insert_id();
			$data['registro'] = $this->default_model->get_by_id('curriculos', $id, array('*'), NULL, $join, 'inscritos_id');
		}

		$data['estados_civis']   = $this->estados_civis;
		$data['graus_formacao']  = $this->graus_formacao;
		$data['status_formacao'] = $this->status_formacao;
		$data['curriculo_id'] 	 = $curriculo_id;
		$data['inscrito_id'] 	 = $id;

		//Formação Acadêmica
		$data['formacao_academica'] = $this->default_model->get_all('formacao_academica', array('formacao_academica.*'), 0, NULL, array('curriculos_id_curriculo' => $curriculo_id), NULL);
		$data['formacao_academica'] = $data['formacao_academica'] ? $data['formacao_academica'] : array('vazio' => true);

		//Cursos Complementares
		$data['cursos_complementares'] = $this->default_model->get_all('cursos_complementares', array('cursos_complementares.*'), 0, NULL, array('curriculos_id_curriculo' => $curriculo_id), NULL);
		$data['cursos_complementares'] = $data['cursos_complementares'] ? $data['cursos_complementares'] : array('vazio' => true);

		//Histórico Profissional
		$data['historico_profissional'] = $this->default_model->get_all('historico_experiencia', array('historico_experiencia.*'), 0, NULL, array('curriculos_id_curriculo' => $curriculo_id), NULL);
		$data['historico_profissional'] = $data['historico_profissional'] ? $data['historico_profissional'] : array('vazio' => true);
		if(!isset($data['historico_profissional']['vazio']))
			foreach($data['historico_profissional'] as $key => $historico)
				$data['historico_profissional'][$key]->cargos = $this->default_model->get_all('historico_cargo', array('historico_cargo.*'), 0, NULL, array('historico_experiencia_id_historico' => $historico->id_historico), NULL);

		//Referências profissionais
		$data['referencias_profissionais'] = $this->default_model->get_all('referencias_profissionais', array('referencias_profissionais.*'), 0, NULL, array('curriculos_id_curriculo' => $curriculo_id), NULL);
		$data['referencias_profissionais'] = $data['referencias_profissionais'] ? $data['referencias_profissionais'] : array('vazio' => true);

		//Níveis de atuação
		$data['niveis_atuacao'] = $this->default_model->listaAssociativa('niveis_de_atuacao', 'nome_nivel', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_nivel');

		//Áreas de Atuação
		$data['areas_atuacao'] = $this->default_model->listaAssociativa('area_de_atuacao', 'nome_area', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_area');
		unset($data['areas_atuacao']['']);
		$areas_atuacao_cadastro = $this->default_model->get_all('area_atuacao_cadastro', array('area_atuacao_cadastro.*'), 0, NULL, array('curriculos_id_curriculo' => $curriculo_id), NULL);
		if($areas_atuacao_cadastro)
			foreach($areas_atuacao_cadastro as $area_cadastro)
				$data['areas_atuacao_cadastradas'][] = $area_cadastro->area_de_atuacao_id_area;

		//Segmentos de Atuação
		$data['segmentos_atuacao'] = $this->default_model->listaAssociativa('segmentodeatuacao', 'segmentodeatuacao_nome', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'segmentodeatuacao_id');
		unset($data['segmentos_atuacao']['']);
		$segmentos_atuacao_cadastro = $this->default_model->get_all('segmentodeatuacao_cadastro', array('segmentodeatuacao_cadastro.*'), 0, 1, array('curriculos_id_curriculo' => $curriculo_id), NULL);
		if($segmentos_atuacao_cadastro)
			$data['segmento_atuacao_cadastrado'] = $segmentos_atuacao_cadastro[0]->segmentodeatuacao_segmentodeatuacao_id;

		//Disponibilidades de Horário
		$data['disponibilidades_horario'] = $this->default_model->listaAssociativa('disponibilidadehorario', 'disponibilidadehorario_nome', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'disponibilidadehorario_id');
		unset($data['disponibilidades_horario']['']);
		$disponibilidades_cadastro = $this->default_model->get_all('disponibilidadedehorario_cadastro', array('disponibilidadedehorario_cadastro.*'), 0, 1, array('curriculos_id_curriculo' => $curriculo_id), NULL);
		if($disponibilidades_cadastro)
			$data['disponibilidade_cadastrada'] = $disponibilidades_cadastro[0]->disponibilidadehorario_pretencaosalarial_id;

		//Pretensão Salarial
		$data['pretensoes_salariais'] = $this->default_model->listaAssociativa('pretencaosalarial', 'pretencaosalarial_nome', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'pretencaosalarial_id');
		unset($data['pretensoes_salariais']['']);
		$pretensoes_cadastro = $this->default_model->get_all('pretencaosalarial_cadastro', array('pretencaosalarial_cadastro.*'), 0, 1, array('curriculos_id_curriculo' => $curriculo_id), NULL);
		if($pretensoes_cadastro)
			$data['pretensao_salarial_cadastrada'] = $pretensoes_cadastro[0]->pretencaosalarial_pretencaosalarial_id;

		//Idiomas
		$data['idiomas'] = $this->default_model->listaAssociativa('idiomas_selecao', 'nome_idioma', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_idioma');
		unset($data['idiomas']['']);
		$idiomas_cadastro = $this->default_model->get_all('idiomas_cadastro', array('idiomas_cadastro.*'), 0, NULL, array('curriculos_id_curriculo' => $curriculo_id), NULL);
		if($idiomas_cadastro)
			foreach($idiomas_cadastro as $idioma){
				$data['ids_idiomas_vagas'][] = $idioma->idiomas_id_idioma;
				$data['idiomas_vagas'][$idioma->idiomas_id_idioma] = $idioma;
			}

		//Busca Processos
		$join = array('processo_selecao' => array('where' => 'processo_selecao.id_processo = processo_selecao_id_processo', 'type' => 'inner'));
		$data['processos'] = $this->default_model->get_all('processo_selecao_curriculos', array('processo_selecao_curriculos.*, processo_selecao.titulo'), 0, NULL, array('curriculos_id_curriculo' => $curriculo_id), $join);

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

		//Se o currículo já existe, atualiza os dados do inscrito
		if(isset($data['id_curriculo']) && $data['id_curriculo']){
			$data['data_nascimento'] = w3c_date($_POST['data_nascimento']);

			//Salva dados do Inscrito
			$data_inscrito = array('nome' 					=> $data['nome'],
								   'email' 					=> $data['email'],
								   'cpf_cnpj' 				=> $data['cpf_cnpj'],
								   'data_nascimento' 		=> $data['data_nascimento'],
								   'sexo' 					=> $data['sexo'],
								   'telefone' 				=> $data['telefone'],
								   'celular' 				=> $data['celular'],
								   'estadocivil' 			=> $data['estadocivil'],
								   'religiao' 				=> $data['religiao'],
								   'cep' 					=> $data['cep'],
								   'endereco' 				=> $data['endereco'],
								   'numero' 				=> $data['numero'],
								   'complemento' 			=> $data['complemento'],
								   'bairro' 				=> $data['bairro'],
								   'cidade' 				=> $data['cidade'],
								   'estado' 				=> $data['estado'],
								   'filhos' 				=> $data['filhos'],
								   'qtd_filhos' 			=> $data['qtd_filhos'],
								   'cnh' 					=> $data['cnh'],
								   'veiculo' 				=> $data['veiculo'],
								   'deficiencia' 			=> $data['deficiencia'],
								   'qual_deficiencia' 		=> $data['qual_deficiencia'],
								   'link_facebook' 			=> $data['link_facebook'],
								   'link_twitter' 			=> $data['link_twitter'],
								   'link_linkedin' 			=> $data['link_linkedin'],
								   'trabalhar_outra_cidade' => $data['trabalhar_outra_cidade'],
			);

			//Update
			$this->default_model->update('inscritos', $data['inscritos_id'], $data_inscrito, 'id');
		}

		//Salva Currículo
		$data_curriculo = array('inscritos_id' => $data['inscritos_id'], 'niveis_de_atuacao_id_nivel' => $data['niveis_de_atuacao_id_nivel'] ? $data['niveis_de_atuacao_id_nivel'] : NULL, 'objetivosprofissionais' => $data['objetivosprofissionais'], 'descricao_sigilosa' => $data['descricao_sigilosa'], 'perfil_acessivel' => $data['perfil_acessivel']);
		if(isset($data['id_curriculo']) && $data['id_curriculo']){
			$data_curriculo['ultima_atualizacao'] = date('Y-m-d H:i:s');
			$this->default_model->update('curriculos', $data['id_curriculo'], $data_curriculo, 'id_curriculo');
		}
		else if($curriculo = $this->default_model->get_by_id('curriculos', $data['inscritos_id'], array('*'), NULL, NULL, 'inscritos_id')){
			$data_curriculo['ultima_atualizacao'] = date('Y-m-d H:i:s');
			$this->default_model->update('curriculos', $curriculo->id_curriculo, $data_curriculo, 'id_curriculo');
			$data['id_curriculo'] = $curriculo->id_curriculo;
		}
		else{
			$data_curriculo['tipo_cadastro'] = 'M';
			$data_curriculo['created'] = date('Y-m-d H:i:s');
			$this->default_model->insert('curriculos', $data_curriculo);
			$data['id_curriculo'] = $this->db->insert_id();

			$inscrito = $this->default_model->get_by_id('inscritos', $data['inscritos_id']);

			if($inscrito->senha){
				$senha = $inscrito->senha;
			}
			else{
				//Gera senha com o nome
				$aux = $data['nome'].time();
				$senha = substr(md5($aux),0,6);
				$this->default_model->update('inscritos', $data['inscritos_id'], array('senha' => $senha), 'id');
			}

			//E-mail de inserção de currículo
			$conteudo = $this->load->view($this->dir.'email_add_curriculo', array('nome' => $data['nome'], 'email' => $data['email'], 'senha' => $senha), true);

			//carrega library de email
			$this->load->library('email');
			$config['protocol'] = 'mail';
			$config['mailtype'] = 'html';

			//Parâmetros
			$this->email->initialize($config);
			$this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
			$this->email->to($data['email'], $data['nome']);
			$this->email->reply_to('mb@mb.com.br');
			//$this->email->cc(array('luana@multiwebdigital.com.br'));
			$this->email->subject('MB CONSULTORIA - CURRÍCULO CADASTRADO');
			$this->email->message($conteudo);
			$this->email->send();
		}

		//Salva formações acadêmicas
		$this->default_model->delete('formacao_academica', array('curriculos_id_curriculo' => $data['id_curriculo']));
		if($data['grau_formacao']){
			foreach($data['grau_formacao'] as $key => $grau){
				if(!empty($data['grau_formacao'][$key])){
					$dados_formacao = array('grau_formacao' => $data['grau_formacao'][$key],
								   			'status' => $data['status'][$key],
								   			'nome_curso' => $data['nome_curso'][$key],
								   			'instituicao' => $data['instituicao'][$key],
								   			'data_inicio' => ($data['data_inicio'][$key]),
								   			'data_conclusao' => ($data['data_conclusao'][$key]),
								   			'curriculos_id_curriculo' => $data['id_curriculo']
					);
					$this->default_model->insert('formacao_academica', $dados_formacao);
				}
			}
		}

		//Salva Cursos complementares
		$this->default_model->delete('cursos_complementares', array('curriculos_id_curriculo' => $data['id_curriculo']));
		if($data['nome_curso_complementar']){
			foreach($data['nome_curso_complementar'] as $key => $curso){
				if(!empty($data['nome_curso_complementar'][$key])){
					$dados_curso = array('nome_curso' => $data['nome_curso_complementar'][$key],
								   		 'carga_horaria' => $data['carga_horaria'][$key],
								   		 'cidade_pais' => $data['cidade_pais'][$key],
								   		 'instituicao' => $data['instituicao_complementar'][$key],
								   		 'data_inicio' => ($data['data_inicio_complementar'][$key]),
								   		 'data_fim' => ($data['data_fim'][$key]),
								   		 'curriculos_id_curriculo' => $data['id_curriculo']
					);
					$this->default_model->insert('cursos_complementares', $dados_curso);
				}
			}
		}

		//Salva Histórico Profissional
		$this->default_model->delete('historico_experiencia', array('curriculos_id_curriculo' => $data['id_curriculo']));
		$cont = $data['num_itens_historico'];
		for ($x = 1; $x <= $cont; $x++){
			if(!empty($data['empresa_'.$x])){
				$dados_historico = array('empresa' => $data['empresa_'.$x],
							   		 	'data_inicial' => w3c_date($data['data_inicial_'.$x]),
							   		 	'data_saida' => w3c_date($data['data_saida_'.$x]),
							   		 	'motivo_desligamento' => $data['motivo_desligamento_'.$x],
							   		 	'salario' => $data['salario_'.$x],
							   		 	'beneficios' => $data['beneficios_'.$x],
							   		 	'superior_imediato' => $data['superior_imediato_'.$x],
							   		 	'cargo_superior_imediato' => $data['cargo_superior_imediato_'.$x],
							   		 	'principais_atribuicoes' => $data['principais_atribuicoes_'.$x],
							   		 	'curriculos_id_curriculo' => $data['id_curriculo']
					);

				$this->default_model->insert('historico_experiencia', $dados_historico);
				$historico_id = $this->db->insert_id();

				if($data['cargo_'.$x]){
					foreach($data['cargo_'.$x] as $key => $cargo){
						$dados_cargo = array('cargo' => $cargo, 'historico_experiencia_id_historico' => $historico_id);
						$this->default_model->insert('historico_cargo', $dados_cargo);
					}
				}
			}
		}

		//Salva referências
		$this->default_model->delete('referencias_profissionais', array('curriculos_id_curriculo' => $data['id_curriculo']));
		if($data['empresa_referencia']){
			foreach($data['empresa_referencia'] as $key => $curso){
				if(!empty($data['empresa_referencia'][$key])){
					$dados_referencia = array('empresa' => $data['empresa_referencia'][$key],
								   		 'nome_superior_imediato' => $data['nome_superior_imediato'][$key],
								   		 'cargo' => $data['cargo_referencia'][$key],
								   		 'telefone_comercial' => $data['telefone_comercial'][$key],
								   		 'email' => $data['email_referencia'][$key],
								   		 'curriculos_id_curriculo' => $data['id_curriculo']
					);
					$this->default_model->insert('referencias_profissionais', $dados_referencia);
				}
			}
		}

		//Salva área de atuação
		$this->default_model->delete('area_atuacao_cadastro', array('curriculos_id_curriculo' => $data['id_curriculo']));
		if($data['areas_atuacao']){
			foreach($data['areas_atuacao'] as $key => $area)
				$this->default_model->insert('area_atuacao_cadastro', array('area_de_atuacao_id_area' => $area, 'curriculos_id_curriculo' => $data['id_curriculo']));
		}

		//Salva Segmento de atuação
		$this->default_model->delete('segmentodeatuacao_cadastro', array('curriculos_id_curriculo' => $data['id_curriculo']));
		if($data['segmento_atuacao_id'])
			$this->default_model->insert('segmentodeatuacao_cadastro', array('segmentodeatuacao_segmentodeatuacao_id' => $data['segmento_atuacao_id'], 'curriculos_id_curriculo' => $data['id_curriculo']));

		//Salva disponibilidade de horário
		$this->default_model->delete('disponibilidadedehorario_cadastro', array('curriculos_id_curriculo' => $data['id_curriculo']));
		if($data['disponibilidade_horario_id'])
			$this->default_model->insert('disponibilidadedehorario_cadastro', array('disponibilidadehorario_pretencaosalarial_id' => $data['disponibilidade_horario_id'], 'curriculos_id_curriculo' => $data['id_curriculo']));

		//Salva pretensão salarial
		$this->default_model->delete('pretencaosalarial_cadastro', array('curriculos_id_curriculo' => $data['id_curriculo']));
		if($data['pretensao_salarial_id'])
			$this->default_model->insert('pretencaosalarial_cadastro', array('pretencaosalarial_pretencaosalarial_id' => $data['pretensao_salarial_id'], 'curriculos_id_curriculo' => $data['id_curriculo']));

		//Salva Idiomas
		$this->default_model->delete('idiomas_cadastro', array('curriculos_id_curriculo' => $data['id_curriculo']));
		if($data['idiomas']){
			foreach($data['idiomas'] as $key => $idioma){
				$dados_idioma['idiomas_id_idioma'] 	= $idioma;
				$dados_idioma['curriculos_id_curriculo'] 		= $data['id_curriculo'];
				$dados_idioma['nivel_leitura'] 		= $data['nivel_leitura_'.$idioma];
				$dados_idioma['nivel_escrita'] 		= $data['nivel_escrita_'.$idioma];
				$dados_idioma['nivel_conversacao'] = $data['nivel_conversacao_'.$idioma];
				$this->default_model->insert('idiomas_cadastro', $dados_idioma);
			}
		}

		//Mensagem de retorno
		$msg = 'Dados salvos com sucesso.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller);
	}

	public function excluir($id){

		$registro = $this->default_model->get_by_id('curriculos', $id, array('*'), NULL, NULL, 'inscritos_id');

		//Exclui registro
		if($this->default_model->delete($this->table, array('id_curriculo' => $registro->id_curriculo)))
			$this->session->set_flashdata('msg', 'Currículo excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Currículo não foi excluído!');

		//Retorno
		redirect($this->controller);
	}

	private function _pagination($table, $search = FALSE, $where = NULL){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search('inscritos', $search, array(), $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s');
		}
		else{
			$config['uri_segment'] = 4;
			$config['total_rows']  = $this->default_model->count('inscritos', array(), $this->join);
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
		$data_busca['inscritos.nome']  = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search('inscritos', array('inscritos.*, curriculos.tipo_cadastro as tipo_cadastro'), NULL, $offset, $this->per_page, $data_busca, $this->join, 'nome', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function consulta(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Estados civis
		$data['estados_civis'] = $this->estados_civis;
		$data['graus_formacao'] = $this->graus_formacao;
		$data['niveis_atuacao'] = $this->default_model->listaAssociativa('niveis_de_atuacao', 'nome_nivel', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_nivel');
		$data['areas_atuacao'] = $this->default_model->listaAssociativa('area_de_atuacao', 'nome_area', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_area');
		unset($data['areas_atuacao']['']);
		$data['pretensoes_salariais'] = $this->default_model->listaAssociativa('pretencaosalarial', 'pretencaosalarial_nome', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'pretencaosalarial_id');

		//Carrega view
		$this->load->view($this->dir.'consulta', $data);
		get_footer(TRUE);
	}

	public function busca_consulta(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;
		//Menu
		get_menu();

		//Parâmetros
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;
		$dados = $_POST;

		//Inicia query
		$this->db->select('inscritos.*, curriculos.*');
		//	$this->db->limit($per_page, $offset);
		$this->db->join('curriculos','curriculos.inscritos_id = inscritos.id','inner');

		//Monta where
		$where = 'tipo_pessoa = "F" AND ativo = "S"';
		if($dados['nome'])
			$this->db->like(array('nome' => $dados['nome']));
		if($dados['cpf'])
			$this->db->like(array('cpf_cnpj' => $dados['cpf']));
		if($dados['idade_de']){
			$ano = date('Y') - $dados['idade_de'];
			$where .= ' AND data_nascimento <= "'.$ano.'-'.date('m-d').'"';
		}
		if($dados['idade_ate']){
			$ano = date('Y') - $dados['idade_ate'];
			$where .= ' AND data_nascimento >= "'.$ano.'-'.date('01-01').'"';
		}
		if($dados['estado_civil'])
			$where .= ' AND estadocivil = "'.$dados['estado_civil'].'"';
		if($dados['cidade'])
			$this->db->like(array('cidade' => $dados['cidade']));
		if($dados['portador_necessidade'])
			$where .= ' AND deficiencia = "'.$dados['portador_necessidade'].'"';
		if($dados['necessidade'])
			$this->db->like(array('qual_deficiencia' => $dados['necessidade']));
		if($dados['grau_formacao'] || $dados['curso_formacao'])
			$this->db->join('formacao_academica','formacao_academica.curriculos_id_curriculo = curriculos.id_curriculo','inner');
		if($dados['grau_formacao']){
			$where .= ' AND formacao_academica.grau_formacao = "'.$dados['grau_formacao'].'"';
		}
		if($dados['curso_formacao']){
			$this->db->like(array('formacao_academica.nome_curso' => $dados['curso_formacao']));
		}
		if($dados['nivel_atuacao'])
			$where .= ' AND curriculos.niveis_de_atuacao_id_nivel = '.$dados['nivel_atuacao'];
		if(isset($dados['areas_atuacao']) && $dados['areas_atuacao']){
			$this->db->join('area_atuacao_cadastro','area_atuacao_cadastro.curriculos_id_curriculo = curriculos.id_curriculo','inner');
			$where .= ' AND (';
			$cont = 1;
			foreach($dados['areas_atuacao'] as $area){
				$where .= ($cont == 1 ? 'area_atuacao_cadastro.area_de_atuacao_id_area = '.$area : ' OR area_atuacao_cadastro.area_de_atuacao_id_area = '.$area);
				$cont++;
			}
			$where .= ')';
		}
		if($dados['pretensao_salarial']){
			$this->db->join('pretencaosalarial_cadastro','pretencaosalarial_cadastro.curriculos_id_curriculo = curriculos.id_curriculo','inner');
			$where .= ' AND pretencaosalarial_pretencaosalarial_id = '.$dados['pretensao_salarial'];
		}

		//Finaliza query
		$this->db->where($where);
		$query = $this->db->get('inscritos');

		//Registros
		$data['registros'] = $query->result();
		$data['qtd_registros'] = count($query->result());

		//Parâmetros
		$data['paginacao'] = $this->_pagination($this->table);

		//Carrega view
		$this->load->view($this->dir.'resultado_consulta', $data);
		get_footer(TRUE);
	}

	public function visualizar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Registro
		$join = array('inscritos' => array('where' => 'inscritos.id = inscritos_id', 'type' => 'inner'));
		$data['registro'] = $this->default_model->get_by_id('curriculos', $id, array('*'), NULL, $join, 'inscritos_id');

		//Estados civis
		$data['estados_civis'] = $this->estados_civis;
		$data['graus_formacao'] = $this->graus_formacao;
		$data['status_formacao'] = $this->status_formacao;
		$data['niveis_atuacao'] = $this->default_model->listaAssociativa('niveis_de_atuacao', 'nome_nivel', NULL, NULL, 'ordem', 'ASC', false, 'id_nivel');
		$data['areas_atuacao'] = $this->default_model->listaAssociativa('area_de_atuacao', 'nome_area', NULL, NULL, 'ordem', 'ASC', false, 'id_area');
		unset($data['areas_atuacao']['']);
		$data['pretensoes_salariais'] = $this->default_model->listaAssociativa('pretencaosalarial', 'pretencaosalarial_nome', NULL, NULL, 'ordem', 'ASC', false, 'pretencaosalarial_id');

		//Formação Acadêmica
		$data['formacao_academica'] = $this->default_model->get_all('formacao_academica', array('formacao_academica.*'), 0, NULL, array('curriculos_id_curriculo' => $data['registro']->id_curriculo), NULL, 'data_conclusao', 'DESC');

		//Idiomas
		$join = array('idiomas_selecao' => array('where' => 'idiomas_selecao.id_idioma = idiomas_id_idioma', 'type' => 'inner'));
		$data['idiomas'] = $this->default_model->get_all('idiomas_cadastro', array('idiomas_cadastro.*, idiomas_selecao.nome_idioma as nome_idioma'), 0, NULL, array('curriculos_id_curriculo' => $data['registro']->id_curriculo), $join);
		$data['niveis_idiomas'] = array('N' => 'Nenhum', 'B' => 'Básico', 'I' => 'Intermediário', 'A' => 'Avançado', 'F' => 'Fluente');

		//Cursos Complementares
		$data['cursos_complementares'] = $this->default_model->get_all('cursos_complementares', array('cursos_complementares.*'), 0, NULL, array('curriculos_id_curriculo' => $data['registro']->id_curriculo), NULL, 'data_fim', 'DESC');

		//Histórico Profissional
		$data['historico_profissional'] = $this->default_model->get_all('historico_experiencia', array('historico_experiencia.*'), 0, NULL, array('curriculos_id_curriculo' => $data['registro']->id_curriculo), NULL);
		if($data['historico_profissional'])
			foreach($data['historico_profissional'] as $key => $historico)
				$data['historico_profissional'][$key]->cargos = $this->default_model->get_all('historico_cargo', array('historico_cargo.*'), 0, NULL, array('historico_experiencia_id_historico' => $historico->id_historico), NULL);

		//Referências profissionais
		$data['referencias_profissionais'] = $this->default_model->get_all('referencias_profissionais', array('referencias_profissionais.*'), 0, NULL, array('curriculos_id_curriculo' => $data['registro']->id_curriculo), NULL);

		//Áreas de Atuação
		$join = array('area_de_atuacao' => array('where' => 'area_de_atuacao.id_area = area_de_atuacao_id_area', 'type' => 'inner'));
		$data['areas_atuacao'] = $this->default_model->get_all('area_atuacao_cadastro', array('area_atuacao_cadastro.*, area_de_atuacao.nome_area'), 0, NULL, array('curriculos_id_curriculo' => $data['registro']->id_curriculo), $join);

		//Segmentos de Atuação
		$join = array('segmentodeatuacao' => array('where' => 'segmentodeatuacao.segmentodeatuacao_id = segmentodeatuacao_segmentodeatuacao_id', 'type' => 'inner'));
		$data['segmento_atuacao'] = $this->default_model->get_by_id('segmentodeatuacao_cadastro', $data['registro']->id_curriculo, array('segmentodeatuacao_cadastro.*, segmentodeatuacao.segmentodeatuacao_nome'), NULL, $join, 'curriculos_id_curriculo');

		//Disponibilidades de Horário
		$join = array('disponibilidadehorario' => array('where' => 'disponibilidadehorario.disponibilidadehorario_id = disponibilidadehorario_pretencaosalarial_id', 'type' => 'inner'));
		$data['disponibilidade_horario'] = $this->default_model->get_by_id('disponibilidadedehorario_cadastro', $data['registro']->id_curriculo, array('disponibilidadedehorario_cadastro.*, disponibilidadehorario.disponibilidadehorario_nome'), NULL, $join, 'curriculos_id_curriculo');

		//Pretensão Salarial
		$join = array('pretencaosalarial' => array('where' => 'pretencaosalarial.pretencaosalarial_id = pretencaosalarial_pretencaosalarial_id', 'type' => 'inner'));
		$data['pretensao_salarial'] = $this->default_model->get_by_id('pretencaosalarial_cadastro', $data['registro']->id_curriculo, array('pretencaosalarial_cadastro.*, pretencaosalarial.pretencaosalarial_nome'), NULL, $join, 'curriculos_id_curriculo');

		//helpers
		$this->load->helper(array('dompdf', 'file'));

		//recebe html da view
		$html = $this->load->view('banco_de_talentos/visualizar_pdf', $data, true);

		//Cria pdf
		pdf_create($html, 'Currículo - '.$data['registro']->nome);

	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */