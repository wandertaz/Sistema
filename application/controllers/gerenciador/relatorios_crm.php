<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class relatorios_crm extends CI_Controller {

	var $titulo 		= 'CRM';
	var $dir                = 'multitools/relatorios_crm/';
	var $controller 	= 'multitools/relatorios_crm';
	var $title_sing 	= 'CRM';
        
        var $segmento = array('' => 'Todos Segmentos','Indústria' => 'Indústria', 'Comércio' => 'Comércio','Serviços'=>'Serviços','Construção Civil'=>'Construção Civil','Gestão Pública'=>'Gestão Pública');
        var $classificacao = array('' => 'Todas Classificações','A'=>'A','B'=>'B','C'=>'C');
        var $ramo_atividade=array(''=>'Todos Ramos de Atividade','AGRICULTURA, PECUÁRIA, PRODUÇÃO FLORESTAL, PESCA E AQÜICULTURA'=>'AGRICULTURA, PECUÁRIA, PRODUÇÃO FLORESTAL, PESCA E AQÜICULTURA','INDÚSTRIAS EXTRATIVAS'=>'INDÚSTRIAS EXTRATIVAS','FABRICACAO DE PRODUTOS ALIMENTICIOS'=>'FABRICACAO DE PRODUTOS ALIMENTICIOS','FABRICACAO DE BEBIDAS'=>'FABRICACAO DE BEBIDAS','FABRICACAO DE PRODUTOS TÊXTIS'=>'FABRICACAO DE PRODUTOS TÊXTIS',
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
        
        var $tipo = array(''=>'Selecione um tipo', 'GP' => 'Gestão de Pessoas', 'GC' => 'Governança Corporativa', 'PR' => 'Processos', 'ES' => 'Estratégia', 'EC' => 'Educação Corporativa');
        var $classificacao_proposta = array(''=>'Selecione uma classificação', 'D' => 'Diamante', 'O' => 'Ouro', 'P' => 'Prata', 'B' => 'Bronze');
        var $status_proposta = array(''=>'Selecione um status','EM' => 'Em aberto', 'NA' => 'Não apresentada', 'NE' => 'Negativada', 'FE' => 'Fechada');
        var $status_projeto = array(''=>'Selecione um status','A' => 'Em andamento', 'P' => 'Paralisado', 'F' => 'Finalizado');
        var $status_acao = array(''=>'Selecione um status','CO' => 'Concluído', 'AN' => 'Andamento', 'CA' => 'Cancelado', 'PA' => 'Paralisado', 'PR' => 'Programado');
        var $prioridade = array(''=>'Selecione uma prioridade','1' => '1', '2' => '2', '3' => '3');
        var $tipo_acao = array(''=>'Selecione um tipo','R' => 'Reativa', 'P' => 'Proativa');
        var $nivel = array(''=>'Selecione um nível', 'SA' => 'Satisfeito', 'IS' => 'Insatisfeito', 'NE' => 'Neutro', 'MA' => 'Não Manifestou');
         
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
		//Menu
		get_menu();
                
		$data['title_sing'] = 'Relatório de empresas';                
		$data['controller']  = $this->controller;                
                $data['registros'] = null;               
                $data['ramo_atividade']=  $this->ramo_atividade;  
                $data['segmento']=  $this->segmento;  
                $data['classificacao']=  $this->classificacao;  
                
                $this->load->view($this->dir.'empresa', $data);                    
              
		get_footer(TRUE);
	}

	public function contatos(){
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;           
		//Menu
		get_menu();
                
		$data['title_sing'] = 'Relatório de contatos';                
		$data['controller']  = $this->controller;                
                $data['registros'] = null; 
                
                $this->load->view($this->dir.'contatos', $data);                    
              
		get_footer(TRUE);
	}

	public function proposta(){
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;           
		//Menu
		get_menu();
                
                $usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                $data['colaborador'][''] = "Selecione um colaborador";
                
                foreach($usuarios as $row)
                    $data['colaborador'] [$row->id] = $row->nome ;
                
		$data['title_sing'] = 'Relatório de Proposta';        
		$data['classificacao']  = $this->classificacao_proposta;  
		$data['tipo']  = $this->tipo; 
		$data['status']  = $this->status_proposta; 
                $data['controller']  = $this->controller;                     
                $data['registros'] = null; 
                
                $this->load->view($this->dir.'proposta', $data);                    
              
		get_footer(TRUE);
	}

	public function projetos(){
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;           
		//Menu
		get_menu();
                
                $usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                $data['colaborador'][''] = "Selecione um colaborador";
                
                foreach($usuarios as $row)
                    $data['colaborador'] [$row->id] = $row->nome ;
                
		$data['title_sing'] = 'Relatório de Projeto';        
		$data['tipo']  = $this->tipo; 
		$data['status']  = $this->status_projeto; 
                $data['controller']  = $this->controller;                     
                $data['registros'] = null; 
                
                $this->load->view($this->dir.'projeto', $data);                    
              
		get_footer(TRUE);
	}

	public function nivel(){
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;           
		//Menu
		get_menu();
                                
		$data['title_sing'] = 'Relatório de Nível de Satisfação';        
		$data['nivel']  = $this->nivel;
                $data['controller']  = $this->controller;                     
                $data['registros'] = null; 
                
                $this->load->view($this->dir.'nivel', $data);                    
              
		get_footer(TRUE);
	}
        
	public function acoes(){
		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;           
		//Menu
		get_menu();
                
                $usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                $data['colaborador'][''] = "Selecione um colaborador";
                
                foreach($usuarios as $row)
                    $data['colaborador'] [$row->id] = $row->nome ;
                
		$data['title_sing'] = 'Relatório de Ação de Prospecção';        
		$data['tipo']  = $this->tipo_acao; 
		$data['status']  = $this->status_acao; 
                $data['prioridade']  = $this->prioridade; 
                $data['controller']  = $this->controller;                     
                $data['registros'] = null; 
                
                $this->load->view($this->dir.'acao', $data);                    
              
		get_footer(TRUE);
	}

	public function buscar_empresa(){

		//Cabeçalho
		$titulo = $this->titulo;
                
                if( !$this->input->get('pdf'))
                    get_header($titulo, TRUE);
                
		$data['h1'] = $this->titulo;    
                $data['ramo_atividade']=  $this->ramo_atividade;   
                $data['segmento']=  $this->segmento;  
                $data['classificacao']=  $this->classificacao;    
                
		//Menu
		if( !$this->input->get('pdf'))
                    get_menu();
                
		//Tipo de Pessoa
                $tipo='J';
		$data['tipo'] = $tipo;
                
                // este array mantem o resultado dos forms da busca
                $data['retorno_get']=$this->input->get();
                
                //print_r($data['retorno_get']);
		//Parâmetros de busca
                
                if($this->input->get('origem')!='')
                    $data_busca['inscritos'.'.origem_cadastro']  = $this->input->get('origem');               
                
                if($this->input->get('atuacao_empresa')!='')                   
                    $data_busca['inscritos'.'.atuacao_empresa'] = $this->input->get('atuacao_empresa');                
                
                 if($this->input->get('segmento_empresa')!='')                   
                    $data_busca['inscritos'.'.segmento_empresa'] = $this->input->get('segmento_empresa');                
                
                 if($this->input->get('prospect')!='')                   
                    $data_busca['inscritos'.'.prospect'] = $this->input->get('prospect');                
                
                 if($this->input->get('cliente')!='')                   
                    $data_busca['inscritos'.'.cliente'] = $this->input->get('cliente');               
                
                if($this->input->get('classificacao')!='')                     
                    $data_busca['inscritos'.'.classificacao'] = $this->input->get('classificacao');
                		
                $data['where']['inscritos'.'.tipo_pessoa'] = 'J';
               
                if (!isset($data_busca))
                  $data_busca['inscritos'.'.nome']  = '';
                
                $offset = null;        
		$data['registros'] = $this->default_model->get_by_search('inscritos', array('inscritos'.'.*'), $data['where'], $offset, null, $data_busca,null, 'inscritos'.'.razao_social', 'ASC');
		            
		
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = 'Relatório de Empresas';

		    
                if( $this->input->get('pdf')) {
                    //helpers
                    $this->load->helper(array('dompdf', 'file'));

                    //recebe html da view
                    $html = $this->load->view($this->dir.'empresa_pdf', $data, true);
                    //print_r($html);
                    //exit();

                    //Cria pdf
                    pdf_create($html, 'MB CONSULTORIA - '.$data['title_sing']);
                }
                else {
                    //Carrega view
                     $this->load->view($this->dir.'empresa', $data);  
                }
                 
         
                if( !$this->input->get('pdf'))                
                    get_footer(TRUE);
	}

	public function buscar_contatos(){

		//Cabeçalho
		$titulo = $this->titulo;
		if( !$this->input->get('pdf'))
                    get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;     
                
		//Menu
		if( !$this->input->get('pdf'))
                    get_menu();
                
                // este array mantem o resultado dos forms da busca
                $data['retorno_get']=$this->input->get();
                
                //print_r($data['retorno_get']);
		//Parâmetros de busca
                
                if($this->input->get('data')!='') {                    
                    $mes = substr($this->input->get('data'),3,2);
                    $dia = substr($this->input->get('data'),0,2);                
                    $data_pesquisa= date('Y').'-'.$mes."-".$dia;                
                    $data_busca['vw_aniversario'.'.data_busca']  = $data_pesquisa;      
                }
                
                if($this->input->get('brinde')!='')                   
                    $data_busca['vw_contato_empresa_brindes'.'.brinde'] = $this->input->get('brinde');
                		
                $data['where'] = null;
               
                if (!isset($data_busca))
                  $data_busca['inscritos'.'.nome']  = '';
                
                
                
                
                $offset = null;        
                $join = array("vw_contato_empresa_brindes" => array("where" => " contato_empresa.idcontato_empresa = vw_contato_empresa_brindes.idcontato_empresa", "type" => "left"),"vw_aniversario" => array("where" => " contato_empresa.idcontato_empresa = vw_aniversario.idcontato_empresa", "type" => "inner"),"inscritos" => array("where" => " contato_empresa.inscritos_id = inscritos.id", "type" => "inner"));
                
                $data['registros'] = $this->default_model->get_by_search('contato_empresa', array('contato_empresa'.'.*','vw_contato_empresa_brindes.brinde','inscritos.razao_social'), $data['where'], $offset, null, $data_busca,$join, 'contato_empresa'.'.nome', 'DESC');
		           
		
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = 'Relatório de contatos';

		                  
                if( $this->input->get('pdf')) {
                    //helpers
                    $this->load->helper(array('dompdf', 'file'));

                    //recebe html da view
                    $html = $this->load->view($this->dir.'contatos_pdf', $data, true);
                    //print_r($html);
                    //exit();

                    //Cria pdf
                    pdf_create($html, 'MB CONSULTORIA - '.$data['title_sing']);
                }
                else {
                    //Carrega view
                     $this->load->view($this->dir.'contatos', $data);  
                }                  
         
                                
		if( !$this->input->get('pdf'))
                    get_footer(TRUE);
	}

	public function buscar_proposta(){
		//Cabeçalho
		$titulo = $this->titulo;
		if( !$this->input->get('pdf'))
                    get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;           
		//Menu
		if( !$this->input->get('pdf'))
                    get_menu();
                
                $usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                $data['colaborador'][''] = "Selecione um colaborador";
                
                foreach($usuarios as $row)
                    $data['colaborador'] [$row->id] = $row->nome ;
                
                
                // este array mantem o resultado dos forms da busca
                $data['retorno_get']=$this->input->get();
                
                //print_r($data['retorno_get']);
		//Parâmetros de busca
                		
                $where = ' 1 = 1 ';
                
                
                if($this->input->get('tipo')!='')                    
                   $where .= " AND ( tipo = '".$this->input->get('tipo')."' ) " ; 
                
                if($this->input->get('classificacao')!='')                   
                    $where .= " AND ( classificacao = '".$this->input->get('classificacao')."' ) ";                
                
                if($this->input->get('data_solicitacao_de')!='') {               
                    $data_pesquisa= w3c_date($this->input->get('data_solicitacao_de'));    
                    
                    $where .= " AND ( data_solicitacao >= '".$data_pesquisa."' ) ";
                }
                
                if($this->input->get('data_solicitacao_ate')!='') {               
                    $data_pesquisa= w3c_date($this->input->get('data_solicitacao_ate')); 
                    
                    $where .= " AND ( data_solicitacao <= '".$data_pesquisa."' ) ";   
                }
                
                if($this->input->get('data_apresentacao_de')!='') {               
                    $data_pesquisa= w3c_date($this->input->get('data_apresentacao_de'));
                    
                    $where .= " AND ( data_apresentacao >= '".$data_pesquisa."' ) ";   
                }
                
                if($this->input->get('data_apresentacao_ate')!='') {               
                    $data_pesquisa= w3c_date($this->input->get('data_apresentacao_ate'));
                    
                    $where .= " AND ( data_apresentacao <= '".$data_pesquisa."' ) " ;   
                }
                
                if($this->input->get('diaginostico')!='')
                    $where .= " AND ( id_usuario_responsavel_diagnostico = '".$this->input->get('diaginostico')."' ) ";
                
                if($this->input->get('apresentacao')!='')
                    $where .= " AND ( id_usuario_responsavel_apresentacao = '".$this->input->get('apresentacao')."' ) ";                
                
                if($this->input->get('valor_inicial_de')!='')
                    $where .= " AND ( valor_inicial >= ".numero_pt_para_mysql($this->input->get('valor_inicial_de'))." ) ";
                
                if($this->input->get('valor_inicial_ate')!='')
                    $where .= " AND ( valor_inicial <=  ".numero_pt_para_mysql($this->input->get('valor_inicial_ate'))." ) ";
                
                if($this->input->get('valor_fechado_de')!='')                    
                    $where .= " AND ( valor_fechado >= ".numero_pt_para_mysql($this->input->get('valor_fechado_de'))." ) ";
                
                if($this->input->get('valor_fechado_ate')!='')                    
                    $where .= " AND ( valor_fechado <= ".numero_pt_para_mysql($this->input->get('valor_fechado_ate'))." ) ";
                
                if($this->input->get('status')!='')                   
                    $where .= " AND ( status = '".$this->input->get('status')."' ) ";  
                
                
                $Sql="SELECT proposta.*,inscritos.razao_social FROM proposta INNER JOIN inscritos ON proposta.inscritos_id = inscritos.id WHERE ".$where." ORDER BY proposta.n_proposta DESC";
                
                $result = $this->db->query($Sql);
                $data['registros'] = $result->result();
                
		$data['title_sing'] = 'Relatório de Proposta';        
		$data['classificacao']  = $this->classificacao_proposta;  
		$data['tipo']  = $this->tipo; 
		$data['status']  = $this->status_proposta; 
                $data['controller']  = $this->controller;  
                
                if( $this->input->get('pdf')) {
                    //helpers
                    $this->load->helper(array('dompdf', 'file'));

                    //recebe html da view
                    $html = $this->load->view($this->dir.'proposta_pdf', $data, true);
                    //print_r($html);
                    //exit();

                    //Cria pdf
                    pdf_create($html, 'MB CONSULTORIA - '.$data['title_sing']);
                }
                else {
                    //Carrega view
                     $this->load->view($this->dir.'proposta', $data);  
                }                   
              
		if( !$this->input->get('pdf'))
                    get_footer(TRUE);
	}

	public function buscar_projeto(){
		//Cabeçalho
		$titulo = $this->titulo;
		if( !$this->input->get('pdf'))
                    get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;           
		//Menu
		if( !$this->input->get('pdf'))
                    get_menu();
                
                $usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                $data['colaborador'][''] = "Selecione um colaborador";
                
                foreach($usuarios as $row)
                    $data['colaborador'] [$row->id] = $row->nome ;
                
                
                // este array mantem o resultado dos forms da busca
                $data['retorno_get']=$this->input->get();
                
                //print_r($data['retorno_get']);
		//Parâmetros de busca
                		
                $where = ' 1 = 1 ';
                
                if($this->input->get('nome')!='')                    
                   $where .= " AND ( nome LIKE '%".$this->input->get('nome')."%' ) " ; 
                
                if($this->input->get('tipo')!='')                    
                   $where .= " AND ( tipo = '".$this->input->get('tipo')."' ) " ; 
                
                if($this->input->get('classificacao')!='')                   
                    $where .= " AND ( classificacao = '".$this->input->get('classificacao')."' ) ";
                
                
                if($this->input->get('data_inicio_de')!='') {               
                    $data_pesquisa= w3c_date($this->input->get('data_inicio_de'));    
                    
                    $where .= " AND ( data_inicio >= '".$data_pesquisa."' ) ";
                }
                
                if($this->input->get('data_inicio_ate')!='') {               
                    $data_pesquisa= w3c_date($this->input->get('data_inicio_ate')); 
                    
                    $where .= " AND ( data_inicio <= '".$data_pesquisa."' ) ";   
                }
                
                if($this->input->get('data_termino_de')!='') {               
                    $data_pesquisa= w3c_date($this->input->get('data_termino_de'));
                    
                    $where .= " AND ( data_termino >= '".$data_pesquisa."' ) ";   
                }
                
                if($this->input->get('data_termino_ate')!='') {               
                    $data_pesquisa= w3c_date($this->input->get('data_termino_ate'));
                    
                    $where .= " AND ( data_termino <= '".$data_pesquisa."' ) " ;   
                }
                
                if($this->input->get('status')!='')                   
                    $where .= " AND ( status = '".$this->input->get('status')."' ) "; 
                
                
                $Sql="SELECT projetos_empresa.*,inscritos.razao_social FROM projetos_empresa INNER JOIN inscritos ON projetos_empresa.inscritos_id = inscritos.id WHERE ".$where." ORDER BY projetos_empresa.nome ASC";
                
                $result = $this->db->query($Sql);
                $data['registros'] = $result->result();
                
		$data['title_sing'] = 'Relatório de Projeto';        
		$data['tipo']  = $this->tipo; 
		$data['status']  = $this->status_projeto;  
                $data['controller']  = $this->controller;  
                   
                if( $this->input->get('pdf')) {
                    //helpers
                    $this->load->helper(array('dompdf', 'file'));

                    //recebe html da view
                    $html = ($this->load->view($this->dir.'projeto_pdf', $data, true));
                    //print_r($html);
                    //exit();

                    //Cria pdf
                    pdf_create($html, 'MB CONSULTORIA - '.$data['title_sing']);
                }
                else {
                    //Carrega view
                     $this->load->view($this->dir.'projeto', $data);  
                }                              
              
		if( !$this->input->get('pdf'))
                    get_footer(TRUE);
	}

	public function buscar_nivel(){

		//Cabeçalho
		$titulo = $this->titulo;
		if( !$this->input->get('pdf'))
                    get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;     
                
		//Menu
		if( !$this->input->get('pdf'))
                    get_menu();
                
                // este array mantem o resultado dos forms da busca
                $data['retorno_get']=$this->input->get();
                
                //print_r($data['retorno_get']);
		//Parâmetros de busca
                
                if($this->input->get('nivel')!='')                   
                    $data_busca['nivel_satisfacao'.'.tipo'] = $this->input->get('nivel');
                		
                $data['where'] = null;
               
                if (!isset($data_busca))
                  $data_busca['inscritos'.'.nome']  = '';
                
                
                
                
                $offset = null;        
                $join = array("inscritos" => array("where" => " nivel_satisfacao.inscritos_id = inscritos.id", "type" => "inner"));
                
                $data['registros'] = $this->default_model->get_by_search('nivel_satisfacao', array('nivel_satisfacao'.'.*','inscritos.razao_social'), $data['where'], $offset, null, $data_busca,$join, 'nivel_satisfacao'.'.tipo', 'DESC');
		           
		
		//Parâmetros
		$data['nivel']  = $this->nivel;
		$data['controller'] = $this->controller;
		$data['title_sing'] = 'Relatório de Nível de Satisfação';

                   
                if( $this->input->get('pdf')) {
                    //helpers
                    $this->load->helper(array('dompdf', 'file'));

                    //recebe html da view
                    $html = ($this->load->view($this->dir.'nivel_pdf', $data, true));
                    //print_r($html);
                    //exit();

                    //Cria pdf
                    pdf_create($html, 'MB CONSULTORIA - '.$data['title_sing']);
                }
                else {
                    //Carrega view
                     $this->load->view($this->dir.'nivel', $data);  
                }                        
         
                                
		if( !$this->input->get('pdf'))
                    get_footer(TRUE);
	}

	public function buscar_acao(){
		//Cabeçalho
		$titulo = $this->titulo;
		if( !$this->input->get('pdf'))
                    get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;           
		//Menu
		if( !$this->input->get('pdf'))
                    get_menu();
                
                $usuarios = $this->default_model->get_by_search_All('usuario','id,nome', null , null , null,  "tipo IN ( 'CA' , 'A' ) AND Ativo = 'S' AND login <> 'root' ", null, 'nome', 'asc');
                $data['colaborador'][''] = "Selecione um colaborador";
                
                foreach($usuarios as $row)
                    $data['colaborador'] [$row->id] = $row->nome ;
                
                
                // este array mantem o resultado dos forms da busca
                $data['retorno_get']=$this->input->get();
                
                //print_r($data['retorno_get']);
		//Parâmetros de busca
                		
                $where = ' 1 = 1 ';
                
                
                if($this->input->get('tipo')!='')                    
                   $where .= " AND ( tipo = '".$this->input->get('tipo')."' ) " ; 
                
                if($this->input->get('classificacao')!='')                   
                    $where .= " AND ( classificacao = '".$this->input->get('classificacao')."' ) ";
                
                
                if($this->input->get('data_de')!='') {               
                    $data_pesquisa= w3c_date($this->input->get('data_de'));    
                    
                    $where .= " AND ( data >= '".$data_pesquisa."' ) ";
                }
                
                if($this->input->get('data_ate')!='') {               
                    $data_pesquisa= w3c_date($this->input->get('data_ate')); 
                    
                    $where .= " AND ( data <= '".$data_pesquisa."' ) ";   
                }
                
                if($this->input->get('status')!='')                   
                    $where .= " AND ( status = '".$this->input->get('status')."' ) "; 
                
                if($this->input->get('responsavel')!='')                   
                    $where .= " AND ( id_usuario_responsavel_mb = '".$this->input->get('responsavel')."' ) "; 
                
                if($this->input->get('prioridade')!='')                   
                    $where .= " AND ( prioridade = '".$this->input->get('prioridade')."' ) "; 
                
                
                $Sql="SELECT acao_prospecao.*,inscritos.razao_social FROM acao_prospecao INNER JOIN inscritos ON acao_prospecao.inscritos_id = inscritos.id WHERE ".$where." ORDER BY acao_prospecao.data DESC";
                
                $result = $this->db->query($Sql);
                $data['registros'] = $result->result();
                
		$data['title_sing'] = 'Relatório de Ação de Prospecção';        
		$data['tipo']  = $this->tipo_acao; 
		$data['status']  = $this->status_acao; 
                $data['prioridade']  = $this->prioridade; 
                $data['controller']  = $this->controller;  
                $data['controller']  = $this->controller;  
                
                if( $this->input->get('pdf')) {
                    //helpers
                    $this->load->helper(array('dompdf', 'file'));

                    //recebe html da view
                    $html = ($this->load->view($this->dir.'acao_pdf', $data, true));
                    //print_r($html);
                    //exit();

                    //Cria pdf
                    pdf_create($html, 'MB CONSULTORIA - '.$data['title_sing']);
                }
                else {
                    //Carrega view
                     $this->load->view($this->dir.'acao', $data);  
                }                     
              
		if( !$this->input->get('pdf'))
                    get_footer(TRUE);
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */