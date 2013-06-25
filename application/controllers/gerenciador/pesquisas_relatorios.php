<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesquisas_relatorios extends CI_Controller {

	var $titulo 		= 'Relatórios';
	var $dir 			= 'multitools/pesquisas_relatorios/';
	var $controller 	= 'multitools/pesquisas_relatorios';
	var $title_sing 	= 'Relatório';
	var $per_page 		= 20;
	var $table 			= 'pesquisas';
	var $join			= array('inscritos' => array('where' => 'inscritos.id = inscritos_id', 'type' => 'inner'));

	public function __construct(){
		parent::__construct();
		$this->load->helper('auxiliar_pesquisa_helper');
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
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, nome'), $offset, $this->per_page, array('status'=>'AP'), $this->join, $this->table.'.id_pesquisas', 'DESC');

                               
		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
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
		$data_busca[$this->table.'.titulo']  = $this->input->get('s');
		$data_busca[$this->table.'.created'] = $this->input->get('s');
		$data_busca['inscritos.nome'] = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, nome'), NULL, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id_pesquisas', 'DESC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function tabulacao($id){

		//Busca registro
		$data['pesquisa'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas');

		//Busca perguntas da pesquisa
		$data['perguntas'] = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_id_pesquisas' => $id, 'pesquisas_perguntas_id_pesquisas_perguntas' => NULL, 'tipo <>' => 'ABE'), NULL, 'ordem', 'ASC');

		//Busca opções
		foreach($data['perguntas'] as $key => $pergunta){

			if($pergunta->tipo == 'P05' || $pergunta->tipo == 'P10' || $pergunta->tipo == 'CLA'){
				$data['perguntas'][$key]->sub_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');

                                print($pergunta->pergunta);
		echo '<pre>';
                                print_r($data['perguntas'][$key]->sub_perguntas);
                                
				if($pergunta->tipo == 'CLA'){
					 foreach($data['perguntas'][$key]->sub_perguntas as $key_sub => $subpergunta) {
						$data['perguntas'][$key]->sub_perguntas[$key_sub]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $subpergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
                                                
                                                if  (isset($data['perguntas'][$key]->sub_perguntas[$key_sub]->opcoes)) 
                                                    $data['perguntas'][$key]->sub_perguntas[$key_sub]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
                                                
                                                
                                                    foreach($data['perguntas'][$key]->sub_perguntas[$key_sub]->opcoes as $key_opcao => $opcao){
                                                            $count_opcao = $this->default_model->get_all('pesquisas_respostas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes' => $opcao->id_pesquisas_perguntas_opcoes,'pesquisas_perguntas_id_pesquisas_perguntas' => $subpergunta->id_pesquisas_perguntas));
                                                            $data['perguntas'][$key]->sub_perguntas[$key_sub]->opcoes[$key_opcao]->total_respostas = $count_opcao[0]->total;
                                                    }
                                        }
                                
                                        $data['perguntas'][$key]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
                                        

					$count_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
					$data['perguntas'][$key]->total_sub_perguntas = $count_perguntas[0]->total;
				}

				foreach($data['perguntas'][$key]->sub_perguntas as $key_sub => $subpergunta){
					$count_total = $this->default_model->get_all('pesquisas_respostas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $subpergunta->id_pesquisas_perguntas));
					$data['perguntas'][$key]->sub_perguntas[$key_sub]->total_respostas = $count_total[0]->total;
				}
			}
			else if($pergunta->tipo == 'RAD' || $pergunta->tipo == 'CHE'){
				$data['perguntas'][$key]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');

				foreach($data['perguntas'][$key]->opcoes as $key_opcao => $opcao){
					$count_opcao = $this->default_model->get_all('pesquisas_respostas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes' => $opcao->id_pesquisas_perguntas_opcoes));
					$data['perguntas'][$key]->opcoes[$key_opcao]->total_respostas = $count_opcao[0]->total;
				}
			}

			$count_respostas = $this->default_model->get_all('pesquisas_respostas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas));
			$data['perguntas'][$key]->total_respostas = $count_respostas[0]->total;
		}

		$data['total_respostas_contatos'] = $this->default_model->get_all('pesquisas_respostas', array('COUNT(DISTINCT pesquisas_contatos_id_pesquisas_contatos) AS total'), 0, NULL, array('pesquisas_id_pesquisas' => $id));
		
			
		//echo '<pre>';
		//print_r($data['perguntas']);
		exit;

		//Carrega view
		$this->load->view($this->dir.'tabulacao', $data);
	}

        
        	public function graficos($id){

		//Busca registro
		$data['pesquisa'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas');

		//Busca perguntas da pesquisa
		$data['perguntas'] = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_id_pesquisas' => $id, 'pesquisas_perguntas_id_pesquisas_perguntas' => NULL, 'tipo <>' => 'ABE'), NULL, 'ordem', 'ASC');

		//Busca opções
		foreach($data['perguntas'] as $key => $pergunta){

			if($pergunta->tipo == 'P05' || $pergunta->tipo == 'P10' || $pergunta->tipo == 'CLA'){
				$data['perguntas'][$key]->sub_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');

				if($pergunta->tipo == 'CLA'){ 
                                        foreach($data['perguntas'][$key]->sub_perguntas as $key_sub => $subpergunta) {
						$data['perguntas'][$key]->sub_perguntas[$key_sub]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $subpergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
                                                
                                                if  (isset($data['perguntas'][$key]->sub_perguntas[$key_sub]->opcoes)) 
                                                    $data['perguntas'][$key]->sub_perguntas[$key_sub]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
                                                
                                                
                                                    foreach($data['perguntas'][$key]->sub_perguntas[$key_sub]->opcoes as $key_opcao => $opcao){
                                                            $count_opcao = $this->default_model->get_all('pesquisas_respostas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes' => $opcao->id_pesquisas_perguntas_opcoes,'pesquisas_perguntas_id_pesquisas_perguntas' => $subpergunta->id_pesquisas_perguntas));
                                                            $data['perguntas'][$key]->sub_perguntas[$key_sub]->opcoes[$key_opcao]->total_respostas = $count_opcao[0]->total;
                                                    }
                                        }
                                
                                        $data['perguntas'][$key]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
                                        

                                
                                        $data['perguntas'][$key]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
                                        
					$count_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
					$data['perguntas'][$key]->total_sub_perguntas = $count_perguntas[0]->total;
				}

				foreach($data['perguntas'][$key]->sub_perguntas as $key_sub => $subpergunta){
					$count_total = $this->default_model->get_all('pesquisas_respostas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $subpergunta->id_pesquisas_perguntas));
					$data['perguntas'][$key]->sub_perguntas[$key_sub]->total_respostas = $count_total[0]->total;
				}
			}
			else if($pergunta->tipo == 'RAD' || $pergunta->tipo == 'CHE'){
				$data['perguntas'][$key]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');

				foreach($data['perguntas'][$key]->opcoes as $key_opcao => $opcao){
					$count_opcao = $this->default_model->get_all('pesquisas_respostas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes' => $opcao->id_pesquisas_perguntas_opcoes));
					$data['perguntas'][$key]->opcoes[$key_opcao]->total_respostas = $count_opcao[0]->total;
				}
			}

			$count_respostas = $this->default_model->get_all('pesquisas_respostas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas));
			$data['perguntas'][$key]->total_respostas = $count_respostas[0]->total;
		}
		
		$data['total_respostas_contatos'] = $this->default_model->get_all('pesquisas_respostas', array('COUNT(DISTINCT pesquisas_contatos_id_pesquisas_contatos) AS total'), 0, NULL, array('pesquisas_id_pesquisas' => $id));
		
				
		//Carrega view
		$this->load->view($this->dir.'graficos', $data, true);
                
                
                
                        //helpers
			$this->load->helper(array('dompdf', 'file'));

			//recebe html da view
			$html = utf8_decode($this->load->view($this->dir.'graficos', $data, true));
                        //print_r($html);
                       // exit();
            
			//Cria pdf
			pdf_create($html, 'MB CONSULTORIA - Relatório - gráfico - '.$data['pesquisa']->titulo);
                
                
                
                
	}
        
        
        public function questoes_abertas($id){

		//Busca registro
		$data['pesquisa'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas');

		//Busca perguntas da pesquisa
		$data['perguntas'] = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, ( 'pesquisas_id_pesquisas = '.$id.' AND pesquisas_perguntas.pesquisas_perguntas_id_pesquisas_perguntas IS NULL AND ( pesquisas_perguntas.tipo = \'ABE\'  OR ( pesquisas_perguntas.tipo IN ( \'CHE\' , \'RAD\' )  AND pesquisas_perguntas_opcoes.tipo = \'A\' ) ) '), array('pesquisas_perguntas_opcoes' => array('where' => 'pesquisas_perguntas_opcoes.pesquisas_perguntas_id_pesquisas_perguntas = id_pesquisas_perguntas', 'type' => 'left outer')), 'ordem', 'ASC');
		
		$data['perguntas_respostas'] = null;
		//Busca opções
		foreach($data['perguntas'] as $key => $pergunta){                  			
                    $data['respostas']= $this->default_model->get_all('pesquisas_respostas', array('resposta'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas,'pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes' => $pergunta->id_pesquisas_perguntas_opcoes,'pesquisas_id_pesquisas'=> $id));
                    $data['resposta']=array();
                    foreach($data['respostas'] as $key => $resposta){                    
                        $data['resposta'][]=array('resposta'=>$resposta->resposta);
                    }
                        $data['perguntas_respostas'][]= array('id_pesquisas_perguntas'=>$pergunta->id_pesquisas_perguntas,'pergunta'=>$pergunta->pergunta,'respostas'=>$data['resposta']);
                 
                   // print_r($data['perguntas_respostas']);
                   // exit();

		}

		                
                        //helpers
			$this->load->helper(array('dompdf', 'file'));

			//recebe html da view
			$html = utf8_decode($this->load->view($this->dir.'questoes_abertas', $data, true));
                        //print_r($html);
                        //exit();
                    
			//Cria pdf
			pdf_create($html, 'MB CONSULTORIA - Relatório - '.$data['pesquisa']->titulo);
                
                
                
                
	}
        
        
        
        
        
        
        
        
        
        
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */