<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesquisas extends CI_Controller {

	var $titulo 		= 'Pesquisas';
	var $dir 			= 'multitools/pesquisas/';
	var $controller 	= 'multitools/pesquisas';
	var $title_sing 	= 'Pesquisa';
	var $per_page 		= 20;
	var $table 			= 'pesquisas';
	var $join			= array('inscritos' => array('where' => 'inscritos.id = inscritos_id', 'type' => 'inner'));
    var $listId = "93a652e0b2"; 
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
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, nome'), $offset, $this->per_page, NULL, $this->join, $this->table.'.id_pesquisas', 'DESC');

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
		$data['flag_status'] = false;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca Clientes
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome', NULL,array('tipo_pessoa'=>'J','ativo'=>'S'), NULL, NULL, false, 'id');

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;
		$data['flag_status'] = true;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca Clientes
		$data['inscritos'] = $this->default_model->listaAssociativa('inscritos', 'nome', NULL,array('tipo_pessoa'=>'J','ativo'=>'S'), NULL, NULL, false, 'id');

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		$config		    = array(
	    'apikey' => '5d3555ad583a3b8581f88121700266c9-us7',      // Insert your api key
            'secure' => FALSE   // Optional (defaults to FALSE)
		);

		$this->load->library('MCAPI', $config, 'mail_chimp');  

		//Recebe Post
		$data = $_POST;

		//Library de Upload
		$config['upload_path']   = './assets/uploads/logo/';
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);

		//Upload da Logo
		if(!empty($_FILES['logo']['name'])){
			if($this->upload->do_upload('logo')){

				if(isset($data["id_pesquisas"]) && $data["id_pesquisas"]){
					$registro = $this->default_model->get_by_id($this->table, $data['id_pesquisas'], array('*'), NULL, NULL, 'id_pesquisas');
					@unlink('./assets/uploads/logo/'.$registro->logo);
				}
				$data_file      = $this->upload->data();
				$data['logo'] = $data_file['file_name'];
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());
				redirect($this->controller);
			}
		}
                
        //Library de Upload
		$config['upload_path']   = './assets/uploads/ModuloPesquisa/Relatorios/';
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
                

		//Upload do Relatório
		if(!empty($_FILES['arquivo_relatorio']['name'])){
			if($this->upload->do_upload('arquivo_relatorio')){

				if(isset($data["id_pesquisas"]) && $data["id_pesquisas"]){
					$registro = $this->default_model->get_by_id($this->table, $data['id_pesquisas'], array('*'), NULL, NULL, 'id_pesquisas');
					@unlink('./assets/uploads/ModuloPesquisa/Relatorios/'.$registro->arquivo_relatorio);
				}
				$data_file = $this->upload->data();
				$data['arquivo_relatorio'] = $data_file['file_name'];

				$cliente = $this->default_model->get_by_id('inscritos', $data['inscritos_id']);

				//Envia email para o cliente
				$this->load->library('email');
				$config['protocol'] = 'mail';
				$config['mailtype'] = 'html';

				//Conteúdo do e-mail
				$conteudo = $this->load->view($this->dir.'email_relatorio', array('pesquisa' => $data['titulo'], 'usuario' => $cliente->nome), true);

				//Parâmetros
				$this->email->initialize($config);
				$this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
				$this->email->to($cliente->email, $cliente->nome);
				$this->email->subject('MB CONSULTORIA - RELATÓRIO DISPONÍVEL');
				$this->email->message($conteudo);
				$this->email->send();
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());
				redirect($this->controller);
			}
		}

                

                
		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_pesquisas"]) && $data["id_pesquisas"])
		{
			if ( $data['status'] == 'AL' && $data['ativo'] == 'S' ) $data['status'] = 'AP';
			if ( $data['status'] == 'NA' && $data['ativo'] == 'S' ) $data['status'] = 'IN';
			
			$rows_affected = $this->default_model->update($this->table, $_POST['id_pesquisas'], $data, 'id_pesquisas');
			
		}
		else{
			$data['created'] = date('Y-m-d H:i:s');
			$data['chave'] = md5(date('Y-m-d H:i:s'));	
			$data['status'] = 'IN';			

		    $data['mailchimp_list_id'] = $this->mail_chimp->listStaticSegmentAdd($this->listId, $data['chave'] );

			$rows_affected = $this->default_model->insert($this->table, $data);           
                        
		}
                
                
                

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller);
	}

	public function desativar($id){

       if($this->default_model->update_where($this->table,array('ativo'=>'N'),array('id_pesquisas'=>$id)))
           $this->session->set_flashdata('msg', 'Registro desativado com sucesso!');
       else
           $this->session->set_flashdata('msg', 'Registro não foi desativado!');


		redirect($this->controller);
	}

	public function excluir($id){

		try {
			$this->default_model->delete('pesquisas_alteracoes',array('pesquisas_id_pesquisas'=>$id));
			$this->default_model->delete('pesquisas_respostas',array('pesquisas_id_pesquisas'=>$id));
			$this->default_model->delete('pesquisas_contatos',array('pesquisas_id_pesquisas'=>$id));
			
			
			$registros = $this->default_model->get_all('pesquisas_perguntas', array('id_pesquisas_perguntas'), null, null, array('pesquisas_id_pesquisas' => $id), null, null, null);
			
			foreach($registros as $row):
				$this->default_model->delete('pesquisas_perguntas_opcoes',array('pesquisas_perguntas_id_pesquisas_perguntas'=>$row->id_pesquisas_perguntas));
			endforeach;
			
			$this->default_model->delete('pesquisas_perguntas',array('pesquisas_id_pesquisas'=>$id));
			$this->default_model->delete('pesquisas',array('id_pesquisas'=>$id));
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		}
		catch (Exception $e)  {
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');
		}
		
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

	public function questionario($id, $acao = 'ver_questionario', $contato_id = false){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;;

		//Menu
		get_menu();

		//Busca registro
		$data['pesquisa'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas');

		//Busca perguntas da pesquisa
		$data['perguntas'] = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_id_pesquisas' => $id, 'pesquisas_perguntas_id_pesquisas_perguntas' => NULL), NULL, 'ordem', 'ASC');

		//Busca lista de Contatos
		$data['contatos'] = $this->default_model->listaAssociativa('pesquisas_contatos', 'nome', NULL, array('pesquisas_id_pesquisas' => $id,'respondido'=>'N'), NULL, NULL, false, 'id_pesquisas_contatos');

		//Busca opções
		foreach($data['perguntas'] as $key => $pergunta){

			if($pergunta->tipo == 'P05'  || $pergunta->tipo == 'P10'  || $pergunta->tipo == 'CLA'){
				$data['perguntas'][$key]->sub_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');

				if($acao == 'ver_respostas' && $contato_id){
					foreach($data['perguntas'][$key]->sub_perguntas as $key_sub => $subpergunta)
						$data['perguntas'][$key]->sub_perguntas[$key_sub]->resposta = $this->default_model->get_by_id('pesquisas_respostas', $subpergunta->id_pesquisas_perguntas, array('resposta', 'pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes as opcao_resposta,valor'), array('pesquisas_id_pesquisas' => $id, 'pesquisas_contatos_id_pesquisas_contatos' => $contato_id), NULL, 'pesquisas_perguntas_id_pesquisas_perguntas');
				}

				if($pergunta->tipo == 'CLA'){
                                        foreach($data['perguntas'][$key]->sub_perguntas as $key_sub => $subpergunta) {
						$data['perguntas'][$key]->sub_perguntas[$key_sub]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $subpergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
                                        }
                                
                                        $data['perguntas'][$key]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
                                        
					$count_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
					$data['perguntas'][$key]->total_sub_perguntas = $count_perguntas[0]->total;
				}
			}
			else if($pergunta->tipo == 'RAD'  || $pergunta->tipo == 'CHE'){
				$data['perguntas'][$key]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
			}

			if($acao == 'ver_sugestoes'){
				$data['perguntas'][$key]->sugestao = $this->default_model->get_by_id('pesquisas_alteracoes', $pergunta->id_pesquisas_perguntas, array('*'), array('pesquisas_id_pesquisas' => $id), NULL, 'pesquisas_perguntas_id_pesquisas_perguntas');
			}

			if($acao == 'ver_respostas' && $contato_id){
				if($pergunta->tipo == 'CHE')				
				{
					$repostas = $this->default_model->get_all('pesquisas_respostas', array('*'), 0, NULL, array('pesquisas_id_pesquisas' => $id, 'pesquisas_contatos_id_pesquisas_contatos' => $contato_id,'pesquisas_perguntas_id_pesquisas_perguntas'=>$pergunta->id_pesquisas_perguntas), NULL, 'pesquisas_perguntas_id_pesquisas_perguntas');
										
					foreach($repostas as $resposta){
					
						$data['perguntas'][$key]->resposta[$resposta->pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes]->valor = $resposta->valor;
						$data['perguntas'][$key]->resposta[$resposta->pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes]->resposta = $resposta->resposta;
						$data['perguntas'][$key]->resposta[$resposta->pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes]->opcao_resposta = $resposta->pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes;
					}
				}
				else
					$data['perguntas'][$key]->resposta = $this->default_model->get_by_id('pesquisas_respostas', $pergunta->id_pesquisas_perguntas, array('resposta', 'pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes as opcao_resposta,valor'), array('pesquisas_id_pesquisas' => $id, 'pesquisas_contatos_id_pesquisas_contatos' => $contato_id), NULL, 'pesquisas_perguntas_id_pesquisas_perguntas');
				
			}
		}
                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		if($acao == 'ver_sugestoes')
			$this->load->view($this->dir.'form_sugestoes', $data);
		elseif($acao == 'ver_respostas')
			$this->load->view($this->dir.'form_respostas', $data);
		else
			$this->load->view($this->dir.'form_questionario', $data);
		get_footer(TRUE);
	}

	public function salvar_questionario()
	{
		//Recebe Post
		$data = $_POST;
		$pesquisa_id = $data['pesquisa_id'];
		$contato_id = $data['contato_id'];
		unset($data['pesquisa_id'], $data['contato_id']);
                
		foreach($data as $id_pergunta => $resposta){

			if ( !strstr($id_pergunta, 'aberto') ) {
				$dados['pesquisas_contatos_id_pesquisas_contatos'] = $contato_id;
				$dados['pesquisas_id_pesquisas'] = $pesquisa_id;
				$dados['pesquisas_perguntas_id_pesquisas_perguntas'] = $id_pergunta;

				if ( is_int($id_pergunta) ) 
				{
					//Busca pergunta
					$pergunta = $this->default_model->get_by_id('pesquisas_perguntas', $id_pergunta, array('*'), NULL, NULL, 'id_pesquisas_perguntas');

					if ( isset($pergunta) )
					{
						if($pergunta->tipo == 'RAD')
						{
							$dados['pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes'] = $resposta;
							
							if ( isset($data['aberto_'.$resposta]))
								$dados['resposta'] = $data['aberto_'.$resposta];
						}
						elseif($pergunta->tipo == 'CHE')
						{                                                    
							foreach($resposta as $opcao){
								
								$dados2 = $dados;
								$dados2['pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes'] = $opcao;
								
								if ( isset($data['aberto_'.$opcao]))
									$dados2['resposta'] = $data['aberto_'.$opcao];
								
								$this->default_model->insert('pesquisas_respostas', $dados2);
								
								unset($dados2);					
							}
						
						}
						elseif($pergunta->tipo == 'P05'  || $pergunta->tipo == 'P10')
							$dados['valor'] = $resposta;
						elseif($pergunta->tipo == 'CLA')
							$dados['pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes'] = $resposta;
						else
							$dados['resposta'] = $resposta;
					}
					
					if($pergunta->tipo != 'CHE')
						$this->default_model->insert('pesquisas_respostas', $dados);
					unset($dados);
				}
			}
		}
		
		$this->default_model->update('pesquisas_contatos',$contato_id, array('respondido'=>'S'), 'id_pesquisas_contatos');

		//Retorno
		$this->session->set_flashdata('msg', 'Enviado com sucesso.');
		redirect($this->controller);
	}   
}












/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */