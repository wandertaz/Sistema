<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orcamento_online extends CI_Controller {

	var $titulo 		= 'Orçamento Online';
	var $dir 			= 'multitools/orcamento_online/';
	var $controller 	= 'multitools/orcamento_online';
	var $title_sing 	= 'Orçamento Online';
	var $per_page 		= 20;
	var $table 			= 'orcamento_online';
    var $join 			= NULL;

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($offset = 0){//ok

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;
		//Menu
		get_menu();

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*'), $offset, $this->per_page, array(), null,'lido,created', 'ASC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table,FALSE,'');
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function editar($id){//ok

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_orcamento_online');

		$traducoes = array('segmento_empresa' => 'Segmento da Empresa', 'qt_participantes' => 'Quantidade de Colaboradores', 'desc_produtos_servicos' => 'Produtos/Serviços da Empresa',
						   'qtd_unidades_certificadas' => 'Quantidade de Unidades para certificação', 'localizacao_unidade' => 'Localização das Unidades',
						   'possui_departamento_qualidade' => 'Possui departamento/profissional da Qualidade?', 'sistema_auditado' => 'Qual sistema será auditado?',
						   'qual_occ_certificou' => 'Qual o Organismo Certificador (OCC)?', 'qts_nao_conformidades' => 'Quantidade de não-conformidades registradas na última auditoria',
						   'qtd_hds' => 'Quantidade de HDs para auditoria', 'qt_colaboradores_envolvidos' => 'Quantidade de Colaboradores diretamente envolvidos',
						   'form_orcamento_qual_auditoria' => 'Tipo de Auditoria', 'qtd_tempo_certificada' => 'Quanto tempo de certificação no sistema',
                                                   'prof_especializado'=>'Profissional Especializado','possui_alguma_certificacao'=>'Possue Certificação','possui_sala'=>'Possui Sala',
                                                   'expectativa_certificacao'=>'Expectativa Certificação','certificacoes_pretendidas'=>'Certificações Pretendidas','obras_atualmente'=>'Em Obras Atualmente',
                                                   'form_orcamento_iso9001'=>'Possui Iso 9001','trabalho_homeoffice'=>'Trabalho Home/Office','program_integracao_ao_mtrabalho'=>'Programa Integracao do Trabalho',
                                                   'regime_remuneracao'=>'Eegime Remuneração','form_orcamento_iso14001'=>'Possui Iso 14001','form_orcamento_ohsas18001'=>'Possui ohsas 18001','cod_conduta'=>'Possui código de conduta',
                                                   'programadas_mte'=>'Programamas do MTE','estrutura_sesmt'=>'Estrutura SESMT Existente','monitor_acidentes_trabalho'=>'Possui Monitoramento (acidentes de trabalho)',
                                                   'tipo_curso'=>'Tipo de Curso','nome_do_curso'=>'Nome do Curso','area_curso'=>'Àrea do Curso','objetivo_curso'=>'Objetivo do Curso','carga_horaria'=>'Carga Horária',
                                                   'publico_alvo'=>'Público Alvo','resultado_esperado'=>'Resultado Esperado','local_realizacao'=>'Local Realização','possui_em_sua_infraestrutura'=>'Possui Infraestrutura',
                                                   'data_inicio'=>'Data Início','data_fim'=>'Data Fim','horario_previsto'=>'Horário Previsto','residuos_solidos_gerados'=>'Resíduos Sólidos Gerados','outros_residuos'=>'Possui outros resíduos',
                                                   'coleta_seletiva'=>'Realiza Coleta Seletiva','tratamento_efluentes'=>'Possui Tratamento de Efluentes','possui_doc_legal'=>'documentação legal (licenças e registros, etc)',
                                                   'destinacao_tratamento_residuos'=>'Possui laudo de destinação (tratamento dos resíduos)','possui_assessoria_leg_ambiental'=>'Possui assessoria para atendimento legislação ambiental'
                                                   
                                                   
				);

		//Trata os dados
                if($data['registro']->array_post!=''){
                    $data['dados_formulario']=  unserialize($data['registro']->array_post);                   
                    foreach($data['dados_formulario'] as $indice => $valor){
                            if(isset($traducoes[$indice])){
                                    $data['dados_formulario'][$traducoes[$indice]] = $valor;
                                    unset($data['dados_formulario'][$indice]);

                            }

                    }
                }
		//print_r($data['dados_formulario']); exit;

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

        $dado['update']=array('lido'=>'S');
        $this->db->where(array('id_orcamento_online'=>$id));
        $this->db->update('orcamento_online',$dado['update']);

    	//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	/*private function _pagination($table, $search = FALSE){

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

	}*/
        
        
        
        
        private function _pagination($table, $search = FALSE, $tipo){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		$where = ($tipo ? array($this->table.'.tipo_orcamento' => $tipo) : NULL);
		//if($curso)
			//$where += array('inscricoes.curso_id' => $curso);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&tipo_orcamento='.$tipo;
		}
		else{
			
                        $config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
			$config['base_url']    = base_url().$this->controller.'/index';
		}

		//Inicializa e retorna paginação
		$this->pagination->initialize($config);
		return $this->pagination->create_links();

	}
        
        
        
        
        

	public function buscar(){//ok

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Parâmetros de busca
		//$data_busca[$this->table.'.nome_empresa']  = $this->input->get('s');
                $data_busca[$this->table.'.email_resposta']  = $this->input->get('s');
                //$data_busca[$this->table.'.nome_responsavel']  = $this->input->get('s');
                //$data_busca[$this->table.'.cargo_responsavel']  = $this->input->get('s');
                
                //$data_busca="(".$this->table.".nome_empresa "."like'%".$this->input->get('s')."%' or ".$this->table.".email_resposta "."like'%".$this->input->get('s')."%' or ".$this->table.".nome_responsavel "."like'%".$this->input->get('s')."%' or ".$this->table.".cargo_responsavel "."like'%".$this->input->get('s')."%')";
                
                if(trim($this->input->get('tipo_orcamento'))==''){
                    $where=null;
                    $tipo_orcamento='';
                }else{   
                    $where= array($this->table.'.tipo_orcamento'=>$this->input->get('tipo_orcamento'));
                    $tipo_orcamento=$this->input->get('tipo_orcamento');
                }
                
		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*'), $where, $offset, $this->per_page, $data_busca, null, 'lido,created', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca,$tipo_orcamento);

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