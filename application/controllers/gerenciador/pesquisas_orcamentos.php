<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesquisas_orcamentos extends CI_Controller {

	var $titulo 		= 'Orçamentos de Pesquisas';
	var $dir 			= 'multitools/pesquisas_orcamentos/';
	var $controller 	= 'multitools/pesquisas_orcamentos';
	var $title_sing 	= 'Orçamento de Pesquisa';
	var $per_page 		= 20;
	var $table 			= 'pesquisas_orcamentos';
    var $join 			= NULL;

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
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*'), $offset, $this->per_page, array(), null,'created', 'DESC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;;

		//Menu
		get_menu();

	/*	$traducoes = array('tipo_pesquisa' => 'Pesquisa de Mercado', 'base_dados' => 'Sim. Totalmente atualizada e checada', 'local_pesquisa' => 'Capitais de todas as regiões do Brasil',
						   'qtd_pessoas_pesquisadas' => 'Até 50 pessoas', 'tamanho_questionario' => '11 a 20 questões',
						   'problemas' => 'Comportamento do consumidor', 'questoes_interesse' => 'Renda e faixa etária',
						   'perguntas' => 'Nenhuma pergunta', 'informacoes' => 'Atentar para a faixa etária'
						   );
		$serial_post=serialize($traducoes);
		$this->default_model->update($this->table, $id, array('array_post' => $serial_post), 'id_pesquisas_orcamentos');
		exit;
*/
		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas_orcamentos');

		$traducoes = array('tipo_pesquisa' 				=> 'Tipo de pesquisa a ser realizada',
						   'base_dados' 				=> 'A base de dados está preparada e atualizada?',
						   'local_pesquisa' 			=> 'Localização das pessoas a serem contactadas',
						   'qtd_pessoas_pesquisadas' 	=> 'Quantidade de pessoas para pesquisa',
						   'tamanho_questionario' 		=> 'Tamanho do questionário',
						   'problemas' 					=> 'Problemas/Situações específicas',
						   'questoes_interesse' 		=> 'Questões de interesse na pesquisa',
						   'perguntas' 					=> 'Perguntas já elaboradas',
						   'informacoes' 				=> 'Informações/Cuidados/Pontos de atenção'
						   );

		//Trata os dados
        if($data['registro']->array_post!=''){
            $data['post']=  unserialize($data['registro']->array_post);
            foreach($data['post'] as $indice => $valor){

					if(isset($traducoes[$indice])){
                            $data['dados_formulario'][$traducoes[$indice]] = $valor;
                            unset($data['post'][$indice]);

                    }

            }
        }

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

    	//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
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
		$data_busca[$this->table.'.nome_empresa']  = $this->input->get('s');
        $data_busca[$this->table.'.email_resposta']  = $this->input->get('s');
        $data_busca[$this->table.'.nome_responsavel']  = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*'), NULL, $offset, $this->per_page, $data_busca, null, 'created', 'DESC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}
}