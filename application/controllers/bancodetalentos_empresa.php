<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bancodetalentos_empresa extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	var $graus_formacao = array('EF' => 'Ensino Fundamental', 'EM' => 'Ensino Médio', 'GR' => 'Graduação', 'PG' => 'Pós-graduação/MBA', 'ME' => 'Mestrado', 'DO' => 'Doutoria');
	var $status_formacao = array('CO' => 'Completo', 'CU' => 'Cursando', 'IN' => 'Interrompido');
	var $tipos_contrato = array('CL' => 'CLT', 'PJ' => 'Prestador de Serviço (PJ)', 'TE' => 'Temporário', 'AU' => 'Autônomo', 'ES' => 'Estágio', 'TR' => 'Trainee');
	var $niveis_idiomas = array('N' => 'Nenhum', 'B' => 'Básico', 'I' => 'Intermediário', 'A' => 'Avançado', 'F' => 'Fluente');
	var $estados_civis  = array('S' => 'Solteiro(a)', 'C' => 'Casado(a)', 'D' => 'Divorciado(a)', 'V' => 'Viúvo(a)');

	public function __construct(){

		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('text_helper');
                $this->load->library('pagination');
                $this->load->helper('auxiliar_helper');

		check_login_empresa();
	}

	public function index(){
		return $this->minhas_vagas();
	}

    public function minhas_vagas(){

                // cada modulo terá um numero que e visualizado na primary da tabela area_permissoes_concedidas
	        check_login_empresa(3);
                if ($this->session->userdata('SessionIdEmpresa')>0){
                        //Id da empresa
                        $usuario_id= $this->session->userdata('SessionIdEmpresa');

                        // este helper controla quem esta logado para exibir o menu da area restrita
                        seleciona_menu_area_restrita('J');
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes');
                        // este helper controla quem esta logado para exibir o menu da area restrita
                        seleciona_menu_area_restrita('FJ');
                }

    	//Define join
    	$join = array('niveis_de_atuacao' => array('where' => 'niveis_de_atuacao.id_nivel = niveis_de_atuacao_id_nivel', 'type' => 'inner'));

    	//Busca vagas da empresa
		$data['vagas'] = $this->default_model->get_all('vagas', array('vagas.*, niveis_de_atuacao.nome_nivel'), 0, NULL, array('inscritos_id' => $usuario_id, 'vagas.ativo' => 'S'), $join, 'id_vaga', 'DESC');

    	//Dados de vagas
    	$data['graus_formacao'] = $this->graus_formacao;
    	if($data['vagas']){
	    	foreach($data['vagas'] as $key => $vaga){

	    		//área de atuação
	    		$join = array('area_de_atuacao' => array('where' => 'area_de_atuacao.id_area = area_de_atuacao_id_area', 'type' => 'inner'));
	    		$data['vagas'][$key]->areas_atuacao = $this->default_model->get_all('areas_atuacao_vagas', array('*'), 0, NULL, array('vaga_id_vaga' => $vaga->id_vaga), $join);

	    		//Pretensão Salarial
	    		$join = array('pretencaosalarial' => array('where' => 'pretencaosalarial.pretencaosalarial_id = pretencaosalarial_pretencaosalarial_id', 'type' => 'inner'));
	    		$data['vagas'][$key]->faixa_salarial = $this->default_model->get_by_id('pretencaosalarial_vagas', $vaga->id_vaga, array('*'), NULL, $join, 'vaga_id_vaga');

			}
    	}

		//Carrega view
		$this->loadView('banco_de_talentos/bancodetalentos-minhas-vagas', $data);

	}



	public function excluir_vaga($id){

		//Exclui registro
		if($this->default_model->update('vagas', $id, array('ativo' => 'N'), 'id_vaga'))
			$this->session->set_flashdata('msg', 'Vaga excluída com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Vaga não foi excluída!');

		//Retorno
		redirect('bancodetalentos_empresa/minhas_vagas');
	}

	public function cadastrar_vaga(){

		$data['graus_formacao'] = $this->graus_formacao;
		$data['tipos_contrato'] = $this->tipos_contrato;
		$data['niveis_idiomas'] = $this->niveis_idiomas;

		//Níveis de atuação
		$data['niveis_atuacao'] = $this->default_model->listaAssociativa('niveis_de_atuacao', 'nome_nivel', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_nivel');
		unset($data['niveis_atuacao']['']);

		//Áreas de Atuação
		$data['areas_atuacao'] = $this->default_model->listaAssociativa('area_de_atuacao', 'nome_area', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_area');
		unset($data['areas_atuacao']['']);

		//Idiomas
		$data['idiomas'] = $this->default_model->get_all('idiomas_selecao', array('idiomas_selecao.*'), 0, NULL, array('ativo' => 'S'), NULL);
		$data['idiomas_vagas'] = array('vazio' => 1);

		//Pretensão Salarial
		$data['pretensoes_salariais'] = $this->default_model->listaAssociativa('pretencaosalarial', 'pretencaosalarial_nome', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'pretencaosalarial_id');
		unset($data['pretensoes_salariais']['']);

		//Carrega view
		$this->loadView('banco_de_talentos/bancodetalentos-cadastro-de-vagas', $data);
	}

	public function editar_vaga($id){

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id('vagas', $id, array('*'), array('ativo' => 'S'), NULL, 'id_vaga');

		$data['graus_formacao'] = $this->graus_formacao;
		$data['tipos_contrato'] = $this->tipos_contrato;
		$data['niveis_idiomas'] = $this->niveis_idiomas;

		//Níveis de atuação
		$data['niveis_atuacao'] = $this->default_model->listaAssociativa('niveis_de_atuacao', 'nome_nivel', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_nivel');
		unset($data['niveis_atuacao']['']);

		//área de atuação
		$data['areas_atuacao'] = $this->default_model->listaAssociativa('area_de_atuacao', 'nome_area', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'id_area');
		unset($data['areas_atuacao']['']);

		//idiomas
		$data['idiomas'] = $this->default_model->get_all('idiomas_selecao', array('idiomas_selecao.*'), 0, NULL, array('ativo' => 'S'), NULL);

		//faixas salariais
		$data['pretensoes_salariais'] = $this->default_model->listaAssociativa('pretencaosalarial', 'pretencaosalarial_nome', NULL, array('ativo' => 'S'), 'ordem', 'ASC', false, 'pretencaosalarial_id');
		unset($data['pretensoes_salariais']['']);

		//Dados da vaga, se necessário
		if($data['registro']){

			//Áreas de Atuação
			$areas_atuacao_vagas = $this->default_model->get_all('areas_atuacao_vagas', array('areas_atuacao_vagas.*'), 0, NULL, array('vaga_id_vaga' => $id), NULL);
			if($areas_atuacao_vagas)
				foreach($areas_atuacao_vagas as $area)
					$data['areas_atuacao_vagas'][] = $area->area_de_atuacao_id_area;

			//Idiomas
			$data['idiomas_vagas'] = $this->default_model->get_all('idiomas_vagas', array('idiomas_vagas.*'), 0, NULL, array('vaga_id_vaga' => $id), NULL);

			//Faixas Salariais
			$faixas_salariais_vagas = $this->default_model->get_all('pretencaosalarial_vagas', array('pretencaosalarial_vagas.*'), 0, 1, array('vaga_id_vaga' => $id), NULL);
			if($faixas_salariais_vagas)
				$data['faixa_salarial'] = $faixas_salariais_vagas[0]->pretencaosalarial_pretencaosalarial_id;
		}
		else{
			$data['idiomas_vagas'] = array('vazio' => 1);
			unset($data['registro']);
		}

		//Carrega view
		$this->loadView('banco_de_talentos/bancodetalentos-cadastro-de-vagas', $data);
	}

	public function salvar_vaga()
	{

               // cada modulo terá um numero que e visualizado na primary da tabela area_permissoes_concedidas
	        check_login_empresa(3);
                if ($this->session->userdata('SessionIdEmpresa')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionIdEmpresa');
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes');
                }

                //Recebe Post
		$data = $_POST;

		//Salva dados da Vaga
		$data_vaga = array('inscritos_id' 				=> $usuario_id,
						   //'exibir_nome_empresa' 		=> $data['exibir_nome_empresa'],
						   'titulo_cargo' 				=> $data['titulo_cargo'],
						   'descricao' 					=> $data['descricao'],
						   'quantidade_vagas' 			=> $data['quantidade_vagas'] ? $data['quantidade_vagas'] : 1,
						   'niveis_de_atuacao_id_nivel' => $data['niveis_de_atuacao_id_nivel'],
						   'grau_formacao' 				=> $data['grau_formacao'],
						   'curso_formacao' 			=> $data['curso_formacao'],
						   'outros_cursos' 				=> $data['outros_cursos'],
						   'experiencia' 				=> $data['experiencia'],
						   'conhecimentos_necessarios' 	=> $data['conhecimentos_necessarios'],
						   'sexo' 						=> $data['sexo'],
						   'idade_minima' 				=> $data['idade_minima'],
						   'idade_maxima' 				=> $data['idade_maxima'],
						   'exibir_faixa_salarial' 		=> isset($data['exibir_faixa_salarial']) ? 'N' : 'S',
						   'beneficios' 				=> $data['beneficios'],
						   'regime_contratacao' 		=> $data['regime_contratacao'],
						   'horario' 					=> $data['horario'],
						   'informacoes_adicionais' 	=> $data['informacoes_adicionais'],
						   'ativo' 						=> 'S',
						   'status' 					=> 'P',
						   'cidade_atuacao' 			=> $data['cidade_atuacao']
		);

		//salva a Vaga
		if($data['id_vaga']){
			$this->default_model->update('vagas', $data['id_vaga'], $data_vaga, 'id_vaga');
		}
		else{

			//Salva os dados do usuário
			$this->default_model->insert('vagas', $data_vaga);
			$data['id_vaga'] = $this->db->insert_id();
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

		//Salva Idiomas
		$this->default_model->delete('idiomas_vagas', array('vaga_id_vaga' => $data['id_vaga']));
		if($data['idioma']){
			$cont = count($data['idioma']);
			for ($x = 0; $x < $cont; $x++){
				$dados_idioma['idiomas_id_idioma'] 	= $data['idioma'][$x];
				$dados_idioma['vaga_id_vaga'] 		= $data['id_vaga'];
				$dados_idioma['nivel_leitura'] 		= $data['idioma_leitura'][$x];
				$dados_idioma['nivel_escrita'] 		= $data['idioma_escrita'][$x];
				$dados_idioma['nivel_conversacao'] = $data['idioma_conversacao'][$x];
				$this->default_model->insert('idiomas_vagas', $dados_idioma);
			}
		}

		//Mensagem de retorno
		$msg = 'Dados salvos com sucesso.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect('bancodetalentos_empresa/minhas_vagas');
	}

	public function curriculos_recebidos(){

		//$id_user = $this->session->userdata('SessionIdEmpresa');

                // cada modulo terá um numero que e visualizado na primary da tabela area_permissoes_concedidas
	        check_login_empresa(3);
                if ($this->session->userdata('SessionIdEmpresa')>0){
                   //Id da empresa
                   $id_user= $this->session->userdata('SessionIdEmpresa');
                    // este helper controla quem esta logado para exibir o menu da area restrita
                    seleciona_menu_area_restrita('J');
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){
                   //Id da empresa
                   $id_user= $this->session->userdata('SessionEmpresaPermissoes');
                    // este helper controla quem esta logado para exibir o menu da area restrita
                    seleciona_menu_area_restrita('FJ');
                }







		$dados['vagas'] = $this->default_model->get_all('vagas', array('vagas.*'), 0, NULL, array('inscritos_id' => $id_user), null, 'vagas.id_vaga', 'DESC');

		$this->loadView('banco_de_talentos/bancodetalentos-minhas-vagas-empresa',$dados);

	}

	public function ver_curriculos_recebidos($vaga_id){

	        check_login_empresa(3);
                if ($this->session->userdata('SessionIdEmpresa')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionIdEmpresa');

                    // este helper controla quem esta logado para exibir o menu da area restrita
                    seleciona_menu_area_restrita('J');
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes');

                    // este helper controla quem esta logado para exibir o menu da area restrita
                    seleciona_menu_area_restrita('FJ');
                }


		//Define join
		$join = array('curriculos' => array('where' => 'curriculos.id_curriculo = candidaturas_vagas.curriculos_id_curriculo', 'type' => 'inner'),
					  'inscritos' => array('where' => 'inscritos.id = curriculos.inscritos_id AND tipo_pessoa = "F"', 'type' => 'inner'),
					  'niveis_de_atuacao' => array('where' => 'niveis_de_atuacao.id_nivel = curriculos.niveis_de_atuacao_id_nivel', 'type' => 'inner')
				);

		//Busca vagas da empresa
		$data['curriculos'] = $this->default_model->get_all('candidaturas_vagas', array('curriculos.*, inscritos.nome as inscrito, niveis_de_atuacao.nome_nivel'), 0, NULL, array('vaga_id_vaga' => $vaga_id, 'inscritos.ativo' => 'S'), $join, 'curriculos.id_curriculo', 'DESC');

		//Vaga
		$data['candidaturas'] = $this->default_model->get_all('candidaturas_vagas', array('COUNT(*) as total'), 0, NULL, array('candidaturas_vagas.vaga_id_vaga' => $vaga_id, 'inscritos.ativo' => 'S'), $join);
		$data['vaga'] = $this->default_model->get_by_id('vagas', $vaga_id, array('*'), NULL, NULL, 'id_vaga');
		$data['vaga']->total_candidaturas = $data['candidaturas'][0]->total;

		//Curriculos
		$data['graus_formacao'] = $this->graus_formacao;
		if($data['curriculos']){
			foreach($data['curriculos'] as $key => $curriculo){

				//Faixa salarial
				$formacao_academica = $this->default_model->get_all('formacao_academica', array('*'), 0, 1, array('curriculos_id_curriculo' => $curriculo->id_curriculo), NULL, 'data_conclusao', 'DESC');
				if($formacao_academica)
					$data['curriculos'][$key]->formacao_academica = $formacao_academica[0];

				//Faixa salarial
				$join = array('pretencaosalarial' => array('where' => 'pretencaosalarial.pretencaosalarial_id = pretencaosalarial_pretencaosalarial_id', 'type' => 'inner'));
				$data['curriculos'][$key]->faixa_salarial = $this->default_model->get_by_id('pretencaosalarial_cadastro', $curriculo->id_curriculo, array('*'), NULL, $join, 'curriculos_id_curriculo');

				//área de atuação
				$join = array('area_de_atuacao' => array('where' => 'area_de_atuacao.id_area = area_de_atuacao_id_area', 'type' => 'inner'));
				$data['curriculos'][$key]->areas_atuacao = $this->default_model->get_all('area_atuacao_cadastro', array('*'), 0, NULL, array('curriculos_id_curriculo' => $curriculo->id_curriculo), $join);
			}
		}

		$this->loadView('banco_de_talentos/bancodetalentos-curriculos-recebidos-empresa',$data);
	}

	public function processo_selecao(){

                // cada modulo terá um numero que e visualizado na primary da tabela area_permissoes_concedidas
	        check_login_empresa(3);
                if ($this->session->userdata('SessionIdEmpresa')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionIdEmpresa');
                   // este helper controla quem esta logado para exibir o menu da area restrita
                   seleciona_menu_area_restrita('J');
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes');
                   // este helper controla quem esta logado para exibir o menu da area restrita
                   seleciona_menu_area_restrita('FJ');
                }


		//Busca Processos da empresa
		$data['processos'] = $this->default_model->get_all('processo_selecao', array('processo_selecao.*'), 0, NULL, array('inscritos_id' => $usuario_id), NULL, 'id_processo', 'DESC');

		//Carrega view
		$this->loadView('banco_de_talentos/bancodetalentos-relatorio-processo', $data);

	}

	public function solicitar_processo_selecao(){


               if ($this->session->userdata('SessionIdEmpresa')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionIdEmpresa');
                    // este helper controla quem esta logado para exibir o menu da area restrita
                   seleciona_menu_area_restrita('J');
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes');
                    // este helper controla quem esta logado para exibir o menu da area restrita
                   seleciona_menu_area_restrita('FJ');
                }

		//Carrega view
		$this->loadView('banco_de_talentos/bancodetalentos-solicitar-processo-seletivo');

	}

	public function enviar_solicitacao_processo(){

                // cada modulo terá um numero que e visualizado na primary da tabela area_permissoes_concedidas
	        check_login_empresa(3);
                //Dados
		$data = $_POST;
                if ($this->session->userdata('SessionIdEmpresa')>0){
                   //Id da empresa
                    $data['id']    = $this->session->userdata('SessionIdEmpresa');
                    $data['email'] = $this->session->userdata('SessionEmailEmpresa');
                    $data['nome']  = $this->session->userdata('SessionNomeEmpresa');
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){
                   //Id da empresa
                   $data['id'] = $this->session->userdata('SessionEmpresaPermissoes');

                   $this->db->select('*');
                   $this->db->from('inscritos');
                   $this->db->where(array('id'=>$data['id'],'tipo_pessoa'=>'J'));
                   $query= $this->db->get();
                   $result=$query->result();
                   $data['email'] = $result[0]->email;
                   $data['nome']  = $result[0]->nome;
                }







		//Conteúdo do email
		$conteudo = $this->load->view('banco_de_talentos/email_solicitacao_processo', array('dados' => $data), true);

		//carrega library de email
		$this->load->library('email');
		$config['protocol'] = 'mail';
		$config['mailtype'] = 'html';

		//Parâmetros
		$this->email->initialize($config);
		$this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
		$this->email->to('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
		$this->email->reply_to($data['email']);
		$this->email->subject('SOLICITAÇÃO DE PROCESSO DE SELEÇÃO');
		$this->email->message($conteudo);
		if($this->email->send())
			$msg = 'Solicitação enviada com sucesso.';
		else
			$msg = 'Não foi possível enviar a solicitação. Tente novamente.';

		//Carrega view
		$this->session->set_flashdata('msg', $msg);
		redirect('bancodetalentos_empresa/solicitar_processo_selecao');

	}

	public function ver_curriculo($id){

		//Registro
		$join = array('inscritos' => array('where' => 'inscritos.id = inscritos_id', 'type' => 'inner'));
		$data['registro'] = $this->default_model->get_by_id('curriculos', $id, array('*'), NULL, $join, 'id_curriculo');

		//Estados civis
		$data['estados_civis'] = $this->estados_civis;
		$data['graus_formacao'] = $this->graus_formacao;
		$data['status_formacao'] = $this->status_formacao;
		$data['niveis_atuacao'] = $this->default_model->listaAssociativa('niveis_de_atuacao', 'nome_nivel', NULL, NULL, 'ordem', 'ASC', false, 'id_nivel');
		$data['areas_atuacao'] = $this->default_model->listaAssociativa('area_de_atuacao', 'nome_area', NULL, NULL, 'ordem', 'ASC', false, 'id_area');
		unset($data['areas_atuacao']['']);
		$data['pretensoes_salariais'] = $this->default_model->listaAssociativa('pretencaosalarial', 'pretencaosalarial_nome', NULL, NULL, 'ordem', 'ASC', false, 'pretencaosalarial_id');

		if($data['registro']){

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
			$join = array('pretencaosalarial' => array('where' => 'pretencaosalarial.pretencaosalarial_id = pretencaosalarial_id', 'type' => 'inner'));
			$data['pretensao_salarial'] = $this->default_model->get_by_id('pretencaosalarial_cadastro', $data['registro']->id_curriculo, array('pretencaosalarial_cadastro.*, pretencaosalarial.pretencaosalarial_nome'), NULL, $join, 'curriculos_id_curriculo');
		}

		//Carrega view
		$this->loadView('banco_de_talentos/bancodetalentos-meu-curriculo', $data);

	}

	public function curriculos_contratados(){

		//$usuario_id = $this->session->userdata('SessionIdEmpresa');

                // cada modulo terá um numero que e visualizado na primary da tabela area_permissoes_concedidas
	        check_login_empresa(3);
                if ($this->session->userdata('SessionIdEmpresa')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionIdEmpresa');
                    // este helper controla quem esta logado para exibir o menu da area restrita
                   seleciona_menu_area_restrita('J');
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes');
                    // este helper controla quem esta logado para exibir o menu da area restrita
                   seleciona_menu_area_restrita('FJ');
                }




		//Busca inscrições aprovadas
		$join = array('compras' => array('where' => 'compras.id = selecao_curriculos_inscricoes.compra_id', 'type' => 'inner'));
		$dados['curriculos_inscricoes'] = $this->default_model->get_all('selecao_curriculos_inscricoes', array('selecao_curriculos_inscricoes.*'), 0, NULL, array('inscritos_id' => $usuario_id, 'compras.status' => 'AP'), $join, 'selecao_curriculos_inscricoes.id_inscricao', 'DESC');

		//Carrega view
		$this->loadView('banco_de_talentos/bancodetalentos-selecao-curriculos',$dados);

	}

	public function ver_curriculos_contratados($inscricao_id){

                // cada modulo terá um numero que e visualizado na primary da tabela area_permissoes_concedidas
	        check_login_empresa(3);
                if ($this->session->userdata('SessionIdEmpresa')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionIdEmpresa');
                }elseif($this->session->userdata('SessionEmpresaPermissoes')>0){
                   //Id da empresa
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes');
                }




		//Inscrição
		$join = array('compras' => array('where' => 'compras.id = selecao_curriculos_inscricoes.compra_id', 'type' => 'inner'));
		$inscricao = $this->default_model->get_by_id('selecao_curriculos_inscricoes', $inscricao_id, array('*'), array('inscritos_id' => $usuario_id, 'compras.status' => 'AP'), $join, 'id_inscricao');

		//Define join
		$join = array('inscritos' => array('where' => 'inscritos.id = curriculos.inscritos_id AND tipo_pessoa = "F"', 'type' => 'inner'),
					  'niveis_de_atuacao' => array('where' => 'niveis_de_atuacao.id_nivel = curriculos.niveis_de_atuacao_id_nivel', 'type' => 'left')
				);

		//Busca currículos
		$data['curriculos'] = $this->default_model->get_all('curriculos', array('curriculos.*, inscritos.nome as inscrito, niveis_de_atuacao.nome_nivel'), 0, NULL, 'id_curriculo IN ('.$inscricao->curriculos_ids.')', $join, 'curriculos.id_curriculo', 'DESC');

		//Curriculos
		$data['graus_formacao'] = $this->graus_formacao;
		if($data['curriculos']){
			foreach($data['curriculos'] as $key => $curriculo){

				//Faixa salarial
				$formacao_academica = $this->default_model->get_all('formacao_academica', array('*'), 0, 1, array('curriculos_id_curriculo' => $curriculo->id_curriculo), NULL, 'data_conclusao', 'DESC');
				if($formacao_academica)
					$data['curriculos'][$key]->formacao_academica = $formacao_academica[0];

				//Faixa salarial
				$join = array('pretencaosalarial' => array('where' => 'pretencaosalarial.pretencaosalarial_id = pretencaosalarial_pretencaosalarial_id', 'type' => 'inner'));
				$data['curriculos'][$key]->faixa_salarial = $this->default_model->get_by_id('pretencaosalarial_cadastro', $curriculo->id_curriculo, array('*'), NULL, $join, 'curriculos_id_curriculo');

				//área de atuação
				$join = array('area_de_atuacao' => array('where' => 'area_de_atuacao.id_area = area_de_atuacao_id_area', 'type' => 'inner'));
				$data['curriculos'][$key]->areas_atuacao = $this->default_model->get_all('area_atuacao_cadastro', array('*'), 0, NULL, array('curriculos_id_curriculo' => $curriculo->id_curriculo), $join);
			}
		}

		$this->loadView('banco_de_talentos/bancodetalentos-buscar-curriculos',$data);
	}

	public function visualizar($id){

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
