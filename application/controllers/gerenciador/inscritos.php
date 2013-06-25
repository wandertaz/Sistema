<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscritos extends CI_Controller {

	var $titulo 		= 'Inscritos';
	var $dir 			= 'multitools/inscritos/';
	var $controller 	= 'multitools/inscritos';
	var $title_sing 	= 'Inscrito';
	var $per_page 		= 20;
	var $table 			= 'inscritos';
	var $join			= NULL;
	var $estados_civis  = array('S' => 'Solteiro(a)', 'C' => 'Casado(a)', 'D' => 'Divorciado(a)', 'V' => 'Viúvo(a)');
        
        
        var $ramo_atividade=array(''=>'Selecione','AGRICULTURA, PECUÁRIA, PRODUÇÃO FLORESTAL, PESCA E AQÜICULTURA'=>'AGRICULTURA, PECUÁRIA, PRODUÇÃO FLORESTAL, PESCA E AQÜICULTURA','INDÚSTRIAS EXTRATIVAS'=>'INDÚSTRIAS EXTRATIVAS','FABRICACAO DE PRODUTOS ALIMENTICIOS'=>'FABRICACAO DE PRODUTOS ALIMENTICIOS','FABRICACAO DE BEBIDAS'=>'FABRICACAO DE BEBIDAS','FABRICACAO DE PRODUTOS TÊXTIS'=>'FABRICACAO DE PRODUTOS TÊXTIS',
            'FABRICACAO DE PRODUTOS DO FUMO'=>'FABRICACAO DE PRODUTOS DO FUMO','FABRICACAO DE ARTIGOS DE VESTUARIO'=>'FABRICACAO DE ARTIGOS DE VESTUARIO',
            'FABRICACAO DE PRODUTOS DE MADEIRA'=>'FABRICACAO DE PRODUTOS DE MADEIRA','FABRICACAO DE CELULOSE, PAPEL E DERIVADOS'=>'FABRICACAO DE CELULOSE, PAPEL E DERIVADOS','FABRICACAO DE PRODUTOS DERIVADOS DO PETROLEO'=>'FABRICACAO DE PRODUTOS DERIVADOS DO PETROLEO',
            'FABRICACAO DE PRODUTOS QUIMICOS E FARMOQUIMICOS'=>'FABRICACAO DE PRODUTOS QUIMICOS E FARMOQUIMICOS',
            'FABRICACAO DE PRODUTOS DE BORRACHA E MATERIAL PLASTICO'=>'FABRICACAO DE PRODUTOS DE BORRACHA E MATERIAL PLASTICO',
            'FABRICACAO DE PRODUTOS MINERAIS NAO-METALICOS'=>'FABRICACAO DE PRODUTOS MINERAIS NAO-METALICOS',
            'FABRICACAO DE PRODUTOS DE INFORMATICA, ELETRONICOS E OPTICOS'=>'FABRICACAO DE PRODUTOS DE INFORMATICA, ELETRONICOS E OPTICOS',
            'FABRICACAO DE MAQUINAS, APARELHOS ELETRICOS E EQUIPAMENTOS'=>'FABRICACAO DE MAQUINAS, APARELHOS ELETRICOS E EQUIPAMENTOS',
            'FABRICACAO DE VEICULOS, EQUIPAMENTOS DE TRANSPORTE E ACESSORIOS'=>'FABRICACAO DE VEICULOS, EQUIPAMENTOS DE TRANSPORTE E ACESSORIOS',
            'METALURGIA'=>'METALURGIA','FABRICACAO DE MOVEIS'=>'FABRICACAO DE MOVEIS','FABRICACAO DE PRODUTOS DIVERSOS'=>'FABRICACAO DE PRODUTOS DIVERSOS',
            'MANUTENÇAO E REPARACAO DE MAQUINAS E EQUIPAMENTOS'=>'MANUTENÇAO E REPARACAO DE MAQUINAS E EQUIPAMENTOS',
            'INDÚSTRIAS DE TRANSFORMAÇÃO'=>'INDÚSTRIAS DE TRANSFORMAÇÃO','ELETRICIDADE E GÁS'=>'ELETRICIDADE E GÁS','ÁGUA, ESGOTO, ATIVIDADES DE GESTÃO DE RESÍDUOS E DESCONTAMIN'=>'ÁGUA, ESGOTO, ATIVIDADES DE GESTÃO DE RESÍDUOS E DESCONTAMIN',
            'CONSTRUÇÃO'=>'CONSTRUÇÃO','COMÉRCIO; REPARAÇÃO DE VEÍCULOS AUTOMOTORES E MOTOCICLETAS'=>'COMÉRCIO; REPARAÇÃO DE VEÍCULOS AUTOMOTORES E MOTOCICLETAS',
            'TRANSPORTE, ARMAZENAGEM E CORREIO'=>'TRANSPORTE, ARMAZENAGEM E CORREIO','ALOJAMENTO E ALIMENTAÇÃO'=>'ALOJAMENTO E ALIMENTAÇÃO',
            'INFORMAÇÃO E COMUNICAÇÃO'=>'INFORMAÇÃO E COMUNICAÇÃO','ATIVIDADES FINANCEIRAS, DE SEGUROS E SERVIÇOS RELACIONADOS'=>'ATIVIDADES FINANCEIRAS, DE SEGUROS E SERVIÇOS RELACIONADOS',
            'ATIVIDADES IMOBILIÁRIAS'=>'ATIVIDADES IMOBILIÁRIAS','ATIVIDADES JURIDICAS, DE CONTABILIDADE E AUDITORIA'=>'ATIVIDADES JURIDICAS, DE CONTABILIDADE E AUDITORIA',
            'ATIVIDADES DE CONSULTORIA'=>'ATIVIDADES DE CONSULTORIA','SERVICOS DE ARQUITETURA E ENGENHARIA, TESTES E ANALISES CLINICAS'=>'SERVICOS DE ARQUITETURA E ENGENHARIA, TESTES E ANALISES CLINICAS',
            'PESQUISA E DESENVOLVIMENTO CIENTIFICO'=>'PESQUISA E DESENVOLVIMENTO CIENTIFICO','PUBLICIDADE E PESQUISA DE MERCADO'=>'PUBLICIDADE E PESQUISA DE MERCADO',
            'OUTRAS ATIVIDADES PROFISSIONAIS, CIENTIFICAS E TECNICAS'=>'OUTRAS ATIVIDADES PROFISSIONAIS, CIENTIFICAS E TECNICAS',
            'ATIVIDADES VETERINARIAS'=>'ATIVIDADES VETERINARIAS','ALUGUEIS E GESTAO DE ATIVOS INTANGIVEIS NAO-FINANCEIROS'=>'ALUGUEIS E GESTAO DE ATIVOS INTANGIVEIS NAO-FINANCEIROS',
            'SELECAO, AGENCIAMENTO E LOCACAO DE MAO-DE-OBRA'=>'SELECAO, AGENCIAMENTO E LOCACAO DE MAO-DE-OBRA','AGENCIAS DE VIAGENS E OPERADORES TURISTICOS'=>'AGENCIAS DE VIAGENS E OPERADORES TURISTICOS',
            'ATIVIDADES DE SEGURANCA E VIGILANCIA E INVESTIGACAO'=>'ATIVIDADES DE SEGURANCA E VIGILANCIA E INVESTIGACAO','SERVICOS PARA EDIFICIOS E ATIVIDADES PAISAGISTICAS'=>'SERVICOS PARA EDIFICIOS E ATIVIDADES PAISAGISTICAS',
            'SERVICOS DE ESCRITORIO, APOIO ADMINISTRATIVO E OUTROS'=>'SERVICOS DE ESCRITORIO, APOIO ADMINISTRATIVO E OUTROS','ADMINISTRAÇÃO PÚBLICA, DEFESA E SEGURIDADE SOCIAL'=>'ADMINISTRAÇÃO PÚBLICA, DEFESA E SEGURIDADE SOCIAL',
            'EDUCAÇÃO'=>'EDUCAÇÃO','SAÚDE HUMANA E SERVIÇOS SOCIAIS'=>'SAÚDE HUMANA E SERVIÇOS SOCIAIS','MEIO AMBIENTE'=>'MEIO AMBIENTE',
            'ARTES, CULTURA, ESPORTE E RECREAÇÃO'=>'ARTES, CULTURA, ESPORTE E RECREAÇÃO','OUTRAS ATIVIDADES DE SERVIÇOS'=>'OUTRAS ATIVIDADES DE SERVIÇOS',
            'SERVIÇOS DOMÉSTICOS'=>'SERVIÇOS DOMÉSTICOS','ORGANISMOS INTERNACIONAIS E OUTRAS INSTITUIÇÕES EXTRATERRITORIAIS'=>'ORGANISMOS INTERNACIONAIS E OUTRAS INSTITUIÇÕES EXTRATERRITORIAIS',
            'OUTROS'=>'OUTROS');

	public function __construct(){
		parent::__construct();
		check_login();
		$this->load->helper("br_date_helper");
                
	}

	public function index($tipo = 'F'){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;                
                $offset = $this->input->get('per_page');              
		//Menu
		get_menu();
               
		//Tipo de Pessoa
		$data['tipo'] = $tipo;
                
              //  print_r($tipo);
                
		$where = ($data['tipo'] ? array('inscritos.tipo_pessoa' => $data['tipo']) : NULL);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*'),$offset, $this->per_page, $where, $this->join, array($this->table.'.ativo' => 'DESC', 'nome' => 'ASC'));

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false,$tipo);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

                if($tipo=='F'){
                    //Carrega view
                    $this->load->view($this->dir.'index', $data);
                }else{
                    
                    
                    
                   //Carrega view
                    $this->load->view($this->dir.'index_empresa', $data);                    
                }
		get_footer(TRUE);
	}

	public function adicionar($tipo = 'F'){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar ';

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Tipo de Pessoa
		$data['tipo'] = $tipo;

		//$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome', NULL, array('inscrito_responsavel_id' => NULL));
		//$data['empresas'] = $this->default_model->listaAssociativa('empresas', 'nome');

		$data['estados_civis'] = $this->estados_civis;

                
                if($tipo=='F'){
                    //Carrega view
                    $this->load->view($this->dir.'form', $data);
                }else{
                    
                    $data['ramo_atividade']=  $this->ramo_atividade;
                   //Carrega view
                    $this->load->view($this->dir.'form_empresa', $data);                    
                }
                
		
		
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Tipo de Pessoa
		$data['tipo'] = $data['registro']->tipo_pessoa;

		//$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome', NULL, array('inscrito_responsavel_id' => NULL));
		//$data['empresas'] = $this->default_model->listaAssociativa('empresas', 'nome');

		$data['estados_civis'] = $this->estados_civis;

		
                if($data['tipo']=='F'){
                    //Carrega view
                    $this->load->view($this->dir.'form', $data);
                }else{
                    $data['ramo_atividade']=  $this->ramo_atividade;
                   //Carrega view
                    $this->load->view($this->dir.'form_empresa', $data);                    
                }


                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;
//print_r($data);
//exit();
		//Trata os dados
		$data['data_nascimento'] = w3c_date($_POST['data_nascimento']);
		$data['inscrito_responsavel_id'] = (isset($data['inscrito_responsavel_id']) ? $data['inscrito_responsavel_id'] : NULL);
		$data['empresa_id'] = (isset($data['empresa_id']) ? $data['empresa_id'] : NULL);

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id'], $data);
		else{
                    
                        // valida se o cpf cnpj ja foi cadastrado
                        $where = "(email ='".$data['email']."') or (cpf_cnpj ='".$data['cpf_cnpj']."')";
                        //Registros 
                        $dat['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*'),null, null, $where, null, null);

                        if(isset($dat["registros"]) && count($dat["registros"])<=0){
                            $rows_affected = $this->default_model->insert($this->table, $data);
                            
                        }
                        else{
                            $chave_duplicada=1;
                        }
                       
                       
                        
                    
			
		}

		//Mensagem de retorno
		if($rows_affected == 1){
			$msg = 'Dados salvos com sucesso.';
                }else{
                        if($chave_duplicada==1){
                            $msg = 'E-mail ou Cpf/Cnpj já foram cadastrados.';
                        }else{
                            $msg = 'Não foi possível salvar os dados.';
                        }
                }
		//Retorno
		$this->session->set_flashdata('msg', $msg);
                
                
		redirect($this->controller.'/index/'.$data['tipo_pessoa']);
	}

	public function excluir($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);
		$tipo = $data['registro']->tipo_pessoa;

		//Exclui registro
		if($this->default_model->update($this->table, $id, array('ativo' => 'N')))
			$this->session->set_flashdata('msg', 'Registro desativado com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi desativado!');

		//Retorno
		redirect($this->controller.'/index/'.$tipo);
	}

        private function _pagination($table, $search = FALSE, $tipo = 'F'){

		$where = ($tipo ? array('inscritos.tipo_pessoa' => $tipo) : NULL);

                
                
		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';
               
$config['page_query_string'] = TRUE;
		//Parâmetro
		if($search){
			//$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&tipo='.$tipo;;
		}
		else{
			$config['uri_segment'] = 4;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);                        
			$config['base_url']    = base_url().$this->controller.'/index/'.$tipo.'?';
                        
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
		//$data_busca[$this->table.'.email'] = $this->input->get('s');
		$data['tipo'] = $this->input->get('tipo');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*'), array('tipo_pessoa' => $data['tipo']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'DESC');
		$data['paginacao'] = $this->_pagination($this->table,$data_busca,$data['tipo']);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		//$this->load->view($this->dir.'index', $data);
                
                
                
                 if($data['tipo']=='F'){
                    //Carrega view
                    $this->load->view($this->dir.'index', $data);
                }else{
                   //Carrega view
                    $this->load->view($this->dir.'index_empresa', $data);                    
                }
                
                
                
		get_footer(TRUE);
	}
        
        
        
        
        public function gerenciamento_usuarios($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);
                
                
                
                $join= array('inscritos' => array('where' => 'inscritos.id = area_permissoes_concedidas.inscritos_id', 'type' => 'inner'));
                
                //Busca registro dos usuarios com permissão juridica                         
                $data['cadastrados'] = $this->default_model->get_all('area_permissoes_concedidas', array('area_permissoes_concedidas.*','inscritos.nome','inscritos.email','inscritos.ativo','inscritos.id'),  NULL,null, array('area_permissoes_concedidas_id_empresa'=>$id), $join, 'inscritos.nome', 'asc');
                
               // print_r($data['cadastrados']);
                
                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Tipo de Pessoa
		$data['id_empresa'] = $id;


                //Carrega view
                 $this->load->view($this->dir.'index_gerenciamento', $data);                    
               

                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}
        
        
        
        
         public function editar_permissoes($id_empresa=false , $id_inscritos=false){

		if($id_empresa==false || $id_inscritos==false){
                    $this->session->set_flashdata('msg', 'A permissão não foi alterada dados inconsistentes!');
                    redirect($this->controller.'/index/J');                    
                }


                //Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

                
                $data['empresa'] = $this->default_model->get_by_id('inscritos', $id_empresa);
                
                $data['inscrito'] = $this->default_model->get_by_id('inscritos', $id_inscritos);
         
                
                $join= array('area_permissoes_concedidas' => array('where' => 'area_permissoes.area_permissoes_id = area_permissoes_concedidas.area_permissoes_area_permissoes_id and area_permissoes_concedidas.inscritos_id='.$id_inscritos, 'type' => 'left'));
                
                //Busca registro dos usuarios com permissão juridica                         
                $data['categorias'] = $this->default_model->get_all('area_permissoes', array('area_permissoes.area_permissoes_id','area_permissoes.nome_area_permissoes','area_permissoes_concedidas.area_permissoes_concedidas_id'),  NULL,null, array('area_permissoes.ativo' => 'S'), $join, 'area_permissoes.ordem', 'asc');
  

                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Tipo de Pessoa
		//$data['tipo'] = $data['registro']->tipo_pessoa;


                //Carrega view
                 $this->load->view($this->dir.'form_permissoes', $data);                    
               

                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}
        
        public function adicionar_permissoes($id_empresa=false){

		if($id_empresa==false){
                    $this->session->set_flashdata('msg', 'A permissão não foi alterada, dados inconsistentes!');
                    redirect($this->controller.'/index/J');                    
                }


                //Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

                
                $data['empresa'] = $this->default_model->get_by_id('inscritos', $id_empresa);
                
                //$data['inscrito'] = $this->default_model->get_by_id('inscritos', $id_inscritos);
         
                
                //$join= array('area_permissoes_concedidas' => array('where' => 'area_permissoes.area_permissoes_id = area_permissoes_concedidas.area_permissoes_area_permissoes_id ', 'type' => 'left'));
                
                //Busca registro dos usuarios com permissão juridica                         
                $data['categorias'] = $this->default_model->get_all('area_permissoes', array('area_permissoes.area_permissoes_id','area_permissoes.nome_area_permissoes'),  NULL,null, array('area_permissoes.ativo' => 'S'), null, 'area_permissoes.ordem', 'asc');
  

                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Tipo de Pessoa
		//$data['tipo'] = $data['registro']->tipo_pessoa;


                //Carrega view
                 $this->load->view($this->dir.'form_permissoes', $data);                    
               

                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}
        
        
        
        
        
        
        
        
        
        
        
        public function salvar_permissoes(){
		//Recebe Post
		$data = $_POST;
              
                    
                $dat['categorias'] = $this->default_model->get_all('area_permissoes_concedidas', array('area_permissoes_concedidas.*'),  NULL,null, array('area_permissoes_concedidas.area_permissoes_concedidas_id_empresa !=' =>$data['area_permissoes_concedidas_id_empresa'], 'area_permissoes_concedidas.inscritos_id' =>$data['inscritos_id']), null, null, null);
                
                
                if(count($dat['categorias'])>0){
                    $this->session->set_flashdata('msg', 'Erro:Este Usuário já esta em uso por outra empresa!');
                    redirect($this->controller.'/Gerenciamento_usuarios/'.$data['area_permissoes_concedidas_id_empresa']); 
                }else{
                   $err= $this->default_model->delete('area_permissoes_concedidas',array('area_permissoes_concedidas.inscritos_id'=>$data['inscritos_id']));
                        for($x=0;$x<count($data['area_permissoes_area_permissoes_id']);$x++){
                            
                          $this->default_model->insert('area_permissoes_concedidas',array('area_permissoes_concedidas_id_empresa'=>$data['area_permissoes_concedidas_id_empresa'],'inscritos_id'=>$data['inscritos_id'],'area_permissoes_area_permissoes_id'=>$data['area_permissoes_area_permissoes_id'][$x]));
                            
                            
                        }
                                        
                        $this->session->set_flashdata('msg', 'Permissões alteradas com sucesso');
                        redirect($this->controller.'/Gerenciamento_usuarios/'.$data['area_permissoes_concedidas_id_empresa']); 
                
                    
                    
                }
              
	}

        
        
        
        
        
        
        
        
        
        
        
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */