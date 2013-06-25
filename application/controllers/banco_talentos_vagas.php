<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_talentos_vagas extends MY_Controller {

	


        //Retira a proteção deste controller
	protected $_dontProtectMe = true;
	var $per_page = 6;
        var $graus_formacao = array('EF' => 'Ensino Fundamental', 'EM' => 'Ensino Médio', 'GR' => 'Graduação', 'PG' => 'Pós-graduação/MBA', 'ME' => 'Mestrado', 'DO' => 'Doutoria');
	var $tipos_contrato = array('CL' => 'CLT', 'PJ' => 'Prestador de Serviço (PJ)', 'TE' => 'Temporário', 'AU' => 'Autônomo', 'ES' => 'Estágio', 'TR' => 'Trainee');
	var $niveis_idiomas = array('N' => 'Nenhum', 'B' => 'Básico', 'I' => 'Intermediário', 'A' => 'Avançado', 'F' => 'Fluente');

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
        $this->load->helper('auxiliar_helper');
	}

	public function index($offset = 0){

		//Título
		$data['title'] = 'Banco de Talentos';
		$data['url_pagina'] = 'banco-de-talentos';

		//Verifica se existe busca
		$busca = $this->input->post('palavra_chave');

		//Join
		$join = array('inscritos' => array('where' => 'inscritos.id = inscritos_id AND tipo_pessoa = "J"', 'type' => 'inner'));
		$join += array('niveis_de_atuacao' => array('where' => 'niveis_de_atuacao.id_nivel = niveis_de_atuacao_id_nivel', 'type' => 'inner'));

		//vagas
		if($busca){
			$offset = $this->input->get('per_page');
			$data['vagas'] = $this->default_model->get_by_search('vagas', array('vagas.*, inscritos.nome as empresa, niveis_de_atuacao.nome_nivel'), array(), $offset, $this->per_page, array('titulo_cargo' => $busca, 'inscritos.nome' => $busca), $join, 'id_vaga', 'DESC');
			//$data['paginacao'] = $this->_pagination('vagas', $busca, '/banco_talentos_vagas/index?busca='.$busca);
		}
		else{
			$data['vagas'] = $this->default_model->get_all('vagas', $campos = array('vagas.*, inscritos.nome as empresa, niveis_de_atuacao.nome_nivel'), $offset, $this->per_page, array(), $join, $order_by = 'id_vaga', $dir = 'DESC');
			//$data['paginacao'] = $this->_pagination('vagas', false, '/banco_talentos_vagas/index');
		}

		//Dados de vagas
		if($data['vagas']){
			foreach($data['vagas'] as $key => $vaga){

				//Pretensão Salarial
				$join = array('pretencaosalarial' => array('where' => 'pretencaosalarial.pretencaosalarial_id = pretencaosalarial_pretencaosalarial_id', 'type' => 'inner'));
				$data['vagas'][$key]->faixa_salarial = $this->default_model->get_by_id('pretencaosalarial_vagas', $vaga->id_vaga, array('*'), NULL, $join, 'vaga_id_vaga');

			}
		}
                
                
                //Veja também- páginas de cursos
                $where_cursos = "url = 'central-de-downloads' or url = 'autodiagnosticos' or url = 'modulo-de-pesquisa'";   
		//$where_cursos = "url = 'cursos-in-company' OR url = 'programas-de-desenvolvimento' OR url = 'programa-alta-performance'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'RAND()', '');
                
                

		//Carrega view
		$this->loadView('banco_de_talentos/bancodetalentos', $data);
	}
        
        
        public function detalhes_vaga($id){

    		//Define join
    		$join = array('inscritos' => array('where' => 'inscritos.id = inscritos_id AND inscritos.tipo_pessoa = "J"', 'type' => 'inner'),
    					  'niveis_de_atuacao' => array('where' => 'niveis_de_atuacao.id_nivel = niveis_de_atuacao_id_nivel', 'type' => 'inner')
    					);

    		//Vaga
    		$data['vaga'] = $this->default_model->get_by_id('vagas', $id, array('vagas.*, inscritos.nome as empresa, niveis_de_atuacao.nome_nivel'), array('vagas.ativo' => 'S'), $join, 'id_vaga');

    		//Dados estáticos
    		$data['graus_formacao'] = $this->graus_formacao;
    		$data['tipos_contrato'] = $this->tipos_contrato;
    		$data['niveis_idiomas'] = $this->niveis_idiomas;

    		if($data['vaga']){

	    		//Áreas de Atuação
	    		$join = array('area_de_atuacao' => array('where' => 'area_de_atuacao.id_area = area_de_atuacao_id_area', 'type' => 'inner'));
	    		$data['vaga']->areas_atuacao = $this->default_model->get_all('areas_atuacao_vagas', array('*'), 0, NULL, array('vaga_id_vaga' => $id), $join);

	    		//Faixa Salarial
	    		$join = array('pretencaosalarial' => array('where' => 'pretencaosalarial.pretencaosalarial_id = pretencaosalarial_pretencaosalarial_id', 'type' => 'inner'));
	    		$data['vaga']->faixa_salarial = $this->default_model->get_by_id('pretencaosalarial_vagas', $id, array('*'), NULL, $join, 'vaga_id_vaga');

	    		//Idiomas
	    		$join = array('idiomas_selecao' => array('where' => 'idiomas_selecao.id_idioma = idiomas_id_idioma', 'type' => 'inner'));
	    		$data['vaga']->idiomas = $this->default_model->get_all('idiomas_vagas', array('*'), 0, NULL, array('vaga_id_vaga' => $id), $join);
    		}

    		//Carrega view
    		$this->loadView('banco_de_talentos/bancodetalentos_vaga_aberta', $data);
    	}
        
        
        
        
        
        
        
}
