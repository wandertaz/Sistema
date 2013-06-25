<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class crm extends CI_Controller {
        var $listId = "de13d49a02";
	var $titulo 		= 'CRM';
	var $dir 			= 'multitools/crm/';
	var $controller 	= 'multitools/crm';
	var $title_sing 	= 'CRM';
	var $per_page 		= 20;
	var $table 			= "inscritos";
	var $join2			= array("projetos_empresa" => array("where" => " projetos_empresa.inscritos_id = inscritos.id", "type" => "left"),'contato_empresa' => array('where' => 'inscritos.id = contato_empresa.inscritos_id AND contato_empresa.contato_principal = \'S\'', 'type' => 'left'));
        var $join= array('contato_empresa' => array('where' => 'inscritos.id = contato_empresa.inscritos_id AND contato_empresa.contato_principal = \'S\'', 'type' => 'left'));
	var $estados_civis  = array('S' => 'Solteiro(a)', 'C' => 'Casado(a)', 'D' => 'Divorciado(a)', 'V' => 'Viúvo(a)');
        
        
       var $ramo_atividade=array(''=>'Ramo Atividade','AGRICULTURA, PECUÁRIA, PRODUÇÃO FLORESTAL, PESCA E AQÜICULTURA'=>'AGRICULTURA, PECUÁRIA, PRODUÇÃO FLORESTAL, PESCA E AQÜICULTURA','INDÚSTRIAS EXTRATIVAS'=>'INDÚSTRIAS EXTRATIVAS','FABRICACAO DE PRODUTOS ALIMENTICIOS'=>'FABRICACAO DE PRODUTOS ALIMENTICIOS','FABRICACAO DE BEBIDAS'=>'FABRICACAO DE BEBIDAS','FABRICACAO DE PRODUTOS TÊXTIS'=>'FABRICACAO DE PRODUTOS TÊXTIS',
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
		$this->load->model("certificados_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('text_helper');
                $this->load->helper('auxiliar_helper');
                
	}

	public function empresas(){
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;                
                $offset = $this->input->get('per_page');              
		//Menu
		get_menu();
               
		//Tipo de Pessoa
                $tipo='J';
		$data['tipo'] = $tipo;
                
                               
                //Registros cidades para busca
                $data['cidades'][]='Cidade';
		$cidades = $this->default_model->get_all('inscritos', array('distinct(cidade)'),null,null, array('tipo_pessoa'=>'J','cidade !='=>''),null, array('cidade' => 'ASC'));
                
                for( $x=0;$x<count($cidades);$x++ ) {
                    $data['cidades'][$cidades[$x]->cidade]=$cidades[$x]->cidade;
                    
                }                
                
               //Registros consultores para busca
                $data['usuario'][]='Consultor';
		$usuarios = $this->default_model->get_all('usuario', array('*'),null,null, array('tipo'=>'CA','Ativo'=>'S'),null, array('nome' => 'ASC'));
                
                for( $x=0;$x<count($usuarios);$x++ ) {
                    $data['usuario'][$usuarios[$x]->id]=$usuarios[$x]->nome;
                    
                }
                
                
              // print_r($data['cidades']);
                
		$where = ($data['tipo'] ? array('inscritos.tipo_pessoa' => $data['tipo']) : NULL);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*','contato_empresa.nome as contato_principal','contato_empresa.cargo as cargo_contato','contato_empresa.email as email_contato' , 'contato_empresa.telefone as telefone_contato'),$offset, $this->per_page, $where, $this->join, array($this->table.'.ativo' => 'DESC', 'nome' => 'ASC'));

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false,$tipo);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;
               
                 $data['ramo_atividade']=  $this->ramo_atividade;
                   //Carrega view
                    $this->load->view($this->dir.'index_empresa', $data);                    
              
		get_footer(TRUE);
	}

        public function gerenciamento_contatos($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);
                
                
                
                //$join= array('inscritos' => array('where' => 'inscritos.id = area_permissoes_concedidas.inscritos_id', 'type' => 'inner'));
                
                //Busca registro dos usuarios com permissão juridica                         
                $data['cadastrados'] = $this->default_model->get_all('contato_empresa', array('*'),  NULL,null, array('inscritos_id'=>$id), null, 'nome', 'asc');
                
               // print_r($data['cadastrados']);
                
                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Tipo de Pessoa
		$data['id_empresa'] = $id;


                //Carrega view
                 $this->load->view($this->dir.'index_contatos', $data);                    
               

                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

        public function editar_contato($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id('contato_empresa', $id,array('*'),null,null,'idcontato_empresa');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
               
                //Carrega view
                $this->load->view($this->dir.'form_contatos', $data);
               


                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

        public function salvar_contato(){
		//Recebe Post
		$data = $_POST;
                //print_r($data);
                //exit();
                        
                //Trata os dados
		$data['data_nascimento'] = w3c_date($_POST['data_nascimento']);

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["idcontato_empresa"]) && $data["idcontato_empresa"])
			$rows_affected = $this->default_model->update('contato_empresa', $_POST['idcontato_empresa'], $data,'idcontato_empresa');
		else{
                    
                    $config= array(
                        'apikey' => '5d3555ad583a3b8581f88121700266c9-us7',      // Insert your api key
                        'secure' => FALSE   // Optional (defaults to FALSE)
                    );

                    $this->load->library('MCAPI', $config, 'mail_chimp');
                    
                        $Merge= array('Email'=>trim($data['email']),'Name'=>$data['nome'],'tratamento'=>trim($data['forma_de_tratamento']),'saudacao'=>trim($data['saudacao']));
                        $verify_user = $this->mail_chimp->listMemberInfo($this->listId, array(trim($data['email'])) );
			if ($verify_user['success']):
				$this->mail_chimp->listUpdateMember($this->listId, trim($data['email']),$Merge,'html',false);
			else:
				$this->mail_chimp->listSubscribe($this->listId, trim($data['email']),$Merge,'html',false);
			endif;
                    
                    
			$rows_affected = $this->default_model->insert('contato_empresa', $data);
		}

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
                
                
		redirect($this->controller.'/gerenciamento_contatos/'.$_POST['inscritos_id']);
	}

        public function adicionar_contatos($id_empresa){

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
		$data['inscritos_id'] =$id_empresa;
          
                //Carrega view
                 $this->load->view($this->dir.'form_contatos', $data);                    
               
                
		
		
		get_footer(TRUE);
	}
       
        public function excluir_contato($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id('contato_empresa', $id,array('*'),null,null,'idcontato_empresa');
		$inscritos_id = $data['registro']->inscritos_id;//empresa
                
                // essas tabelas se ralacionam com a tabela (contato_empresa)
		$this->default_model->delete('maling_selecao_email', array('contato_empresa_idcontato_empresa' => $id));
                $this->default_model->delete('brindes', array('contato_empresa_idcontato_empresa' => $id));
                    

                //Exclui registro
		if($this->default_model->delete('contato_empresa', array('idcontato_empresa' => $id)))
			$this->session->set_flashdata('msg', 'Registro desativado com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi desativado!');

		//Retorno
		redirect($this->controller.'/gerenciamento_contatos/'.$inscritos_id);
	}

        public function excluir_projeto($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id('projetos_empresa', $id,array('*'),null,null,'idprojeto_empresa');
		$inscritos_id = $data['registro']->inscritos_id;//empresa

		//Exclui registro
		if($this->default_model->delete('projetos_empresa', array('idprojeto_empresa' => $id)))
			$this->session->set_flashdata('msg', 'Registro exluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi exluído!');

		//Retorno
		redirect($this->controller.'/projeto/'.$inscritos_id);
	}

        public function editar_projeto($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id('projetos_empresa', $id,array('*'),null,null,'idprojeto_empresa');
		
                //Busca registro
		$data['logs'] = $this->default_model->get_all('log_status_projetos_empresa', array('*'),  NULL,null, array('projeto_empresa_id'=>$id), null, 'data_status', 'asc');
                        
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
                
                //Usários (para agrupamento)
		$usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                                
                $data['usuarios'] [0] = 'Selecione uma pessoa' ;
                
                foreach($usuarios as $row)
                    $data['usuarios'] [$row->id] = $row->nome ;
               
                //Carrega view
                $this->load->view($this->dir.'form_projeto', $data);
               


                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}
        
        public function salvar_projeto(){
		//Recebe Post
		$data = $_POST;
                //print_r($data);
                //exit();
                        
                //Trata os dados
		$data['data_inicio'] = w3c_date($_POST['data_inicio']);
		$data['data_termino'] = w3c_date($_POST['data_termino']);

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["idprojeto_empresa"]) && $data["idprojeto_empresa"])
                {
                        $registro = $this->default_model->get_by_id('projetos_empresa', $data['idprojeto_empresa'], array('*'), NULL, NULL, 'idprojeto_empresa');
					
                        if ($registro->status != $data['status'] )
                        {
                            $data_status["projeto_empresa_id"] = $data["idprojeto_empresa"];
                            $data_status["status"] = $registro->status;
                            $data_status["data_status"] = $registro->data_status;  
                            
                            $data['data_status'] = date('Y-m-d H:i:u');         
                            
                            $rows_affected = $this->default_model->insert('log_status_projetos_empresa', $data_status);                 
                        }     
                        
			$rows_affected = $this->default_model->update('projetos_empresa', $_POST['idprojeto_empresa'], $data,'idprojeto_empresa');
                }
		else{
                        $data['data_status'] = date('Y-m-d H:i:u');    
			$rows_affected = $this->default_model->insert('projetos_empresa', $data);
		}
                

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
                
                
		redirect($this->controller.'/projeto/'.$_POST['inscritos_id']);
	}
           
        public function adicionar_projeto($id_empresa){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar ';

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;  
                
                //Usários (para agrupamento)
		$usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                                
                $data['usuarios'] [0] = 'Selecione uma pessoa' ;
                
                foreach($usuarios as $row)
                    $data['usuarios'] [$row->id] = $row->nome ;
                    
		//Tipo de Pessoa
		$data['inscritos_id'] =$id_empresa;
                
                //Carrega view
                 $this->load->view($this->dir.'form_projeto', $data);                    
               
                
		
		
		get_footer(TRUE);
	}

        public function excluir_acao($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id('acao_prospecao', $id,array('*'),null,null,'id');
		$inscritos_id = $data['registro']->inscritos_id;//empresa

		//Exclui registro
		if($this->default_model->delete('acao_prospecao', array('id' => $id)))
			$this->session->set_flashdata('msg', 'Registro exluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi exluído!');

		//Retorno
		redirect($this->controller.'/acao/'.$inscritos_id);
	}

        public function editar_acao($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id('acao_prospecao', $id,array('*'),null,null,'id');
		
                 
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
                
                //Usários (para agrupamento)
		$usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                                
                $data['usuarios'] [0] = 'Selecione uma pessoa' ;
                
                foreach($usuarios as $row)
                    $data['usuarios'] [$row->id] = $row->nome ;
               
                //Carrega view
                $this->load->view($this->dir.'form_acao', $data);
               


                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}
        
        public function salvar_acao(){
		//Recebe Post
		$data = $_POST;
                //print_r($data);
                //exit();
                        
                //Trata os dados
		$data['data'] = w3c_date($_POST['data']);

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"])
                {                        
			$rows_affected = $this->default_model->update('acao_prospecao', $_POST['id'], $data,'id');
                }
		else{
			$rows_affected = $this->default_model->insert('acao_prospecao', $data);
		}
                

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
                
                
		redirect($this->controller.'/acao/'.$_POST['inscritos_id']);
	}
           
        public function adicionar_acao($id_empresa){

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
		$data['inscritos_id'] =$id_empresa;
                
                //Usários (para agrupamento)
		$usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                                
                $data['usuarios'] [0] = 'Selecione uma pessoa' ;
                
                foreach($usuarios as $row)
                    $data['usuarios'] [$row->id] = $row->nome ;
                
                //Carrega view
                 $this->load->view($this->dir.'form_acao', $data);                    
               
                
		
		
		get_footer(TRUE);
	}

        public function excluir_nivel($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id('nivel_satisfacao', $id,array('*'),null,null,'id');
		$inscritos_id = $data['registro']->inscritos_id;//empresa

		//Exclui registro
		if($this->default_model->delete('nivel_satisfacao', array('id' => $id)))
			$this->session->set_flashdata('msg', 'Registro exluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi exluído!');

		//Retorno
		redirect($this->controller.'/nivel/'.$inscritos_id);
	}

        public function editar_nivel($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id('nivel_satisfacao', $id,array('*'),null,null,'id');
		
                 
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
               
                //Carrega view
                $this->load->view($this->dir.'form_nivel', $data);
               


                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}
        
        public function salvar_nivel(){
		//Recebe Post
		$data = $_POST;
                //print_r($data);
                //exit();
                        
                //Trata os dados
		$data['data_acao'] = w3c_date($_POST['data_acao']);

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"])
                {                        
			$rows_affected = $this->default_model->update('nivel_satisfacao', $_POST['id'], $data,'id');
                }
		else{
			$rows_affected = $this->default_model->insert('nivel_satisfacao', $data);
		}
                

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
                
                
		redirect($this->controller.'/nivel/'.$_POST['inscritos_id']);
	}
           
        public function adicionar_nivel($id_empresa){

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
		$data['inscritos_id'] =$id_empresa;
                
                //Carrega view
                 $this->load->view($this->dir.'form_nivel', $data);                    
               
                
		
		
		get_footer(TRUE);
	}

        public function excluir_folowups($id) {

        //Tipo de Curso
        $data['registro'] = $this->default_model->get_by_id('folowups', $id, array('*'), null, null, 'id');
        $proposta_id = $data['registro']->proposta_id; //empresa
        //Exclui registro
        if ($this->default_model->delete('folowups', array('id' => $id)))
            $this->session->set_flashdata('msg', 'Registro exluído com sucesso!');
        else
            $this->session->set_flashdata('msg', 'Registro não foi exluído!');

        //Retorno
        redirect($this->controller . '/folowups/' . $proposta_id);
    }

        public function editar_folowups($id) {

        //Cabeçalho
        $titulo = $this->titulo;
        get_header($titulo, TRUE);
        $data['h1'] = 'Editar ';

        //Menu
        get_menu();

        //Busca registro
        $data['registro'] = $this->default_model->get_by_id('folowups', $id, array('*'), null, null, 'id');       
                        
        //Tipo de Pessoa
        $data['proposta_id'] = $data['registro']->proposta_id;
        
        
        //Busca registro
        $proposta = $this->default_model->get_by_id('proposta', $data['registro']->proposta_id);

        //Parâmetros
        $data['controller'] = $this->controller;
        $data['title_sing'] = $this->title_sing;
                
                //Usários (para agrupamento)
		$usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                                
                $data['usuarios'] [0] = 'Selecione uma pessoa' ;
                
                foreach($usuarios as $row)
                    $data['usuarios'] [$row->id] = $row->nome ;
                
                //Contatos
		$contatos = $this->default_model->get_by_search_All('contato_empresa','idcontato_empresa,nome', null , null , null,  ' inscritos_id = '.$proposta->inscritos_id, null, 'nome', 'asc');
                                
                $data['contatos'] [0] = 'Selecione um contato' ;
                
                foreach($contatos as $row)
                    $data['contatos'] [$row->idcontato_empresa] = $row->nome ;

        //Carrega view
        $this->load->view($this->dir . 'form_folowups', $data);



        //Carrega view
        //$this->load->view($this->dir.'form', $data);
        get_footer(TRUE);
    }

        public function salvar_folowups() {
        //Recebe Post
        $data = $_POST;
        //print_r($data);
        //exit();
        //Trata os dados
        
        $data['data_acao'] = w3c_date($_POST['data_acao']);

        //Salva so dados (Verificando se é edição ou inserção)
        if (isset($_POST["id"]) && $data["id"]) {
            $rows_affected = $this->default_model->update('folowups', $_POST['id'], $data, 'id');
        } else {
            $rows_affected = $this->default_model->insert('folowups', $data);
        }


        //Mensagem de retorno
        if ($rows_affected == 1)
            $msg = 'Dados salvos com sucesso.';
        else
            $msg = 'Não foi possível salvar os dados.';

        //Retorno
        $this->session->set_flashdata('msg', $msg);


        redirect($this->controller . '/folowups/' . $_POST['proposta_id']);
    }

        public function adicionar_folowups($id_proposta) {

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
            $data['proposta_id'] = $id_proposta;
            
            
            //Busca registro
            $proposta = $this->default_model->get_by_id('proposta', $id_proposta);
                
            //Usários (para agrupamento)
            $usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');

            $data['usuarios'] [0] = 'Selecione uma pessoa' ;

            foreach($usuarios as $row)
                $data['usuarios'] [$row->id] = $row->nome ;
            
                //Contatos
		$contatos = $this->default_model->get_by_search_All('contato_empresa','idcontato_empresa,nome', null , null , null,  ' inscritos_id = '.$proposta->inscritos_id, null, 'nome', 'asc');
                                
                $data['contatos'] [0] = 'Selecione um contato' ;
                
                foreach($contatos as $row)
                    $data['contatos'] [$row->idcontato_empresa] = $row->nome ;

            //Carrega view
            $this->load->view($this->dir . 'form_folowups', $data);




            get_footer(TRUE);
        }
               
        public function excluir_proposta($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id('proposta', $id,array('*'),null,null,'id');
		$inscritos_id = $data['registro']->inscritos_id;//empresa

		//Exclui registro
		if($this->default_model->delete('proposta', array('id' => $id)))
			$this->session->set_flashdata('msg', 'Registro exluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi exluído!');

		//Retorno
		redirect($this->controller.'/proposta/'.$inscritos_id);
	}

        public function editar_proposta($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id('proposta', $id,array('*'),null,null,'id');    
                
                
		//Busca registro
		$data['logs'] = $this->default_model->get_all('log_status_proposta', array('*'),  NULL,null, array('proposta_id'=>$id), null, 'data_status', 'asc');
                                
                //Tipo de Pessoa
                $data['id_empresa'] = $data['registro']->inscritos_id;
                
                //Usários (para agrupamento)
		$usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                                
                $data['usuarios'] [0] = 'Selecione uma pessoa' ;
                
                foreach($usuarios as $row)
                    $data['usuarios'] [$row->id] = $row->nome ;

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
               
                //Carrega view
                $this->load->view($this->dir.'form_proposta', $data);
               


                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

        public function salvar_proposta(){
		//Recebe Post	
            
		//Recebe Post
		$data = $_POST;

		//Library de Upload
		$config['upload_path']   = './assets/uploads/propostas/';
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
                
                //Trata os dados
		$data['data_solicitacao'] = w3c_date($_POST['data_solicitacao']);
		$data['data_programada_apresentacao'] = w3c_date($_POST['data_programada_apresentacao']);
		$data['data_apresentacao'] = w3c_date($_POST['data_apresentacao']);  
                $data['valor_inicial'] = numero_pt_para_mysql($_POST['valor_inicial']);  
                $data['valor_fechado'] = numero_pt_para_mysql($_POST['valor_fechado']);  
                
                
                
		//Upload do Relatório
		if(!empty($_FILES['arquivo_proposta']['name'])){
			if($this->upload->do_upload('arquivo_proposta')){

				if(isset($data["id"]) && $data["id"]){
					$registro = $this->default_model->get_by_id('proposta', $data['id'], array('*'), NULL, NULL, 'id');
					@unlink('./assets/uploads/propostas/'.$registro->arquivo_proposta);
				}
                                
				$data_file = $this->upload->data();
				$data['arquivo_proposta'] = $data_file['file_name'];
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());
				redirect($this->controller);
			}
		}
                

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"]) {
                        $registro = $this->default_model->get_by_id('proposta', $data['id'], array('*'), NULL, NULL, 'id');
					
                        if ($registro->status != $data['status'] )
                        {
                            $data_status["proposta_id"] = $registro->id;
                            $data_status["status"] = $registro->status;
                            $data_status["data_status"] = $registro->data_status;  
                            
                            $data['data_status'] = date('Y-m-d H:i:u');         
                            
                            $rows_affected = $this->default_model->insert('log_status_proposta', $data_status);                 
                        }                            
                            
			$rows_affected = $this->default_model->update('proposta', $_POST['id'], $data,'id');
                    
                }
		else{
                        $data['data_status'] = date('Y-m-d H:i:u');
			$rows_affected = $this->default_model->insert('proposta', $data);
		}

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
                
                
		redirect($this->controller.'/proposta/'.$_POST['inscritos_id']);
	}

        public function adicionar_proposta($id){ 
          
          
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Busca registro
		//$data['registros'] = $this->default_model->get_by_id('proposta', $id,array('*'),null,null,'inscritos_id');
                
                $data['id_empresa']=$id;
                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
                
                //Usários (para agrupamento)
		$usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                                
                $data['usuarios'] [0] = 'Selecione uma pessoa' ;
                
                foreach($usuarios as $row)
                    $data['usuarios'] [$row->id] = $row->nome ;
               
                //Carrega view
                $this->load->view($this->dir.'form_proposta', $data);
               


                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
          
      }     

        public function folowups($id){ 
          
          
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id('proposta', $id,array('*'),null,null,'id');

		//Busca registro
		$data['cadastrados'] = $this->default_model->get_all('folowups', array('*'),  NULL,null, array('proposta_id'=>$id), null, 'data_acao', 'asc');
                
                
                $data['id_proposta'] = $id;
                $data['id_empresa'] = $data['registro']->inscritos_id;
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
                
                
                //Usuários
		$usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                                
                $data['usuarios'] [0] = 'Nenhuma pessoa cadastrada' ;
                
                foreach($usuarios as $row)
                    $data['usuarios'] [$row->id] = $row->nome ;               
                
                
                //Contatos
		$contatos = $this->default_model->get_by_search_All('contato_empresa','idcontato_empresa,nome', null , null , null,  ' inscritos_id = '.$data['registro']->inscritos_id, null, 'nome', 'asc');
                                                
                $data['contatos'] [0] = 'Nenhum contato cadastrado' ;
                
                foreach($contatos as $row)
                    $data['contatos'] [$row->idcontato_empresa] = $row->nome ;
                
               
                //Carrega view
                $this->load->view($this->dir.'index_folowups', $data);
               


                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
          
      }

        public function proposta($id){ 
          
          
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);

		//Busca registro
		$data['cadastrados'] = $this->default_model->get_all('proposta', array('*'),  NULL,null, array('inscritos_id'=>$id), null, 'nome', 'asc');
                
                
                $data['id_empresa']=$id;
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
               
                //Carrega view
                $this->load->view($this->dir.'index_proposta', $data);
               


                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
          
      }
  
        public function brindes($id){ 
          
          
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id('contato_empresa', $id ,array('*'),null,null,'idcontato_empresa');  
                                    
                $data['id_empresa'] = $data['registro']->inscritos_id;
                
		//Busca registro
		$data['cadastrados'] = $this->default_model->get_all('brindes', array('*'),  NULL,null, array('contato_empresa_idcontato_empresa'=>$id), null, 'data_envio', 'desc');
                
                
                $data['id_brinde']=$id;
              
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
               
                //Carrega view
                $this->load->view($this->dir.'index_brinde', $data);
               

		get_footer(TRUE);
          
      }
      
        public function adicionar_brinde($id){ 
          
          
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

                $data['id_empresa']=$id;
                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
               
                //Carrega view
                $this->load->view($this->dir.'form_brinde', $data);
               

		get_footer(TRUE);
          
      } 

        public function editar_brinde($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id('brindes', $id ,array('*'),null,null,'id');    
                
                
		        
                //Tipo de Pessoa
                $data['id_contato'] = $data['registro']->contato_empresa_idcontato_empresa;

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;
               
                //Carrega view
                $this->load->view($this->dir.'form_brinde', $data);
               


                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

        public function salvar_brinde(){
		//Recebe Post
		$data = $_POST;
                
                  $data['data_envio']=  ing_date($data['data_envio']);

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"]){
                      
			$rows_affected = $this->default_model->update('brindes', $_POST['id'], $data, 'id');
                }else{
			$rows_affected = $this->default_model->insert('brindes', $data);
		}

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller.'/brindes/'.$data['contato_empresa_idcontato_empresa']);
	}
                       
        public function excluir_brinde($id){

		//Tipo de Curso
		$data['registro'] = $this->default_model->get_by_id('brindes', $id,array('*'),null,null,'id');
		$inscritos_id = $data['registro']->contato_empresa_idcontato_empresa; // contato da empresa

		//Exclui registro
		if($this->default_model->delete('brindes', array('id' => $id)))
			$this->session->set_flashdata('msg', 'Registro exluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi exluído!');

		//Retorno
		redirect($this->controller.'/brindes/'.$inscritos_id);
	}
    
        public function projeto($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);
                
                
                
                //$join= array('inscritos' => array('where' => 'inscritos.id = area_permissoes_concedidas.inscritos_id', 'type' => 'inner'));
                
                //Busca registro dos usuarios com permissão juridica                         
                $data['cadastrados'] = $this->default_model->get_all('projetos_empresa', array('*'),  NULL,null, array('inscritos_id'=>$id), null, 'nome', 'asc');
                
               //print_r($data['cadastrados']);
                
                //Usuários
		$usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                                
                $data['usuarios'] [0] = 'Nenhuma uma pessoa' ;
                
                foreach($usuarios as $row)
                    $data['usuarios'] [$row->id] = $row->nome ;
 
                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Tipo de Pessoa
		$data['id_empresa'] = $id;
                
                //Carrega view
                 $this->load->view($this->dir.'index_projeto', $data);                    
               

                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}
   
        public function acao($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);
                
                
                
                //$join= array('inscritos' => array('where' => 'inscritos.id = area_permissoes_concedidas.inscritos_id', 'type' => 'inner'));
                
                //Busca registro dos usuarios com permissão juridica                         
                $data['cadastrados'] = $this->default_model->get_all('acao_prospecao', array('*'),  NULL,null, array('inscritos_id'=>$id), null, 'data', 'asc');
                
               //print_r($data['cadastrados']);
                
                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Tipo de Pessoa
		$data['id_empresa'] = $id;
                
                //Usuários
		$usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                                
                $data['usuarios'] [0] = 'Nenhuma uma pessoa' ;
                
                foreach($usuarios as $row)
                    $data['usuarios'] [$row->id] = $row->nome ;
                
                //Carrega view
                 $this->load->view($this->dir.'index_acao', $data);                    
               

                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}
   
        public function nivel($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar ';

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);
                
                
                
                //$join= array('inscritos' => array('where' => 'inscritos.id = area_permissoes_concedidas.inscritos_id', 'type' => 'inner'));
                
                //Busca registro dos usuarios com permissão juridica                         
                $data['cadastrados'] = $this->default_model->get_all('nivel_satisfacao', array('*'),  NULL,null, array('inscritos_id'=>$id), null, 'data_acao', 'asc');
                
               //print_r($data['cadastrados']);
                
                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Tipo de Pessoa
		$data['id_empresa'] = $id;
                
                //Carrega view
                 $this->load->view($this->dir.'index_nivel', $data);                    
               

                //Carrega view
		//$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

        private function _pagination($table, $search = FALSE, $where){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';
               
                $config['page_query_string'] = TRUE;
		//Parâmetro
		if($search){
                    
                        $join=  $this->join;
                        if(isset($search['projetos_empresa.tipo'])){
                            $join=  $this->join2;
                        }
                        if(isset($search['projetos_empresa.id_usuario_consultor_responsavel'])){
                            $join=  $this->join2;
                        }
                        
                        
                        
                        
                        
                        
			//$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s');
		}
		else{
                        $where = (array('inscritos.tipo_pessoa' =>'J'));
			$config['uri_segment'] = 4;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);                        
			$config['base_url']    = base_url().$this->controller.'/empresas/?';
                        
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
                
                
                
                //Registros cidades para busca
                $data['cidades'][]='Cidade';
		$cidades = $this->default_model->get_all('inscritos', array('distinct(cidade)'),null,null, array('tipo_pessoa'=>'J','cidade !='=>''),null, array('cidade' => 'ASC'));
                
                for( $x=0;$x<count($cidades);$x++ ) {
                    $data['cidades'][$cidades[$x]->cidade]=$cidades[$x]->cidade;
                    
                }                
                
               //Registros consultores para busca
                $data['usuario'][]='Consultor';
		$usuarios = $this->default_model->get_all('usuario', array('*'),null,null, array('tipo'=>'CA','Ativo'=>'S'),null, array('nome' => 'ASC'));
                
                for( $x=0;$x<count($usuarios);$x++ ) {
                    $data['usuario'][$usuarios[$x]->id]=$usuarios[$x]->nome;
                    
                }
                // este array mantem o resultado dos forms da busca
                $data['retorno_get']=$this->input->get();
                
                //print_r($data['retorno_get']);
		//Parâmetros de busca
                
                    if($this->input->get('nome')!=''){
                        $data_busca[$this->table.'.nome']  = $this->input->get('s');		
                        $data_busca[$this->table.'.razao_social']  = $this->input->get('s');
                    }
               
                
                if($this->input->get('atuacao_empresa')!='')                   
                    $data_busca[$this->table.'.atuacao_empresa'] = $this->input->get('atuacao_empresa');
                
                
                 if($this->input->get('segmento_empresa')!='')                   
                    $data_busca[$this->table.'.segmento_empresa'] = $this->input->get('segmento_empresa');
                    
                if($this->input->get('cidade')!='' && $this->input->get('cidade')>0 )                    
                   $data_busca[$this->table.'.cidade'] = $this->input->get('cidade');
                    
                
                if($this->input->get('categoria')!=''){
                    if($this->input->get('categoria')=='C'){
                       $data_busca[$this->table.'.cliente'] = 'S';
                    }
                   if($this->input->get('categoria')=='P'){
                        $data_busca[$this->table.'.prospect'] = 'S';
                    }
                }
                
                $join=$this->join;
                if($this->input->get('tipo')!=''){
                    $join=  $this->join2;
                     $data_busca['projetos_empresa.tipo'] = $this->input->get('tipo');                    
                }  
                
                if($this->input->get('id_usuario_consultor_responsavel')!=''){
                    $join=  $this->join2;
                     $data_busca['projetos_empresa.id_usuario_consultor_responsavel'] = $this->input->get('id_usuario_consultor_responsavel');                    
                }  
                
                if($this->input->get('classificacao')!='')                     
                    $data_busca[$this->table.'.classificacao'] = $this->input->get('classificacao');
		
                $data['where']['tipo_pessoa'] = 'J';
               
             if (!isset($data_busca))
               $data_busca[$this->table.'.nome']  = '';
            
                  
                
                
                $offset = $this->input->get('per_page');              
		$data['registros'] = $this->default_model->get_by_search_distinct($this->table, array($this->table.'.*','contato_empresa.nome as contato_principal','contato_empresa.cargo as cargo_contato','contato_empresa.email as email_contato' , 'contato_empresa.telefone as telefone_contato'), $data['where'], $offset, $this->per_page, $data_busca,$join, $this->table.'.id', 'DESC');
		$data['paginacao'] = $this->_pagination($this->table,$data_busca,$data['where']);
                                
		
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		$data['ramo_atividade']=  $this->ramo_atividade;               
                //Carrega view
                 $this->load->view($this->dir.'index_empresa', $data);                    
         
                                
		get_footer(TRUE);
	}
        
        public function enviar_lembrete() {


            $this->db->select('nome,email');
            $this->db->from('usuario');
            $this->db->where(array('tipo' => 'A', 'Ativo' => 'S'));
            $query1 = $this->db->get();


            $query = "  select * ";
            $query.=" from vw_acoes_programadas";
            $query.=" where cast(ADDDATE(now(), 7) as date)  >=  vw_acoes_programadas.data";
            $query.=" and tipo in('Data especial','Aniversário')";

            $result = $this->db->query($query);
            $data['lembretes'] = $result->result();


            //carrega library de email
            $this->load->library('email');
            if ($result->num_rows > 0) {
                //Conteúdo do e-mail
                $conteudo = $this->load->view($this->dir.'email_lembrete', $data, true);
                //print_r($conteudo);
               // exit();
                if ($query1->num_rows > 0) {
                    $email_mb = $query1->result();
                    $x = 0;
                    $email = '';
                    foreach ($email_mb as $item) {
                        if ($x > 0) {
                            $email.=",";
                        }
                        $email.=$item->email;
                        $x+=1;
                    }

                    $config['protocol'] = 'mail';
                    $config['mailtype'] = 'html';

                    //Parâmetros
                    $this->email->initialize($config);
                    //$this->email->clear();
                    $this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
                    //$this->email->to($item->email,$item->nome);                                    
                    $this->email->to($email);
                    $this->email->subject($email);
                    $this->email->message($conteudo);
                    $this->email->send();
                }
            }
            print_r("<h1> E-mail enviado com sucesso! </h1>");
        }
        
        
        

}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */